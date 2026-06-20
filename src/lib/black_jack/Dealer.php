<?php

namespace BlackJack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/TotalScore.php');
class Dealer
{
  public $dealer_hand = [];

  // 山札をシャッフルする
  public function shuffleDeck(): array
  {
    $deck = new Deck();
    return $deck->shuffleDeck();
  }

  // プレイヤーの名前を宣言する
  public function stateMyName(): string
  {
    return 'ディーラー';
  }

  // 手札の点数を合計する
  public function totalScore(): int
  {
    $total_score = new TotalScore();
    return $total_score->totalScore($this->dealer_hand);
  }

  // 手札にカードを1枚加える
  public function addCardMyHand(): void
  {
    $deck = new Deck();
    $draw_card = $deck->drawCard();
    $this->dealer_hand[] = $draw_card;
  }

  // 直前に加えたカードの情報を取得する
  public function getPreviousCard(): Card
  {
    if ($this->dealer_hand === []) {
      throw new \LogicException('手札にカードがありません。');
    }
    $previous_card = array_pop($this->dealer_hand);
    return $previous_card;
  }

  // 合計が17点以上になるまでカードを引き続ける
  public function keepDrawing(): void
  {
    while ($this->totalScore() < 17) {
      // $this->totalScore()で毎回関数を読んでいるので、自動で計算が行われている
      $this->addCardMyHand();
    }
  }
}
