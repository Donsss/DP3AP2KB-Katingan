<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Bidang extends Model
{
    use HasFactory, LogsActivity; 
    protected $fillable = ['name', 'slug'];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class)->orderBy('order');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->logOnlyDirty() 
            ->setDescriptionForEvent(fn(string $eventName) => "Bidang \"{$this->name}\" telah {$eventName}");
    }
}