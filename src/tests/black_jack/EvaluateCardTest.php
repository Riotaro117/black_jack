<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\EvaluateCard;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/EvaluateCard.php');


class EvaluateCardTest extends TestCase
{
  public function testEvaluateCardPoint(): void
  {
    $card1 = new Card('ハート', 'A');
    $card2 = new Card('スペード', 'K');
    $evaluate_card = new EvaluateCard();
    $this->assertSame(1, $evaluate_card->evaluateCardPoint($card1));
    $this->assertSame(10, $evaluate_card->evaluateCardPoint($card2));
  }
}
