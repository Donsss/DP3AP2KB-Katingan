<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model {
    use HasFactory, logsActivity;

    protected $fillable = [
        'alamat',
        'jam_kerja',
        'telepon',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'whatsapp_url',
        'site_name',         // <-- BARU
        'site_logo',         // <-- BARU
        'copyright_text',    // <-- BARU
        'footer_about',      // <-- BARU
        'twitter_url',
        'google_map_url',
        'tiktok_url',
        'notification_email',
    ];

    protected $casts = [
        'jam_kerja' => 'array',
        'telepon' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable)
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Pengaturan Global telah {$eventName}");
    }
}