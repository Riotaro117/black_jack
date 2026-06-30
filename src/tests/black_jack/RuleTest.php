<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\PlayerA;
use BlackJack\Rule;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/Rule.php');


class RuleTest extends TestCase
{
    public function testCheckMoreThan21Points(): void
    {
        // ディーラーが21点以上になってしまったとき
        $dealer = new Dealer();
        $dealer->hand = [new Card('ハート', 'K'), new Card('スペード', 'K'), new Card('クラブ', 'Q')];
        $player = new PlayerA();
        $player->hand = [new Card('ハート', '2'), new Card('スペード', '4'), new Card('クラブ', 'Q')];
        $rule = new Rule();

        $this->assertSame(['あなた', 'ディーラー'], $rule->checkNotOverCloseTo21Points($dealer, $player));
    }
    public function testCheckNotOverCloseTo21Points(): void
    {
        // ディーラーの方が21点に近いとき
        $dealer = new Dealer();
        $dealer->hand = [new Card('ハート', '2'), new Card('スペード', 'K'), new Card('クラブ', '9')];
        $player = new PlayerA();
        $player->hand = [new Card('ハート', '2'), new Card('スペード', '4'), new Card('クラブ', 'Q')];
        $rule = new Rule();

        $this->assertSame(['ディーラー', 'あなた'], $rule->checkNotOverCloseTo21Points($dealer, $player));
    }
    public function testLosePlayer(): void
    {
        // プレイヤーの得点が21点を超えているとき
        $dealer = new Dealer();
        $dealer->hand = [new Card('ハート', '2'), new Card('スペード', 'K'), new Card('クラブ', '8')];
        $player = new PlayerA();
        $player->hand = [new Card('ハート', '10'), new Card('スペード', '4'), new Card('クラブ', 'Q')];
        $rule = new Rule();

        $this->assertSame(['ディーラー', 'あなた'], $rule->checkNotOverCloseTo21Points($dealer, $player));
    }
}
