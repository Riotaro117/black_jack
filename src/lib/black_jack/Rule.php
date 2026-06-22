<?php

namespace BlackJack;

require_once(__DIR__ . '/Dealer.php');
require_once(__DIR__ . '/PlayerA.php');

class Rule
{
  private function winOfPlayer(int $dealer_total_score, int $player_total_score): bool
  {
    return (21 - $dealer_total_score) > (21 - $player_total_score) || $dealer_total_score > 21;
  }
  private function winOfDealer(int $dealer_total_score, int $player_total_score): bool
  {
    return (21 - $dealer_total_score) < (21 - $player_total_score) || $player_total_score > 21;
  }


  // Yesならカードを追加で引く、Nならカードを引かない
  public function addAnotherCard(string $response, PlayerA $player, Deck $deck): void
  {
    // Playerは外部からの要素なので新規に作成すると別のプレイヤーになってしまう
    if ($response === 'Y') {
      $player->addCardMyHand($deck);
    } else {
      return;
    }
  }

  // どちらのスコアが21点に近いかチェック
  public function checkNotOverCloseTo21Points(Dealer $dealer, PlayerA $player): string
  {
    $dealer_total_score = $dealer->totalScore();
    $player_total_score = $player->totalScore();
    if ($this->winOfPlayer($dealer_total_score, $player_total_score)) {
      return 'player';
    } elseif ($this->winOfDealer($dealer_total_score, $player_total_score)) {
      return 'dealer';
    } else {
      return 'continue';
    }
  }
}
