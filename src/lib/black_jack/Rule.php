<?php

namespace BlackJack;

require_once(__DIR__ . '/Dealer.php');
require_once(__DIR__ . '/PlayerA.php');

class Rule
{
  // 21点以内にスコアがおさまっているかチェック
  public function checkMoreThan21Points(Dealer $dealer, PlayerA $player): string
  {
    $dealer_total_score = $dealer->totalScore();
    $player_total_score = $player->totalScore();
    if ($dealer_total_score > 21) {
      return 'player';
    } elseif ($player_total_score > 21) {
      return 'dealer';
    } else {
      return 'continue';
    }
  }

  // どちらのスコアが21点に近いかチェック
  public function checkNotOverCloseTo21Points(Dealer $dealer, PlayerA $player): string
  {
    $dealer_total_score = $dealer->totalScore();
    $player_total_score = $player->totalScore();
    if ((21 - $dealer_total_score) > (21 - $player_total_score)) {
      return 'player';
    } elseif ((21 - $dealer_total_score) < (21 - $player_total_score)) {
      return 'dealer';
    } else {
      return 'continue';
    }
  }
}
