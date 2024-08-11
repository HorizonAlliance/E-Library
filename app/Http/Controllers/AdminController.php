<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\permissions;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard', ['title' => 'dashboard']);
    }

    public function permissions() : View
    {
        $permissions = permissions::latest()->get();

        return view('admin.permissions.permissions',compact('permissions'));
    }

    public function updateStatusPermissions(Request $request, int $id, string $action) : RedirectResponse
    {
        $request->validate([
            'note' => 'nullable',
            'librarian' => 'nullable',
        ]);
        $permissions = permissions::findOrFail($id);
        $user = Auth::user()->username;
        $book = books::find($permissions->book_id);
        $readDuration = $book->read_duration;
        $expiratedPermit = now()->addDays($readDuration);
        if($action !== 'accept' && $action !== 'decline'){
            return redirect()->back()->with('error', 'Invalid action');
        }

        if($permissions->status == $action){
            return redirect()->back()->with('error', 'Permission already '.$action);
        }

        try {
            if($action == 'accept'){
                $permissions->status = $action;
                $permissions->librarian = $user;
                $permissions->expirated = $expiratedPermit;
                $permissions->save();
            } else {
                $permissions->status = $action;
                $permissions->note = $request->note;
                $permissions->librarian = $user;
                $permissions->save();
            }
            return redirect()->back()->with('success', 'Permissions status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating permissions status: '. $e->getMessage());
        }

    }
}
