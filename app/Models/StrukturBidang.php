<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
 

class StrukturBidang extends Model {
    use HasFactory, LogsActivity;
    protected $fillable = ['nama_bidang', 'urutan', 'is_shifted'];

    public function anggota() {
        return $this->hasMany(StrukturAnggota::class)->orderBy('urutan', 'asc');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nama_bidang', 'is_shifted'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Bidang Struktur \"{$this->nama_bidang}\" telah {$eventName}");
    }
}