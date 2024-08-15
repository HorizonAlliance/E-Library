<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\collections;
use App\Models\permissions;
use App\Models\reviews;
use App\Models\User;
use Carbon\Exceptions\Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
        // dd($permissions);

        return view('homepage', compact('books', 'permissions','userCount','booksCount','requestCount'));
    }

    public function show( $id) : View
    {
        $book = books::find($id);
        $permission = null;
        $reviews = reviews::where('book_id',$id)->get();
        // dd($reviews);
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $permission = permissions::where('book_id',$id)->where('user_id',$user_id)->first();
        }
        // foreach($reviews as $review){
        //     dd($review->user->name);
        // }
        // dd($permission);
        return view('detail', compact('book','permission','reviews'));
    }

    public function send_request(Request $request) : RedirectResponse
    {
        $request->validate([
            'book_id' => 'required|integer',
        ]);

        if(Auth::check()){
            $user = Auth::user();
            $existingPermissions = permissions::where('user_id',$user->id)->where('book_id',$request->book_id)->first();

            if($existingPermissions){
                return redirect()->route('homepage')->with('error','Request Already exists');
            }
            permissions::create([
                'user_id' => $user->id,
                'book_id' => $request->book_id,
                'status' => 'proces',
            ]);
            return redirect()->route('homepage')->with('success','Request Submited');
        }
        return redirect()->route('login')->with('error','You need to be logged in to request');

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

}
