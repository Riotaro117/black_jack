<?php

namespace BlackJack\Tests;

use BlackJack\Card;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/black_jack/Card.php');


class CardTest extends TestCase
{
    public function testGetSuit(): void
    {
        $card = new Card('ハート', 'A');
        $this->assertSame('ハート', $card->getSuit());
    }
    public function testGetNumber(): void
    {
        $card = new Card('ハート', 'A');
        $this->assertSame('A', $card->getNumber());
        $card = new Card('ハート', '2');
        $this->assertSame('2', $card->getNumber());
    }
}
