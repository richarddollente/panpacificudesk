<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'body',
        'user_id',
        'ticket_id',
    ];

    protected $casts = [
        'data' => 'array',
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
