<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    /**
     * @see \Database\Factories\AddressFactory
     */
    use HasFactory;

    /**
     * @see \App\Models\Player
     * @return BelongsTo
     */
    public function Player() : BelongsTo{
        return $this->belongsTo(Player::class);
    }
}
