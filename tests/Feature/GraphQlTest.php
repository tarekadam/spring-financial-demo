<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Nuwave\Lighthouse\Testing\RefreshesSchemaCache;
use Tests\TestCase;

/**
 * @see http://api.clicktick.test/graphql-playground
 * @see graphql/schema.graphql
 */
class GraphQlTest extends TestCase
{
    use DatabaseTransactions;
    use MakesGraphQLRequests;
    use RefreshesSchemaCache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootRefreshesSchemaCache();
    }

    /**
     * @test
     */
    public function can_fetch_player()
    {
        $id = Player::first()->id;

        $response = $this->graphQL("
        query{
          player (id: $id) {
              id,
              name,
              score
          }
        }");

        $response->assertJsonFragment(['id' => "$id"]);
    }

    /**
     * @test
     */
    public function can_fetch_list_of_players()
    {
        $response = $this->graphQL("
        query{
          players{
              id,
              name,
              score
          }
        }");

        $response->assertJsonStructure(["data" => ["players" => ['*' => ['id', 'name', 'score']]]]);
    }

    /**
     * @test
     */
    public function can_create_player()
    {
        do{
            $name = substr(uniqid(), -10);
        }while(Player::whereName($name)->exists());

        $response = $this->graphQL('
        mutation{
          createPlayer(name: "' . $name . '"){
            id
          }
        }');

        $max_id = Player::latest()
                        ->first()
                        ->getKey();

        $response->assertJsonPath('data.createPlayer.id', "$max_id");
    }

    /**
     * @test
     */
    public function can_delete_player()
    {
        $id = Player::first()
                    ->getKey();

        $response = $this->graphQL("
        mutation{
          deletePlayer(id: $id){
            id
          }
        }");

        $this->expectException(ModelNotFoundException::class);
        Player::findOrFail($id);
    }

    /**
     * @test
     */
    public function can_increment_score()
    {
        $player = Player::first();

        $response = $this->graphQL('
        mutation{
          play(id: '. $player->getKey() .', operation:"increment"){
            id,
            name,
            score
          }
        }');

        $expect = $player->score +1;
        $response->assertJsonPath('data.play.score', $expect);
    }

    /**
     * @test
     */
    public function can_decrement_score()
    {
        $player = Player::first();

        $response = $this->graphQL('
        mutation{
          play(id: '. $player->getKey() .', operation:"decrement"){
            id,
            name,
            score
          }
        }');

        $expect = max($player->score -1, 0);
        $response->assertJsonPath('data.play.score', $expect);
    }

}
