<?php

namespace BlackJack;

require_once(__DIR__ . '/Deck.php');
abstract class Player
{
  // プレイヤーの名前を宣言する
  abstract public function getMyName(): string;
  // 手札にカードを1枚加える
  abstract public function addCardMyHand(Deck $deck): void;
  // 手札の点数を合計する
  abstract public function totalScore(): int;
  // 直前に加えたカードの情報を取得する
  abstract public function getPreviousCard(): Card;
}
