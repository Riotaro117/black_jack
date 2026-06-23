<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\PlayerA;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/PlayerA.php');


class PlayerATest extends TestCase
{
    public function testAddCardMyHand(): void
    {
        $player = new PlayerA();
        $deck = new Deck();
        $player->addCardMyHand($deck);
        $afterNumber = count($player->hand);
        $this->assertSame(1, $afterNumber);
    }

    public function testGetPreviousCard(): void
    {
        $player = new PlayerA();
        $card = new Card('ハート', 'K');
        $player->hand = [$card];
        $previousCard = $player->getPreviousCard();
        $this->assertSame($card, $previousCard);
    }
}
