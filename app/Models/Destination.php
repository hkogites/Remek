<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    /**
     * Use singular 'destination' table to match existing DB naming.
     */
    protected $table = 'destination';

    /**
     * Disable timestamps to match legacy schema style.
     */
    public $timestamps = false;

    protected $fillable = [
        'slug',
        'title',
        'price_huf',
        'start_date',
        'end_date',
        'image_path',
        'detail_url',
        'leiras',
    ];
}
