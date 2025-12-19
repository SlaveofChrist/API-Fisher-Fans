<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FishingLogPage extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use  HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idFishingLogPage';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'comment',
        'sizeCm',
        'weightKg',
        'fishingLocation',
        'fishingDate',
        'released',
        'fishing_log_id',
    ];

    /**
     * Get the fishingLog that contains the pages.
     */
    public function log(): BelongsTo
    {
         return $this->belongsTo(FishingLog::class,'fishing_log_id','idFishingLog');
    }

}
