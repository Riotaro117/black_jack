<?php

namespace BlackJack;

require_once(__DIR__ . '/Dealer.php');
require_once(__DIR__ . '/PlayerA.php');

class Rule
{
    private function winOfPlayer(int $dealerTotalScore, int $playerTotalScore): bool
    {
        return (21 - $dealerTotalScore) > (21 - $playerTotalScore);
    }
    private function winOfDealer(int $dealerTotalScore, int $playerTotalScore): bool
    {
        return (21 - $dealerTotalScore) < (21 - $playerTotalScore);
    }


    // どちらのスコアが21点に近いかチェック
    public function checkNotOverCloseTo21Points(Dealer $dealer, PlayerA $player): string
    {
        $dealerTotalScore = $dealer->totalScore();
        $playerTotalScore = $player->totalScore();

        if ($playerTotalScore > 21) {
            return 'dealer';
        } elseif ($dealerTotalScore > 21) {
            return 'player';
        } elseif ($this->winOfPlayer($dealerTotalScore, $playerTotalScore)) {
            return 'player';
        } elseif ($this->winOfDealer($dealerTotalScore, $playerTotalScore)) {
            return 'dealer';
        }
        return 'draw';
    }
}
