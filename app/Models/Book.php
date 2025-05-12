<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'description', 'published_at'];
    
    protected $dates = ['published_at'];
    
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    
    // Bonus: Calcul de la note moyenne
    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}