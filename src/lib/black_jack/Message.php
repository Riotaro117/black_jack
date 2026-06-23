<?php

namespace BlackJack;

use BlackJack\Dealer;
use BlackJack\PlayerA;

class Message
{
    // 直前に引いたカードのメッセージを表示
    public function drawCardMessage(PlayerA | Dealer $player): string
    {
        $playerName = $player->getMyName();
        $previousCard = $player->getPreviousCard();

        return "{$playerName}の引いたカードは{$previousCard->getSuit()}の{$previousCard->getNumber()}です。";
    }

    // ディーラーの2枚目に引いたカードのメッセージを表示切り替え
    public function dealerDrawSecondCardMessage(Dealer $dealer, string $secret): string
    {
        $previousCard = $dealer->getPreviousCard();
        $showCard = $dealer->whetherOrNotToGetSecondCard($secret);

        if ($showCard) {
            return "ディーラーの引いた2枚目のカードは{$previousCard->getSuit()}の{$previousCard->getNumber()}です。";
        }
        return "ディーラーの引いた2枚目のカードは分かりません。";
    }

    // プレイヤーの得点を表示してカードを引くかメッセージを表示
    public function askDrawCardMessage(PlayerA $player): string
    {
        $totalScore = $player->totalScore();

        return "あなたの現在の得点は{$totalScore}です。カードを引きますか？" . '(Y/N)';
    }

    // プレイヤーとディーラーの最終得点を表示するメッセージ
    public function pointMessage(PlayerA |Dealer $player): string
    {
        $playerName = $player->getMyName();
        $totalScore = $player->totalScore();

        return "{$playerName}の得点は{$totalScore}です。";
    }

    // 結果を表示するメッセージ
    public function resultMessage(string $result): string
    {
        if ($result === 'player') {
            return 'あなたの勝ちです';
        } elseif ($result === 'dealer') {
            return 'ディーラーの勝ちです。';
        }
        return '引き分けです。';
    }
}
