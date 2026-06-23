<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\TotalScore;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/TotalScore.php');


class TotalScoreTest extends TestCase
{
    public function testTotalScore(): void
    {
        $card1 = new Card('ハート', 'K');
        $card2 = new Card('スペード', '6');
        $card3 = new Card('クラブ', '2');
        $playerHand = [$card1, $card2, $card3];
        $totalScore = new TotalScore();
        $this->assertSame(18, $totalScore->TotalScore($playerHand));
    }
}
