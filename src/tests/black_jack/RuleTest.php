<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\Dealer;
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
    $dealer->dealer_hand = [new Card('ハート', 'K'), new Card('スペード', 'K'), new Card('クラブ', 'Q')];
    $player = new PlayerA();
    $player->player_a_hand = [new Card('ハート', '2'), new Card('スペード', '4'), new Card('クラブ', 'Q')];
    $rule = new Rule();

    $this->assertSame('あなた', $rule->checkMoreThan21Points($dealer, $player));
  }
  public function testCheckNotOverCloseTo21Points(): void
  {
    // ディーラーの方が21点に近いとき
    $dealer = new Dealer();
    $dealer->dealer_hand = [new Card('ハート', '2'), new Card('スペード', 'K'), new Card('クラブ', '9')];
    $player = new PlayerA();
    $player->player_a_hand = [new Card('ハート', '2'), new Card('スペード', '4'), new Card('クラブ', 'Q')];
    $rule = new Rule();

    $this->assertSame('ディーラー', $rule->checkNotOverCloseTo21Points($dealer, $player));
  }
}
