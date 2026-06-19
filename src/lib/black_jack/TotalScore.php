<?php

namespace BlackJack;

require_once(__DIR__ . '/EvaluateCard.php');

class TotalScore
{

  public function totalScore(array $player_hand): int
  {
    // ポイントに変換する
    $evaluate_card = new EvaluateCard();
    $player_hand_point = [];
    foreach ($player_hand as $card) {
      $player_hand_point[] = $evaluate_card->evaluateCardPoint($card);
    }
    // 配列に含まれるポイントを合計する
    return array_sum($player_hand_point);
  }
}
