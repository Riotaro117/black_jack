<?php

namespace BlackJack;

class EvaluateCard
{
  public const ALL_CARDS_POINT = ['A' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, 'J' => 10, 'Q' => 10, 'K' => 10];

  // カードの点数を評価する
  public function evaluateCardPoint(Card $card): int
  {
    $number = $card->getNumber();
    $card_point = self::ALL_CARDS_POINT[$number];
    return $card_point;
  }
}
