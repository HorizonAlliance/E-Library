<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\BookSuggestions;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function booksPdf()
    {
        $books = Books::withRecentPermissions()->get();
        $date = Carbon::now();
        $month = Carbon::now()->format('F');

        $html = view('admin.books.most_read_generate_pdf', ['books' => $books, 'month' => $month])->render();

        $dompdf = new Dompdf();
        $dompdf->load_html($html);

        $dompdf->set_paper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('most_read_books_'.$date->format('Y-m-d').'.pdf', ['Attachment' => false]);
    }

    public function suggestBook()
    {
        $suggest = BookSuggestions::with('user','suggestionsLike')->withCount('suggestionsLike')->orderByDesc('suggestions_like_count')->get();
        $html = view('admin.bookSuggestion.generateBookSuggestions',compact('suggest'))->render();

        $dompdf = new Dompdf();
        $dompdf->load_html($html);

        $dompdf->set_paper('A4','potrait');
        $dompdf->render();

        return    $dompdf->stream('book_request.pdf',['Attachment'=> false]);
    }
}
