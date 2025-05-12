@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1000px;">
    <div class="card mb-4">
        <div class="card-body">
            <h1>{{ $book->title }}</h1>
            <p class="text-muted">Par {{ $book->author }}</p>
            <p>Publié le: {{ $book->published_at->format('d/m/Y') }}</p>
            <p>{{ $book->description }}</p>
            
            @if($book->reviews->count() > 0)
                <div class="mt-3">
                    <h3>Note moyenne: {{ number_format($book->average_rating, 1) }}/5</h3>
                </div>
            @endif
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <h3>Ajouter un avis</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('books.reviews.store', $book) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">Utilisateur</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Choisir un utilisateur</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rating">Note (1-5)</label>
                    <select name="rating" id="rating" class="form-control" required>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group" >
                    <label for="comment">Commentaire</label>
                    <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer l'avis</button>
            </form>
        </div>
    </div>
    
    <h2>Avis des lecteurs</h2>
    @forelse($book->reviews as $review)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5>{{ $review->user->name }}</h5>
                    <div class="text-muted">
                        Note: {{ $review->rating }}/5
                        <!-- Bonus: Lien de modification -->
                        <a href="#" data-toggle="modal" data-target="#editReviewModal{{ $review->id }}" class="ml-2">
                            <small>Modifier</small>
                        </a>
                    </div>
                </div>
                <p class="mt-2">{{ $review->comment }}</p>
                <small class="text-muted">Posté le {{ $review->created_at->format('d/m/Y à H:i') }}</small>
            </div>
        </div>
        
        <!-- Bonus: Modal de modification -->
        <div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('reviews.update', $review) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Modifier l'avis</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Note (1-5)</label>
                                <select name="rating" class="form-control" required>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Commentaire</label>
                                <textarea name="comment" rows="3" class="form-control" required>{{ $review->comment }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Aucun avis pour ce livre pour le moment.</div>
    @endforelse
</div>
<style>
    body {
        background-color:rgb(188, 211, 234); 
        background-image: none; 
    }
</style>
@endsection