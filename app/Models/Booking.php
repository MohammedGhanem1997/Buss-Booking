<?php

namespace App\Models;

use App\Notifications\BookingStatusChangeNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use Illuminate\Support\Facades\Notification;
class Booking extends Model
{
    use SoftDeletes;

    public $table = 'bookings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
         'Processing',
         'Confirmed',
         'Rejected',
    ];

    protected $fillable = [
        'ride_id',
        'name',
        'email',
        'phone',
        'status',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function booting()
    {
        self::updated(function (Booking $booking) {
            if ($booking->isDirty('status') && in_array($booking->status, ['confirmed', 'rejected'])) {
                Notification::route('mail', $booking->email)->notify(new BookingStatusChangeNotification($booking->status));
            }
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id');
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
