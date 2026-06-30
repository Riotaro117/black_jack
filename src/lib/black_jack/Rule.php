<?php

namespace BlackJack;

require_once(__DIR__ . '/Dealer.php');
require_once(__DIR__ . '/Player.php');

class Rule
{
    // どちらのスコアが21点に近いかチェック

    /**
     * @return array<int,string>
     */
    public function checkNotOverCloseTo21Points(Dealer $dealer, Player $player): array
    {
        $dealerTotalScore = $dealer->totalScore();
        $playerTotalScore = $player->totalScore();

        // 配列の要素の0番目に勝者、1番目に敗者を入れる
        if ($playerTotalScore > 21) {
            return [$dealer->getMyName(), $player->getMyName()];
        }
        if ($dealerTotalScore > 21) {
            return [$player->getMyName(), $dealer->getMyName()];
        }
        if ($playerTotalScore > $dealerTotalScore) {
            return [$player->getMyName(), $dealer->getMyName()];
        }
        if ($dealerTotalScore > $playerTotalScore) {
            return [$dealer->getMyName(), $player->getMyName()];
        }
        return [];
    }
}
