<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\PlayerA;
use PHPUnit\Framework\TestCase;

class HandTraitTest extends TestCase
{
    public function testTotalScore(): void
    {
        // 手札が[A,A,2]の時
        $player = new PlayerA();
        $card1 = new Card('ハート', 'A');
        $card2 = new Card('ダイヤ', 'A');
        $card3 = new Card('クラブ', '2');
        $player->hand = [$card1, $card2, $card3];

        $this->assertSame(14, $player->totalScore());
    }
    public function testTotalScoreV2(): void
    {
        // 手札が[A,A,2]の時
        $player = new PlayerA();
        $card1 = new Card('ハート', 'A');
        $card2 = new Card('ダイヤ', '10');
        $card3 = new Card('クラブ', '2');
        $player->hand = [$card1, $card2, $card3];

        $this->assertSame(13, $player->totalScore());
    }
    public function testTotalScoreV3(): void
    {
        // 手札が[A,A,2]の時
        $player = new PlayerA();
        $card1 = new Card('ハート', 'A');
        $card2 = new Card('ダイヤ', 'K');
        $card3 = new Card('クラブ', '2');
        $card4 = new Card('クラブ', '8');
        $player->hand = [$card1, $card2, $card3, $card4];

        $this->assertSame(21, $player->totalScore());
    }
}
