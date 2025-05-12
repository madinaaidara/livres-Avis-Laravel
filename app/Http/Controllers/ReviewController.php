<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    
    public function store(Request $request, Book $book)
    {
        
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);

       
        $review = $book->reviews()->create($validated);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Votre avis a été ajouté avec succès!');
    }

   
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);

      
        $review->update($validated);

        return redirect()
            ->route('books.show', $review->book)
            ->with('success', 'Votre avis a été mis à jour avec succès!');
    }

    
    public function destroy(Review $review)
    {

        $book = $review->book;
        $review->delete();

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Votre avis a été supprimé avec succès!');
    }

   
    public function apiStore(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $review = $book->reviews()->create($validator->validated());

        return response()->json([
            'success' => true,
            'review' => $review
        ], 201);
    }
}