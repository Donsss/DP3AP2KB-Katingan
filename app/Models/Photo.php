<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ▼▼ TAMBAHKAN INI ▼▼
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Photo extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'image',
        'title',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title']) 
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Foto \"{$this->title}\" telah {$eventName}");
    }
}