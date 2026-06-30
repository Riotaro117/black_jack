<?php

namespace BlackJack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/HandTrait.php');
require_once(__DIR__ . '/CardHolder.php');
abstract class PlayerCpu extends Player implements CardHolder
{
    use HandTrait;

    abstract public function cpuApproach(Deck $deck): void;
}
