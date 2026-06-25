<?php

namespace BlackJack;

use BlackJack\Card;
use BlackJack\Deck;

// ゲーム中カードを持つ人に共通する処理
interface CardHolder
{
    // プレイヤーの名前を宣言する
    public function getMyName(): string;

    // 手札にカードを1枚加える
    public function addCardMyHand(Deck $deck): void;

    // 手札の点数を合計する
    public function totalScore(): int;

    // 直前に加えたカードの情報を取得する
    public function getPreviousCard(): Card;
}
