<?php

namespace BlackJack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/HandTrait.php');
require_once(__DIR__ . '/CardHolder.php');

class Dealer implements CardHolder
{
    use HandTrait;

    // 山札をシャッフルする
    public function shuffleDeck(Deck $deck): void
    {
        $deck->shuffleDeck();
    }

    // プレイヤーの名前を宣言する
    public function getMyName(): string
    {
        return 'ディーラー';
    }

    // ディーラーが2枚目に引いたカードを宣言するかどうか
    public function whetherOrNotToGetSecondCard(string $secret): bool
    {
        if ($secret === 'open') {
            return true;
        }
        return false;
    }

    // 合計が17点以上になるまでカードを引き続ける
    public function keepDrawing(Deck $deck): void
    {
        while ($this->totalScore() < 17) {
            // $this->totalScore()で毎回関数を読んでいるので、自動で計算が行われている
            $this->addCardMyHand($deck);
        }
    }
}
