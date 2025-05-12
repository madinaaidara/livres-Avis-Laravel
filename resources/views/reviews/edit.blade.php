<h2>Modifier l’avis</h2>

<form method="POST" action="{{ url('/reviews/' . $review->id) }}">
    @csrf
    @method('PUT')

    <label>Utilisateur :</label>
    <select name="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $review->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select><br>

    <label>Note (1-5) :</label>
    <input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}"><br>

    <label>Commentaire :</label>
    <textarea name="comment">{{ $review->comment }}</textarea><br>

    <button type="submit">Mettre à jour</button>
</form>
