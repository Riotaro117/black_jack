<?php

namespace BlackJack;

require_once(__DIR__ . '/HandTrait.php');
require_once(__DIR__ . '/CardHolder.php');
require_once(__DIR__ . '/PlayerCpu.php');

class PlayerCpuSecond extends PlayerCpu
{
    // プレイヤーの名前を宣言する
    public function getMyName(): string
    {
        return 'ルイージ';
    }

    // 慎重な思考（15点未満なら引き続ける）
    public function cpuApproach(Deck $deck): void
    {
        while ($this->totalScore() < 15) {
            // $this->totalScore()で毎回関数を読んでいるので、自動で計算が行われている
            $this->addCardMyHand($deck);
        }
    }
}
