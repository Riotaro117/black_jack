<?php

namespace BlackJack;

require_once(__DIR__ . '/PlayerA.php');
require_once(__DIR__ . '/CardHolder.php');
require_once(__DIR__ . '/PlayerCpuFirst.php');
require_once(__DIR__ . '/PlayerCpuSecond.php');
require_once(__DIR__ . '/Dealer.php');
require_once(__DIR__ . '/Message.php');
require_once(__DIR__ . '/Rule.php');

class Game
{
    public function __construct(private int $cpuNumber)
    {
    }
    public function start(): void
    {
        $deck = new Deck();
        $player = new PlayerA();
        $dealer = new Dealer();
        $message = new Message();
        $rule = new Rule();
        $cpuMember = $this->joinCpuNumber();
        // 山札をシャッフルする
        $dealer->shuffleDeck($deck);

        echo 'ブラックジャックを開始します。' . PHP_EOL;


        // 初回のカードを2枚引く処理を各プレイヤーごとにする
        $this->showDrawingCard($player, $deck, $message);

        // 各CPUがカードを2枚ずつ引く
        foreach($cpuMember as $cpu){
            $this->showDrawingCard($cpu,$deck,$message);
            $cpu->cpuApproach($deck);
        }

        $this->showDrawingCard($dealer, $deck, $message);

        // プレイヤーがカードを引くかどうかの繰り返しの処理
        $this->whetherPlayerDraw($message, $player, $deck);

        // ディーラーが2枚目に引いたカードを表示する
        echo $message->dealerDrawSecondCardMessage($dealer, 'open') . PHP_EOL;
        // ディーラーの現在の得点を表示する
        echo $message->pointMessage($dealer) . PHP_EOL;
        // ディーラーは17点以上になるようにカードを引き続ける
        $dealer->keepDrawing($deck);
        // 引いたカードを表示する(引きまくったら最後のカードしか表示されない)
        echo $message->drawCardMessage($dealer) . PHP_EOL;

        // 現在の得点発表
        echo $message->pointMessage($player) . PHP_EOL;


        foreach($cpuMember as $cpu){
            echo $message->pointMessage($cpu) . PHP_EOL;
        }

        echo $message->pointMessage($dealer) . PHP_EOL;

        // 結果を表示
        $this->showResult($rule, $dealer, $player, $message);

        foreach($cpuMember as $cpu){
            $this->showResult($rule,$dealer,$cpu,$message);
        }

        echo 'ブラックジャックを終了します。' . PHP_EOL;
    }

    public function whetherPlayerDraw(Message $message, PlayerA $player, Deck $deck): void
    {
        while ($player->totalScore() < 21) {
            // プレイヤーの得点を表示して、カードを引くか聞く
            echo $message->askDrawCardMessage($player) . PHP_EOL;

            // Yならカードを1枚ひく、Nならカードを引かない
            $response = $player->decideDrawAnotherCard();

            if ($response === 'Y') {
                $player->addCardMyHand($deck);
            } else {
                break;
            }

            // 引いたカードを表示する
            echo $message->drawCardMessage($player) . PHP_EOL;
        }
    }

    // 初回の各プレイヤーの1枚目と2枚目のカードを引く処理
    public function showDrawingCard(CardHolder $cardHolder, Deck $deck, Message $message): void
    {
        // 1回目プレイヤーがカードを引く
        $cardHolder->addCardMyHand($deck);
        // 1回目引いたカードを表示する
        echo $message->drawCardMessage($cardHolder) . PHP_EOL;

        // 2回目プレイヤーがカードを引く
        $cardHolder->addCardMyHand($deck);

        if ($cardHolder instanceof PlayerA) {
            // 2回目引いたカードを表示する
            echo $message->drawCardMessage($cardHolder) . PHP_EOL;
        }
        if ($cardHolder instanceof PlayerCpuFirst || $cardHolder instanceof PlayerCpuSecond || $cardHolder instanceof Dealer) {
            // 2回目ディーラーやCPUが引いたカードは表示しない
            echo $message->dealerDrawSecondCardMessage($cardHolder, 'secret') . PHP_EOL;
        }
    }

    /**
     * @return array<int,PlayerCpu>
     */
    public function joinCpuNumber(): array
    {
        $cpu = [];
        if ($this->cpuNumber === 1) {
            $cpu = [new PlayerCpuFirst()];
        }
        if ($this->cpuNumber === 2) {
            $cpu = [new PlayerCpuFirst(), new PlayerCpuSecond()];
        }
        return $cpu;
    }

    public function showResult(Rule $rule, Dealer $dealer, Player $player, Message $message): void
    {
        // 得点を比べて結果を出力
        $result = $rule->checkNotOverCloseTo21Points($dealer, $player);
        // 結果発表
        echo $message->resultMessage($result) . PHP_EOL;
    }
}
