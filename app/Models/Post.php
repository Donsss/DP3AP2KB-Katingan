<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id', 'title', 'slug', 'image', 'excerpt', 'body', 'status', 'view_count', 'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'image', 'excerpt', 'body', 'status', 'published_at'])
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(['view_count'])
            ->setDescriptionForEvent(fn(string $eventName) => "Berita \"{$this->title}\" telah {$eventName}");
    }
}