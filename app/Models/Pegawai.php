<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pegawai extends Model
{
    use HasFactory, LogsActivity; 
    protected $fillable = ['bidang_id', 'name', 'position', 'nip', 'photo', 'status', 'order'];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['bidang_id', 'name', 'position', 'nip', 'status'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Data Pegawai \"{$this->name}\" telah {$eventName}");
    }
}