<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
    ];

    public function tickets()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
