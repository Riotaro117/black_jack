<?php

namespace BlackJack;

use BlackJack\PlayerA;

class Message
{
    // 直前に引いたカードのメッセージを表示
    public function drawCardMessage(CardHolder $cardHolder): string
    {
        $cardHolderName = $cardHolder->getMyName();
        $previousCard = $cardHolder->getPreviousCard();

        return "{$cardHolderName}の引いたカードは{$previousCard->getSuit()}の{$previousCard->getNumber()}です。";
    }

    // 2枚目に引いたカードのメッセージを表示切り替え
    public function dealerDrawSecondCardMessage(CardHolder $cardHolder, string $secret): string
    {
        $previousCard = $cardHolder->getPreviousCard();
        $showCard = $cardHolder->showSecondCard($secret);

        if ($showCard) {
            return "{$cardHolder->getMyName()}の引いた2枚目のカードは{$previousCard->getSuit()}の{$previousCard->getNumber()}です。";
        }
        return "{$cardHolder->getMyName()}の引いた2枚目のカードは分かりません。";
    }

    // プレイヤーの得点を表示してカードを引くかメッセージを表示
    public function askDrawCardMessage(PlayerA $player): string
    {
        $totalScore = $player->totalScore();

        return "あなたの現在の得点は{$totalScore}です。カードを引きますか？" . '(Y/N)';
    }

    // プレイヤーとディーラーの最終得点を表示するメッセージ
    public function pointMessage(CardHolder $cardHolder): string
    {
        $cardHolderName = $cardHolder->getMyName();
        $totalScore = $cardHolder->totalScore();

        return "{$cardHolderName}の得点は{$totalScore}です。";
    }

    // 結果を表示するメッセージ
    /**
     * @param array<int,string> $result
     */
    public function resultMessage(array $result): string
    {
        if ($result === []) {
            return '引き分けです。';
        }
        return "{$result[0]}の勝ちで{$result[1]}の負けです。";
    }
}
