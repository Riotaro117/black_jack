<?php

namespace BlackJack;

use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\EvaluateCard;
use LogicException;

require_once(__DIR__ . '/EvaluateCard.php');

trait HandTrait
{
    /**
     * @var array<int,Card> $hand
     */
    public array $hand = [];

    // 手札にカードを1枚加える
    public function addCardMyHand(Deck $deck): void
    {
        $drawCard = $deck->drawCard();
        $this->hand[] = $drawCard;
    }

    // 手札の点数を合計する
    public function totalScore(): int
    {
        $totalScore = 0;
        $aceCount = 0;
        $evaluateCard = new EvaluateCard();
        foreach ($this->hand as $card) {
            $number = $card->getNumber();
            if ($number === 'A') {
                $aceCount += 1;
            }
            $totalScore += $evaluateCard->evaluateCardPoint($card);
        }

        while ($totalScore > 21 && $aceCount > 0) {
            $totalScore -= 10;
            $aceCount -= 1;
        }
        return $totalScore;
    }

    // 直前に加えたカードの情報を取得する
    public function getPreviousCard(): Card
    {
        if ($this->hand === []) {
            throw new LogicException('手札にカードがありません。');
        }
        $previousCard = end($this->hand);
        return $previousCard;
    }
}
