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
    echo $message->dealerDrawSecondCardMessage($dealer, 'second') . PHP_EOL;




    
    // プレイヤーの得点を表示して、カードを引くか聞く（ループが必要かも）TODO
    echo $message->askDrawCardMessage($player) . PHP_EOL;

    // Yならカードを1枚ひく、Nならカードを引かない
    $response = $player->decideDrawAnotherCard();

    $rule->addAnotherCard($response, $player, $deck);

    // 引いたカードを表示する
    echo $message->drawCardMessage($player) . PHP_EOL;

    // プレイヤーの得点を表示して、カードを引くか聞く
    // 21点以上ならカードを引くかどうか聞かなくてもいい
    echo $message->askDrawCardMessage($player) . PHP_EOL;

    // Yならカードを1枚ひく、Nならカードを引かない
    $response = $player->decideDrawAnotherCard();

    $rule->addAnotherCard($response, $player, $deck);

    // ディーラーが2枚目に引いたカードを表示する
    echo $message->dealerDrawSecondCardMessage($dealer, 'second') . PHP_EOL;

    // ディーラーの現在の得点を表示する
    echo $message->pointMessage($dealer) . PHP_EOL;
    // ディーラーは17点以上になるようにカードを引き続ける
    $dealer->keepDrawing($deck);
    // 引いたカードを表示する(引きまくったら最後のカードしか表示されない)
    echo $message->drawCardMessage($dealer) . PHP_EOL;

    // 結果発表
    echo $message->pointMessage($player) . PHP_EOL;
    echo $message->pointMessage($dealer) . PHP_EOL;

    $result = $rule->checkNotOverCloseTo21Points($dealer, $player);

    echo $message->resultMessage($result) . PHP_EOL;

    echo 'ブラックジャックを終了します。' . PHP_EOL;

    return;
  }
}
