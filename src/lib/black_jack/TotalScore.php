<?php

namespace BlackJack;

require_once(__DIR__ . '/EvaluateCard.php');

class TotalScore
{
    /**
     * @param array<int,Card> $hand
     */
    public function totalScore(array $hand): int
    {
        // ポイントに変換する
        $evaluateCard = new EvaluateCard();
        $playerHandPoint = [];
        foreach ($hand as $card) {
            $playerHandPoint[] = $evaluateCard->evaluateCardPoint($card);
        }
        // 配列に含まれるポイントを合計する
        return array_sum($playerHandPoint);
    }
}
