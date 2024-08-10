<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class BooksController extends Controller
{

   public function index(): View
    {
        $books = books::latest()->paginate(10);
        return view('admin.books.books', compact('books'));
    }

    public function create(): View
    {
        $category = Category::all(); // Ganti 'category' dengan 'category'
        return view('admin.books.add_books', compact('category'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'synopsis' => 'required|string',
            'release_date' => 'required|date_format:Y-m-d',
            'category_id' => 'required|integer',
            'cover' => 'required|image|mimes:jpeg,jpg,png',
            'file' => 'required|file|mimes:pdf',
            'read_duration' => 'required|integer',
        ]);

        $cover = $request->file('cover')->store('covers','public');
        $files = $request->file('file')->store('files','public');

        books::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'synopsis' => $request->synopsis,
            'release_date' => $request->release_date,
            'category_id' => $request->category_id,
            'cover' => $cover,
            'file' => $files,
            'read_duration' => $request->read_duration,
        ]);

        return redirect()->route('books.index')->with('success','create new a book success');
    }


    public function edit($id): View
    {
        $book = books::findOrFail($id);
        $category = Category::all();
        return view('admin.books.edit_books', compact('book', 'category'));
    }


    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $book = books::findOrFail($id);


           $request->validate([
                'title' => 'required|string',
                'author' => 'required|string',
                'publisher' => 'required|string',
                'synopsis' => 'required|string',
                'release_date' => 'required|date_format:Y-m-d',
                'category_id' => 'required|integer',
                'cover' => 'nullable|image|mimes:jpeg,jpg,png',
                'file' => 'nullable|file|mimes:pdf',
                'read_duration' => 'required|integer',
            ]);

            // Simpan data yang tidak berhubungan dengan file
            $book->title = $request->input('title');
            $book->author = $request->input('author');
            $book->publisher = $request->input('publisher');
            $book->synopsis = $request->input('synopsis');
            $book->release_date = $request->input('release_date');
            $book->category_id = $request->input('category_id');
            $book->read_duration = $request->input('read_duration');

            // Update cover jika ada file baru
            if ($request->hasFile('cover')) {
                // Hapus cover lama jika ada
                if ($book->cover) {
                    Storage::disk('public')->delete($book->cover);
                }
                // Simpan cover baru
                $book->cover = $request->file('cover')->store('covers', 'public');
            }

            // Update file jika ada file baru
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                if ($book->file) {
                    Storage::disk('public')->delete($book->file);
                }
                // Simpan file baru
                $book->file = $request->file('file')->store('files', 'public');
            }

            // Simpan perubahan ke database
            $book->save();

            return redirect()->route('books.index')->with('success', 'Update book success');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating book: ' . $e->getMessage());
        }
    }


    public function destroy($id): RedirectResponse
    {
        $book = books::findOrFail($id);

        // Hapus cover dan file jika ada
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        if ($book->file) {
            Storage::disk('public')->delete($book->file);
        }

        $book->delete();
        return redirect()->back()->with('success', 'Delete book success');
    }
}
