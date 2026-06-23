<?php

namespace BlackJack;

require_once(__DIR__ . '/Dealer.php');
require_once(__DIR__ . '/PlayerA.php');

class Rule
{
  private function winOfPlayer(int $dealer_total_score, int $player_total_score): bool
  {
    return (21 - $dealer_total_score) > (21 - $player_total_score);
  }
  private function winOfDealer(int $dealer_total_score, int $player_total_score): bool
  {
    return (21 - $dealer_total_score) < (21 - $player_total_score);
  }


  // どちらのスコアが21点に近いかチェック
  public function checkNotOverCloseTo21Points(Dealer $dealer, PlayerA $player): string
  {
    $dealer_total_score = $dealer->totalScore();
    $player_total_score = $player->totalScore();

    if ($player_total_score > 21) {
      return 'dealer';
    } elseif ($dealer_total_score > 21) {
      return 'player';
    } elseif ($this->winOfPlayer($dealer_total_score, $player_total_score)) {
      return 'player';
    } elseif ($this->winOfDealer($dealer_total_score, $player_total_score)) {
      return 'dealer';
    } else {
      return 'draw';
    }
  }
}
