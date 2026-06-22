<?php

namespace BlackJack;

use BlackJack\Dealer;
use BlackJack\PlayerA;

class Message
{

  // 直前に引いたカードのメッセージを表示
  public function drawCardMessage(PlayerA | Dealer $player): string
  {
    $player_name = $player->getMyName();
    $previous_card = $player->getPreviousCard();

    return "{$player_name}の引いたカードは{$previous_card->getSuit()}の{$previous_card->getNumber()}です。";
  }

  // ディーラーの2枚目に引いたカードのメッセージを表示切り替え
  public function dealerDrawSecondCardMessage(Dealer $dealer, string $time): string
  {
    $previous_card = $dealer->getPreviousCard();
    $whether_or_not_show_card = $dealer->whetherOrNotToGetSecondCard($time);

    if ($whether_or_not_show_card) {
      return "ディーラーの引いた2枚目のカードは{$previous_card->getSuit()}の{$previous_card->getNumber()}です。";
    } else {
      return "ディーラーの引いた2枚目のカードは分かりません。";
    }
  }

  // プレイヤーの得点を表示してカードを引くかメッセージを表示
  public function askDrawCardMessage(PlayerA $player): string
  {
    $total_score = $player->totalScore();

    return "あなたの現在の得点は{$total_score}です。カードを引きますか？" . '(Y/N)';
  }

  // プレイヤーとディーラーの最終得点を表示するメッセージ
  public function pointMessage(PlayerA |Dealer $player): string
  {
    $player_name = $player->getMyName();
    $total_score = $player->totalScore();

    return "{$player_name}の得点は{$total_score}です。";
  }

  // 結果を表示するメッセージ
  public function resultMessage(string $result): string
  {
    if ($result === 'player') {
      return 'あなたの勝ちです';
    } elseif ($result === 'dealer') {
      return 'ディーラーの勝ちです。';
    } else {
      return '引き分けです。';
    }
  }
}
