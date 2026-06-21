<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use BlackJack\Dealer;
use BlackJack\Message;
use BlackJack\PlayerA;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/Message.php');


class MessageTest extends TestCase
{
  // 直前に引いたカードのメッセージを表示
  public function testDrawCardMessage(): void
  {
    $message = new Message();
    $player = new PlayerA();
    $player->player_a_hand = [new Card('ハート', 'A')];
    $this->assertSame('あなたの引いたカードはハートのAです。', $message->drawCardMessage($player));
  }

  // ディーラーの2枚目に引いたカードのメッセージを表示切り替え
  public function testDealerDrawSecondCardMessage(): void
  {
    $message = new Message();
    $dealer = new Dealer();
    $dealer->dealer_hand = [new Card('ハート', 'A')];
    $this->assertSame('ディーラーの引いた2枚目のカードは分かりません。', $message->dealerDrawSecondCardMessage($dealer, 'first'));
  }

  // プレイヤーの得点を表示してカードを引くかメッセージを表示
  public function testAskDrawCardMessage(): void
  {

    $player = new PlayerA();
    $player->player_a_hand = [new Card('ハート', '4'), new Card('ハート', 'K'), new Card('ハート', '3'),];
    $message = new Message();
    $this->assertSame("あなたの現在の得点は17です。カードを引きますか？" . '(Y/N)', $message->askDrawCardMessage($player));
  }
  // プレイヤーとディーラーの最終得点を表示するメッセージ
  public function testPointMessage(): void
  {
    $player = new PlayerA();
    $player->player_a_hand = [new Card('ハート', '4'), new Card('ハート', 'K'), new Card('ハート', '3'),];
    $message = new Message();

    $this->assertSame("あなたの得点は17です。", $message->pointMessage($player));
  }
}
