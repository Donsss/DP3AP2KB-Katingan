<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Video extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'youtube_url',
        'youtube_id',
        'title',
        'thumbnail',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['youtube_url', 'title'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Video \"{$this->title}\" telah {$eventName}");
    }
}