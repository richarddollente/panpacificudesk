<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable =[
        'subject',
        'description',
        'user_id',
        'admin_id',
        'status_id',
        'category_id',
        'priority_id',
        'ticket_file',
    ];

    protected $guarded = [

    ];

    protected $casts = [
        'data' => 'array',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }
    public function admins()
    {
        return $this->belongsToMany(User::class);
    }
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function status()
    {
        return $this->belongsToMany(Status::class);
    }
    public function priority()
    {
        return $this->belongsToMany(Priority::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
