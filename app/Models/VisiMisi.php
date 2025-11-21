<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class VisiMisi extends Model {
    use HasFactory, LogsActivity;

    protected $fillable = [
        'visi',
        'misi',
    ];

    protected $casts = [
        'misi' => 'array', 
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['visi', 'misi'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Data Visi & Misi telah {$eventName}");
    }
}