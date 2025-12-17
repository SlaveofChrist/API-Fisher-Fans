<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use  HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idTrip';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'practicalInformation',
        'tripType',
        'priceType',
        'passengerCount',
        'price',
        'user_id',
        'boat_id',
    ];

    /**
     * Get the user that create the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the boat which is concerned by the trip.
     */
    public function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'startDates' => 'array',
            'endDates' => 'array',
            'departureTimes' => 'array',
            'endTimes' => 'array',
        ];  
    }
}
