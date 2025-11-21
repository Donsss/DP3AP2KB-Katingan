<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ▼▼ TAMBAHKAN INI ▼▼
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Document extends Model
{
    use HasFactory, LogsActivity; // <-- TAMBAHKAN LogsActivity

    protected $fillable = [
        'title',
        'file_path',
        'file_type',
        'file_size',
        'download_count',
    ];

    // ▼▼ TAMBAHKAN METHOD INI ▼▼
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title']) // Hanya lacak perubahan judul
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Dokumen \"{$this->title}\" telah {$eventName}");
    }
}