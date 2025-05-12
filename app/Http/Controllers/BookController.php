<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Charge les livres avec leurs reviews pour éviter le N+1 problem
        $books = Book::withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->latest()
                    ->paginate(10);
                    
        return view('books.index', compact('books'));
    }
    
    public function show(Book $book)
    {
        // Charge les reviews avec les utilisateurs associés
        $book->load(['reviews.user']);
        $users = User::all();
        
        return view('books.show', compact('book', 'users'));
    }
    
    public function storeReview(Request $request, Book $book)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);
        
        $book->reviews()->create($validated);
        
        return redirect()
               ->back()
               ->with('success', 'Avis ajouté avec succès!');
    }
    
    public function updateReview(Request $request, Review $review)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);
        
        $review->update($validated);
        
        return redirect()
               ->back()
               ->with('success', 'Avis modifié avec succès!');
    }
}