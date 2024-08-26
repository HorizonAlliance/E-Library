<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\BookSuggestions;
use App\Models\BookSuggestionsLike;
use App\Models\collections;
use App\Models\permissions;
use App\Models\reviews;
use App\Models\User;
use Carbon\Exceptions\Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use function Laravel\Prompts\error;

class ReaderController extends Controller
{
    public function index(): View
    {
        $books = books::latest()->paginate(10);
        $userCount = User::all()->count();
        $booksCount = books::all()->count();
        $requestCount = permissions::all()->count();
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $permissions = permissions::where('user_id', $userId)->get();
        } else {
            $permissions = null;
        }

        return view('homepage', compact('books', 'permissions','userCount','booksCount','requestCount'));
    }

    public function show($id) : View
    {
        // Ambil data buku berdasarkan ID
        $book = books::find($id);
        $permission = null;

        $reviews = reviews::where('book_id', $id)->paginate(5);

        if (Auth::check()) {
            $user_id = Auth::user()->id;

            // Ambil izin terbaru yang belum expired, diurutkan berdasarkan created_at
            $permission = permissions::where('book_id', $id)
                ->where('user_id', $user_id)
                ->where(function ($query) {
                    $query->whereNull('expirated')
                          ->orWhere('expirated', '>', now());
                })
                ->orderBy('created_at', 'desc')
                ->first();
        }

        // Kembalikan view dengan data buku, izin, dan ulasan
        return view('detail', compact('book', 'permission', 'reviews'));
    }


    public function send_request(Request $request) : RedirectResponse
    {
        $request->validate([
            'book_id' => 'required|integer',
        ]);

        if (Auth::check()) {
            $user = Auth::user();
            $existingPermission = permissions::where('user_id', $user->id)
                ->where('book_id', $request->book_id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($existingPermission) {
                if ($existingPermission->status === 'accept') {
                    if ($existingPermission->isExpired()) {
                        return redirect()->route('book_detail', ['id' => $request->book_id])->with('error', 'Izin sudah kadaluarsa. Silakan ajukan permintaan baru.');
                    } else {
                        return redirect()->route('book_detail', ['id' => $request->book_id])->with('success', 'Anda sudah memiliki izin. Silakan membaca buku.');
                    }
                } elseif ($existingPermission->status === 'proces') {
                    return redirect()->route('book_detail', ['id' => $request->book_id])->with('error', 'Permintaan sudah dalam proses. Harap tunggu.');
                } elseif ($existingPermission->status === 'decline') {
                    return redirect()->route('book_detail', ['id' => $request->book_id]);
                }
            }

            permissions::create([
                'user_id' => $user->id,
                'book_id' => $request->book_id,
                'status' => 'proces',
            ]);

            return redirect()->route('homepage')->with('success', 'Permintaan izin telah diajukan.');
        }

        return redirect()->route('login')->with('error', 'Anda perlu login untuk mengajukan permintaan.');
    }


    public function viewPdf($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to view this PDF.');
        }

        $permissions = permissions::findOrFail($id);

        if (Auth::user()->id !== $permissions->user_id) {
            return redirect()->back()->with('error', 'You do not have permission to view this PDF.');
        }

        if ($permissions->status !== 'accept') {
            return redirect()->back()->with('error', 'You do not have permission to view this PDF.');
        }
        $book = books::find($permissions->book_id);

        return view('pdf_viewer', compact('book'));
    }


    public function addReview(Request $request): RedirectResponse
    {
        $request->validate([
            'ulasan' => 'required|string',
            'rating' => 'required|integer|min:1|max:10',
            'book_id' => 'required|integer',
        ]);
        try {
            $user_id = Auth::user()->id;

            $existingReview = reviews::where('user_id',$user_id)
                                    ->where('book_id',$request->book_id)
                                    ->first();
            if($existingReview){
                return redirect()->back()->with('error','Your review is already for this book');
            }

            reviews::create([
                'user_id' => $user_id,
                'book_id' => $request->book_id,
                'ulasan' => $request->ulasan,
                'rating' => $request->rating,
            ]);
            // dd($review);
            return redirect()->back()->with('success','Successfully to added your review for this book');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error to adding your review for this book: ' . $e);
        }


    }

    public function collections() : View | RedirectResponse
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $collections = collections::where('user_id', $user_id)->get();
            $permissions = permissions::where('user_id', $user_id)->get();
        // dd($permissions);
            return view('pages.collections', compact('collections','permissions'));
        }

        return redirect()->route('login')->with('error','You need logged to view collections');
    }
    public function addCollect(Request $request) : RedirectResponse
    {
        $request->validate([
            'book_id' => 'required|integer'
        ]);
        if(!Auth::check()){
            return redirect()->back()->with('error','Login to add book in your collections');
        }
        if(collections::where('book_id',$request->book_id)->where('user_id',Auth::user()->id)->exists()){
            return redirect()->back()->with('error', 'This book is already in your collection.');
        } else {
            collections::create([
                'book_id' => $request->book_id,
                'user_id' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Book added to your collection.');
        }
    }

    public function BookSuggestions() : View | RedirectResponse
    {
        $mostLikedSuggestions = BookSuggestions::withCount('suggestionsLike')->orderBy('suggestions_like_count','desc')->get();
        return view('book_suggestions',compact('mostLikedSuggestions'));
    }

    public function addBookSuggestions(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'string|nullable',
            'publisher' => 'string|nullable',
            'description' => 'string|nullable',
        ]);
        if (!Auth::check()) {
            return redirect()->back()->with('error','Login to add book suggestion');
        }
        $user_id = Auth::user()->id;
        try {
            BookSuggestions::create([
                'title' => $request->title,
                'user_id' => $user_id,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'description' => $request->description,
            ]);
            return redirect()->back()->with('success','Add Book Suggestion successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Kesalahan: ' . $e);
        }
    }

    public function likeSugestion(Request $request) : RedirectResponse
    {
        $request->validate([
            'suggestions_id' => 'required',
        ]);

        try {
            if(!Auth::check()){
                return redirect()->back()->with('error','Login to like suggestion');
            }
            $user_id = Auth::user()->id;
            $suggestions_id = $request->suggestions_id;

            $bookSuggestion = BookSuggestions::find($suggestions_id);
            if(!$bookSuggestion){
                return redirect()->back()->with('error','Book Suggest Not Found');
            }

            if($bookSuggestion->user_id == $user_id){
                return redirect()->back()->with('error','You cannot like your own suggestion');
            }
            $existingPermissions = BookSuggestionsLike::where('user_id',$user_id)->where('suggestions_id',$suggestions_id)->exists();
            if($existingPermissions){
                return redirect()->back()->with('error','You have already like for this suggestion');
            }

            BookSuggestionsLike::create([
                'user_id' => $user_id,
                'suggestions_id' => $request->suggestions_id,
            ]);
            return redirect()->back()->with('success','like suggestion');
        } catch (Exception $e) {
            return redirect()->back()->with('error','error'. $e);
        }
    }

}
