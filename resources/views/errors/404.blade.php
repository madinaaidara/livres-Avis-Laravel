@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="display-1">404</h1>
    <p class="lead">Page non trouvée</p>
    <p>La page que vous recherchez semble introuvable.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Retour à l'accueil</a>
</div>
@endsection