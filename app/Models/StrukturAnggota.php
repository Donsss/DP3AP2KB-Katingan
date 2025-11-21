<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class StrukturAnggota extends Model {
    use HasFactory, LogsActivity;
    protected $fillable = [
        'struktur_bidang_id',
        'nama',
        'jabatan',
        'nip',
        'foto',
        'is_visible',
        'urutan',
    ];

    public function bidang() {
        return $this->belongsTo(StrukturBidang::class, 'struktur_bidang_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['struktur_bidang_id', 'nama', 'jabatan', 'nip', 'is_visible'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Anggota Struktur \"{$this->nama}\" telah {$eventName}");
    }
}