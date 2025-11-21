<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RiwayatPekerjaan extends Model {
     use HasFactory, LogsActivity;

     protected $fillable = [
        'judul',
        'keterangan',
        'urutan',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul', 'keterangan'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Riwayat Pekerjaan \"{$this->judul}\" telah {$eventName}");
    }
}