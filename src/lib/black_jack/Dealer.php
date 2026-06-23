<?php

namespace BlackJack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/TotalScore.php');
class Dealer
{
  public $dealer_hand = [];

  // 山札をシャッフルする
  public function shuffleDeck(Deck $deck): void
  {
    $deck->shuffleDeck();
  }

  // プレイヤーの名前を宣言する
  public function getMyName(): string
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
  public function addCardMyHand(Deck $deck): void
  {
    $draw_card = $deck->drawCard();
    $this->dealer_hand[] = $draw_card;
  }

  // 直前に加えたカードの情報を取得する
  public function getPreviousCard(): Card
  {
    if ($this->dealer_hand === []) {
      throw new \LogicException('手札にカードがありません。');
    }
    $previous_card = end($this->dealer_hand);
    return $previous_card;
  }

  // ディーラーが2枚目に引いたカードを宣言するかどうか
  public function whetherOrNotToGetSecondCard(string $secret): bool
  {
    if ($secret === 'open') {
      return true;
    } else {
      return false;
    }
  }

  // 合計が17点以上になるまでカードを引き続ける
  public function keepDrawing(Deck $deck): void
  {
    while ($this->totalScore() < 17) {
      // $this->totalScore()で毎回関数を読んでいるので、自動で計算が行われている
      $this->addCardMyHand($deck);
    }
  }
}
