<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'name');
    }
    public function admins()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class)->select(['id', 'title']);
    }
    public function priority()
    {
        return $this->belongsTo(Priority::class)->select(['id', 'title']);
    }



}
