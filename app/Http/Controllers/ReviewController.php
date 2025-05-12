<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Enregistre un nouvel avis pour un livre
     */
    public function store(Request $request, Book $book)
    {
        // Validation des données
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);

        // Création de l'avis
        $review = $book->reviews()->create($validated);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Votre avis a été ajouté avec succès!');
    }

    /**
     * Met à jour un avis existant
     */
    public function update(Request $request, Review $review)
    {
        // Vérification que l'utilisateur peut modifier cet avis
        // (À adapter selon votre système d'authentification)
        // if ($review->user_id !== auth()->id()) {
        //     abort(403);
        // }

        // Validation des données
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);

        // Mise à jour de l'avis
        $review->update($validated);

        return redirect()
            ->route('books.show', $review->book)
            ->with('success', 'Votre avis a été mis à jour avec succès!');
    }

    /**
     * Supprime un avis
     */
    public function destroy(Review $review)
    {
        // Vérification que l'utilisateur peut supprimer cet avis
        // (À adapter selon votre système d'authentification)
        // if ($review->user_id !== auth()->id()) {
        //     abort(403);
        // }

        $book = $review->book;
        $review->delete();

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Votre avis a été supprimé avec succès!');
    }

    /**
     * Méthode bonus pour l'API (optionnelle)
     */
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