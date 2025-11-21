<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Tugas extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'tugas';

    protected $fillable = [
        'id',
        'file_path',
        'file_name',
        'file_size',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['file_name'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "File Tugas \"{$this->file_name}\" telah {$eventName}");
    }
}