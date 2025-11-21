<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// ▼▼ TAMBAHKAN INI ▼▼
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pegawai extends Model
{
    use HasFactory, LogsActivity; // <-- TAMBAHKAN LogsActivity
    protected $fillable = ['bidang_id', 'name', 'position', 'nip', 'photo', 'status', 'order'];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    // ▼▼ TAMBAHKAN METHOD INI ▼▼
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // Lacak semua kolom PENTING
            ->logOnly(['bidang_id', 'name', 'position', 'nip', 'status'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Data Pegawai \"{$this->name}\" telah {$eventName}");
    }
}