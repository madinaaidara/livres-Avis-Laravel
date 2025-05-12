@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 800px;"> 
    <h2 class="text-center mb-4" style="max-width: 800px;">Liste des Livres</h2>
    
    @foreach($books as $book)
    <div class="card mb-3 border-0 shadow-sm"> 
        <div class="card-body p-3"> 
            <h5 class="mb-1">{{ $book->title }}</h5>
            <p class="text-muted small mb-2">Auteur: {{ $book->author }}</p>
            
            @if($book->reviews_count > 0)
            <div class="d-flex align-items-center mb-2">
                <span class="badge bg-light text-dark me-2">
                    {{ number_format($book->reviews_avg_rating, 1) }}/5
                </span>
                <small class="text-muted">{{ $book->reviews_count }} avis</small>
            </div>
            @endif
            
            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">
                Détails
            </a>
        </div>
    </div>
    @endforeach
</div>

<style>
    body {
        background-color:rgb(188, 211, 234); 
        background-image: none; 
    }
</style>
@endsection