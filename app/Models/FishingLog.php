<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FishingLog extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use  HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idFishingLog';

    /**
     * Get the user that owns the fishingLog.
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
        'user_id',
    ];

    /**
     * Get the pages for the user's fishinglog.
     */
    public function pages(): HasMany
    {
        return $this->hasMany(FishingLogPage::class,'fishing_log_id','idFishingLog');
    }
}
