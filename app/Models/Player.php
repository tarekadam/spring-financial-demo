<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model
{
    /**
     * @see \Database\Factories\PlayerFactory
     */
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @param       $column
     * @param       $amount
     * @param array $extra
     *
     * @return false|int
     */
    public function increment($column = 'score', $amount = 1, array $extra = [])
    {

        return parent::increment($column, $amount, $extra);
    }

    /**
     * @param       $column
     * @param       $amount
     * @param array $extra
     *
     * @return false|int|void
     */
    public function decrement($column = 'score', $amount = 1, array $extra = [])
    {
        if($column == 'score' and !$this->score)
        {
            return;
        }

        parent::decrement('score');
    }

    /**
     * @see \App\Models\Address
     * @return HasOne
     */
    public function Address() : HasOne{
        return $this->hasOne(Address::class);
    }

}
