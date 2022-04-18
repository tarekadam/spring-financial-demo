<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * @see \Database\Factories\AddressFactory
     */
    use HasFactory;

    /**
     * @see \App\Models\Player
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Player(){
        return $this->belongsTo(Player::class);
    }
}
