<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class QuickLink extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'url',
        'order',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'url'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Tautan Cepat \"{$this->title}\" telah {$eventName}");
    }
}