<?php

namespace BlackJack;

class Card
{
    public function __construct(public string $suit, public string $number)
    {
    }

    public function getSuit(): string
    {
        return $this->suit;
    }
    public function getNumber(): string
    {
        return $this->number;
    }
}
