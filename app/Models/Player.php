<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function increment($column = 'score', $amount = 1, array $extra = [])
    {

        return parent::increment($column, $amount, $extra);
    }

    public function decrement($column = 'score', $amount = 1, array $extra = [])
    {
        if($column == 'score' and !$this->score)
        {
            return;
        }

        parent::decrement('score');
    }
}
