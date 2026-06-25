<?php

namespace BlackJack;

require_once(__DIR__ . '/Dealer.php');
require_once(__DIR__ . '/PlayerA.php');

class Rule
{
    // どちらのスコアが21点に近いかチェック
    public function checkNotOverCloseTo21Points(Dealer $dealer, PlayerA $player): string
    {
        $dealerTotalScore = $dealer->totalScore();
        $playerTotalScore = $player->totalScore();

        if ($playerTotalScore > 21) {
            return 'dealer';
        }
        if ($dealerTotalScore > 21) {
            return 'player';
        }
        if ($playerTotalScore > $dealerTotalScore) {
            return 'player';
        }
        if ($dealerTotalScore > $playerTotalScore) {
            return 'dealer';
        }
        return 'draw';
    }
}
