<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ContactMessage extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable = [
        'name', 'email', 'subject', 'message', 'status', 'ip_address',
    ];
    protected static $recordEvents = ['deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'subject', 'message', 'status']) // Field yang dilog
            ->dontSubmitEmptyLogs()
            ->useLogName('contact_messages')
            ->setDescriptionForEvent(fn(string $eventName) => "Pesan dari \"{$this->name}\" telah dihapus");
    }
}