<?php

namespace App\GraphQL\Mutations;

use App\Models\Player;

class Play
{
    /**
     * @param null                 $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {
        $player = Player::findOrFail($args['id']);
        $player->{$args['operation']}();
        return $player;

    }
}
