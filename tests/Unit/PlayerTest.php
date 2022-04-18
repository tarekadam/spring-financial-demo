<?php

namespace Tests\Unit;

use App\Models\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    private $Player;
    const SCORE = 5;

    /**
     * @internal
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->Player        = new Player(['name' => $this->faker->firstName]);
        $this->Player->score = self::SCORE;
        $this->Player->save();
    }

    /**
     * @see Player
     * @test
     */
    public function can_create_player()
    {
        $this->assertTrue($this->Player->exists());
        $this->assertEquals(self::SCORE, $this->Player->score);
    }

    /**
     * @see          Player::increment
     * @see          Player::decrement
     *
     * @dataProvider scoreDataProvider
     * @test
     */
    public function can_change_player_score($action)
    {
        $old_score = $this->Player->score;
        $this->Player->$action();

        $this->assertNotEquals($old_score, $this->Player->score);
    }

    /**
     * @internal
     */
    public function scoreDataProvider()
    {

        return [
            ['action' => 'increment'],
            ['action' => 'decrement'],
        ];
    }

    /**
     * @see          Player::decrement
     *
     * @test
     */
    public function cannot_score_bellow_zero()
    {
        $this->Player->score = 0;
        $this->Player->decrement();
        $this->assertEquals(0, $this->Player->score);
    }
}
