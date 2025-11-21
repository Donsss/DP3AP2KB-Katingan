<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RiwayatPendidikan extends Model {
     use HasFactory, LogsActivity;

     protected $fillable = [
        'judul',
        'keterangan',
        'deskripsi',
        'urutan',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul', 'keterangan', 'deskripsi'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Riwayat Pendidikan \"{$this->judul}\" telah {$eventName}");
    }
}