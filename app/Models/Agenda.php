<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ▼▼ TAMBAHKAN INI ▼▼
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Agenda extends Model
{
    use HasFactory, LogsActivity; // <-- Tambahkan LogsActivity

    protected $fillable = [
        'title',
        'date',
        'time',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    // ▼▼ TAMBAHKAN METHOD INI ▼▼
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // Kita ingin melacak semua field yang bisa diedit
            ->logOnly(['title', 'date', 'time', 'description'])
            ->logOnlyDirty() // Hanya catat JIKA ada yang berubah
            ->setDescriptionForEvent(fn(string $eventName) => "Agenda \"{$this->title}\" telah {$eventName}");
    }
}