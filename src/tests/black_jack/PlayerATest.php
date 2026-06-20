<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\PlayerA;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/PlayerA.php');


class PlayerATest extends TestCase
{
  public function testAddCardMyHand(): void
  {
    $player = new PlayerA();
    $player->addCardMyHand();
    $after_number = count($player->player_a_hand);
    $this->assertSame(1, $after_number);
  }

  public function testGetPreviousCard(): void
  {
    $player = new PlayerA();
    $card = new Card('ハート', 'K');
    $player->player_a_hand = [$card];
    $previous_card = $player->getPreviousCard();
    $this->assertSame($card, $previous_card);
  }
}
