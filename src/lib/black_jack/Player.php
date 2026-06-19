<?php

namespace BlackJack;

require_once(__DIR__ . '/Deck.php');
abstract class Player
{
  // 手札にカードを1枚加える
  abstract public function addCardMyHand();
  // 直前に加えたカードの情報を取得する
  abstract public function getPreviousCard();
}
