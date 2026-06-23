<?php

namespace BlackJack\Tests;

use BlackJack\Deck;
use LogicException;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/Deck.php');


class DeckTest extends TestCase
{
    public function testShuffleKeepCards(): void
    {
        $deck = new Deck();
        $this->assertCount(52, $deck->cards);
    }
    public function testShuffleDoesNotLoseOrDuplicate(): void
    {
        $deck = new Deck();
        // シャッフルする前
        $before = array_map(fn($card) => $card->suit . $card->number, $deck->cards);
        sort($before);
        // シャッフルした後
        $deck->shuffleDeck();
        $after = array_map(fn($card) => $card->suit . $card->number, $deck->cards);
        sort($after);
        $this->assertSame($before, $after);
    }

    public function testDrawCardReduce(): void
    {
        // カードが減っているか
        $deck = new Deck();
        $deck->drawCard();
        $this->assertCount(
            51,
            $deck->cards
        );
    }
    public function testDrawCardError(): void
    {
        // 52枚全てカードを引く
        $deck = new Deck();
        for ($i = 0; $i < 52; $i++) {
            $deck->drawCard();
        }
        // 53枚目で例外の処理
        $this->expectException(LogicException::class);
        $deck->drawCard();
    }
}
