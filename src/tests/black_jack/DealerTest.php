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
        $dealer->hand = [new Card('ハート', 'K'), new Card('ダイヤ', 'Q')];
        $totalScore = new TotalScore();
        $beforeScore1 = $totalScore->totalScore($dealer->hand);
        $dealer->keepDrawing($deck);
        $afterScore = $totalScore->totalScore($dealer->hand);
        $this->assertSame($beforeScore1, $afterScore);

        // 17点未満ならカードが増える
        $dealer->hand = [new Card('ハート', '6'), new Card('ダイヤ', 'Q')];
        $dealer->keepDrawing($deck);
        $this->assertSame(3, count($dealer->hand));
    }
}
