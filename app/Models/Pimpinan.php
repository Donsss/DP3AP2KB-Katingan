<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ▼▼ TAMBAHKAN INI ▼▼
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pimpinan extends Model {
    use HasFactory, LogsActivity; // <-- Tambahkan LogsActivity

    protected $fillable = [
        'name',
        'photo',
        'nip',
        'pangkat_golongan',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jabatan',
        'quote',
        'agama',
    ];

    // ▼▼ TAMBAHKAN METHOD INI ▼▼
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // Kita lacak semua field yang bisa diisi
            ->logOnly($this->fillable)
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Profil Pimpinan \"{$this->name}\" telah {$eventName}");
    }
}