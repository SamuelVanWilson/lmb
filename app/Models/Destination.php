<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Comment;

class Destination extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'description',
        'image',
        'stock',
        'ticket_price',
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
