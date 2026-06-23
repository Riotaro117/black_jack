<?php

namespace BlackJack;

require_once(__DIR__ . '/PlayerA.php');
require_once(__DIR__ . '/Dealer.php');
require_once(__DIR__ . '/Message.php');
require_once(__DIR__ . '/Rule.php');

class Game
{
  public function start(): void
  {
    $deck = new Deck();
    $player = new PlayerA();
    $dealer = new Dealer();
    $message = new Message();
    $rule = new Rule();
    echo 'ブラックジャックを開始します。' . PHP_EOL;

    // 山札をシャッフルする
    $dealer->shuffleDeck($deck);

    // 1回目プレイヤーがカードを引く
    $player->addCardMyHand($deck);
    // 1回目引いたカードを表示する
    echo $message->drawCardMessage($player) . PHP_EOL;

    // 2回目プレイヤーがカードを引く
    $player->addCardMyHand($deck);
    // 2回目引いたカードを表示する
    echo $message->drawCardMessage($player) . PHP_EOL;

    // 1回目ディーラーがカードを引く
    $dealer->addCardMyHand($deck);
    // 1回目引いたカードを表示する
    echo $message->drawCardMessage($dealer) . PHP_EOL;

    // 2回目ディーラーがカードを引く
    $dealer->addCardMyHand($deck);
    // 2回目ディーラーが引いたカードは表示しない
    echo $message->dealerDrawSecondCardMessage($dealer, 'secret') . PHP_EOL;

    // 繰り返しの処理
    $this->whetherPlayerDraw($message, $player, $deck);

    // ディーラーが2枚目に引いたカードを表示する
    echo $message->dealerDrawSecondCardMessage($dealer, 'open') . PHP_EOL;
    // ディーラーの現在の得点を表示する
    echo $message->pointMessage($dealer) . PHP_EOL;
    // ディーラーは17点以上になるようにカードを引き続ける
    $dealer->keepDrawing($deck);
    // 引いたカードを表示する(引きまくったら最後のカードしか表示されない)
    echo $message->drawCardMessage($dealer) . PHP_EOL;

    // 現在の得点発表
    echo $message->pointMessage($player) . PHP_EOL;
    echo $message->pointMessage($dealer) . PHP_EOL;

    // 得点を比べて結果を出力
    $result = $rule->checkNotOverCloseTo21Points($dealer, $player);
    // 結果発表
    echo $message->resultMessage($result) . PHP_EOL;

    echo 'ブラックジャックを終了します。' . PHP_EOL;
  }

  public function whetherPlayerDraw(Message $message, PlayerA $player, Deck $deck): void
  {
    while ($player->totalScore() < 21) {

      // プレイヤーの得点を表示して、カードを引くか聞く
      echo $message->askDrawCardMessage($player) . PHP_EOL;

      // Yならカードを1枚ひく、Nならカードを引かない
      $response = $player->decideDrawAnotherCard();

      if ($response == 'Y') {
        $player->addCardMyHand($deck);
      } else {
        break;
      }

      // 引いたカードを表示する
      echo $message->drawCardMessage($player) . PHP_EOL;
    }
  }
}
