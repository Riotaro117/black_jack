<?php

namespace BlackJack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/Player.php');
class PlayerA extends Player
{

  public $player_a_hand = [];

  // 手札にカードを1枚加える
  public function addCardMyHand(): void
  {
    $deck = new Deck();
    $draw_card = $deck->drawCard();
    $this->player_a_hand[] = $draw_card;
  }

  // 手札にカードを加えない
  public function doNotAddCard(): void
  {
    return;
  }

  // 直前に加えたカードの情報を取得する
  public function getPreviousCard(): string
  {
    if ($this->player_a_hand === []) {
      throw new \LogicException('手札にカードがありません。');
    }
    $previous_card = array_pop($this->player_a_hand);
    return $previous_card;
  }
}
