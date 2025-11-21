<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// ▼▼ TAMBAHKAN INI ▼▼
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Bidang extends Model
{
    use HasFactory, LogsActivity; // <-- TAMBAHKAN LogsActivity
    protected $fillable = ['name', 'slug'];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class)->orderBy('order');
    }

    // ▼▼ TAMBAHKAN METHOD INI ▼▼
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name']) // Hanya lacak perubahan nama
            ->logOnlyDirty() // Hanya catat JIKA ada yang berubah
            ->setDescriptionForEvent(fn(string $eventName) => "Bidang \"{$this->name}\" telah {$eventName}");
    }
}