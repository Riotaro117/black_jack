<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\PlayerCpuFirst;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/PlayerCpuSecond.php');


class PlayerCpuSecondTest extends TestCase
{
    public function testKeepDrawing(): void
    {
        // 15点以上なら引かない
        $deck = new Deck();
        $cpuFirst = new PlayerCpuFirst();
        $cpuFirst->hand = [new Card('ハート', 'K'), new Card('ダイヤ', 'A')];
        $beforeScore1 = $cpuFirst->totalScore();
        $cpuFirst->cpuApproach($deck);
        $afterScore = $cpuFirst->totalScore();
        $this->assertSame($beforeScore1, $afterScore);

        // 15点未満ならカードが増える
        $cpuFirst->hand = [new Card('ハート', '3'), new Card('ダイヤ', 'Q')];
        $cpuFirst->cpuApproach($deck);
        $this->assertSame(3, count($cpuFirst->hand));
    }
}
