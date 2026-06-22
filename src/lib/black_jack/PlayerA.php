<?php

namespace BlackJack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/Player.php');
class PlayerA extends Player
{

  public $player_a_hand = [];

  // プレイヤーの名前を宣言する
  public function getMyName(): string
  {
    return 'あなた';
  }

  // 手札にカードを1枚加える
  public function addCardMyHand(Deck $deck): void
  {
    $draw_card = $deck->drawCard();
    $this->player_a_hand[] = $draw_card;
  }

  // 手札の点数を合計する
  public function totalScore(): int
  {
    $total_score = new TotalScore();
    return $total_score->totalScore($this->player_a_hand);
  }

  // 直前に加えたカードの情報を取得する
  public function getPreviousCard(): Card
  {
    if ($this->player_a_hand === []) {
      throw new \LogicException('手札にカードがありません。');
    }
    $previous_card = end($this->player_a_hand);
    return $previous_card;
  }

  // カードを追加で引くかどうかを答える
  public function decideDrawAnotherCard(): string
  {
    //  入力はYかNのみ
    return trim(fgets(STDIN));
  }
}
