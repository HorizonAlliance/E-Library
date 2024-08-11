<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\permissions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use setasign\Fpdi\FpdfTpl;
use setasign\Fpdi\Tfpdf\Fpdi;

class ReaderController extends Controller
{
    public function index(): View
    {
        $books = books::latest()->paginate(10);

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $permissions = permissions::where('user_id', $userId)->get();
            // dd($userId);
        } else {
            $permissions = null;
        }
        // dd($permissions);

        return view('homepage', compact('books', 'permissions'));
    }

    // public function show( $id) : View
    // {
    //     // dd("ID received: " . $id);
    //     $book = books::findOrFail($id);
    //     // dd($book);
    //     $permissions = permissions::findOrFail($id);
    //     return view('bookcuy', compact('book','permissions'));
    // }

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
        $permissions = permissions::findOrFail($id);
        $book = books::find($permissions->book_id);

        if ($permissions->status !== 'accept') {
            return redirect()->back()->with('error', 'You do not have permission to view this PDF.');
        }

        return view('pdf_viewer', compact('book'));
    }


    // public function review(): RedirectResponse
    // {

    // }
}
