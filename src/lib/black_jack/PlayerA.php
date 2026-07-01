<?php

namespace BlackJack;

require_once(__DIR__ . '/HandTrait.php');
require_once(__DIR__ . '/CardHolder.php');
require_once(__DIR__ . '/Player.php');

class PlayerA extends Player
{
    // プレイヤーの名前を宣言する
    public function getMyName(): string
    {
        return 'あなた';
    }

    // カードを追加で引くかどうかを答える
    public function decideDrawAnotherCard(): string
    {
        //  入力はYかNのみ
        return trim(fgets(STDIN));
    }
}
