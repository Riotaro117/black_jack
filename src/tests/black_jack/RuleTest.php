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
  // Yesならカードを追加で引く
  public function testAddAnotherCard(): void
  {
    $player = new PlayerA();
    $rule = new Rule();
    $rule->addAnotherCard('Y', $player);
    $this->assertSame(1, count($player->player_a_hand));
  }
  // Noならカードを追加で引かない
  public function testANotAddAnotherCard(): void
  {
    $player = new PlayerA();
    $rule = new Rule();
    $rule->addAnotherCard('N', $player);
    $this->assertSame(0, count($player->player_a_hand));
  }
  public function testCheckMoreThan21Points(): void
  {
    // ディーラーが21点以上になってしまったとき
    $dealer = new Dealer();
    $dealer->dealer_hand = [new Card('ハート', 'K'), new Card('スペード', 'K'), new Card('クラブ', 'Q')];
    $player = new PlayerA();
    $player->player_a_hand = [new Card('ハート', '2'), new Card('スペード', '4'), new Card('クラブ', 'Q')];
    $rule = new Rule();

    $this->assertSame('player', $rule->checkNotOverCloseTo21Points($dealer, $player));
  }
  public function testCheckNotOverCloseTo21Points(): void
  {
    // ディーラーの方が21点に近いとき
    $dealer = new Dealer();
    $dealer->dealer_hand = [new Card('ハート', '2'), new Card('スペード', 'K'), new Card('クラブ', '9')];
    $player = new PlayerA();
    $player->player_a_hand = [new Card('ハート', '2'), new Card('スペード', '4'), new Card('クラブ', 'Q')];
    $rule = new Rule();

    $this->assertSame('dealer', $rule->checkNotOverCloseTo21Points($dealer, $player));
  }
}
