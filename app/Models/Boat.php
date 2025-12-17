<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boat extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use  HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idBoat';

    /**
     * Get the user that owns the boat.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'brand',
        'manufacturingYear',
        'homePort',
        'permitType',
        'boatType',
        'engineType',
        'equipments',
        'depositAmount',
        'maxCapacity',
        'numberOfBeds',
        'enginePower',
        'latitude',
        'longitude',
        'user_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
           'equipments' => 'array'
        ];  
    }
}
