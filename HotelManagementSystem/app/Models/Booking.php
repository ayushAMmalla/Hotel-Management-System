<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
class Booking extends Model
{
    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'total_price',
        'status',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}


}
