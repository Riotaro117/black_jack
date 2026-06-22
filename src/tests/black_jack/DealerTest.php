<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\TotalScore;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/Dealer.php');


class DealerTest extends TestCase
{
  public function testKeepDrawing(): void
  {
    // 17点以上なら引かない
    $deck = new Deck();
    $dealer = new Dealer();
    $dealer->dealer_hand = [new Card('ハート', 'K'), new Card('ダイヤ', 'Q')];
    $total_score = new TotalScore();
    $before_score1 = $total_score->totalScore($dealer->dealer_hand);
    $dealer->keepDrawing($deck);
    $after_score = $total_score->totalScore($dealer->dealer_hand);
    $this->assertSame($before_score1, $after_score);

    // 17点未満ならカードが増える
    $dealer->dealer_hand = [new Card('ハート', '6'), new Card('ダイヤ', 'Q')];
    $dealer->keepDrawing($deck);
    $this->assertSame(3, count($dealer->dealer_hand));
  }
}
