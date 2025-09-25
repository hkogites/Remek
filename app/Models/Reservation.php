<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $table = 'reservations';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'destination_id',
        'full_name',
        'email',
        'phone',
        'address',
        'people_count',
        'note',
        'status',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
