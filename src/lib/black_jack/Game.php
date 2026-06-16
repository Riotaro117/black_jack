<?php

namespace BlackJack;

class Game
{


  public function start(): void
  {
    echo 'ブラックジャックを開始します。' . PHP_EOL;

    echo "あなたの引いたカードは{}の{}です。" . PHP_EOL;
    echo "あなたの引いたカードは{}の{}です。" . PHP_EOL;
    echo "ディーラーの引いたカードは{}の{}です。" . PHP_EOL;
    echo "ディーラーの引いた２枚目のカードは分かりません。" . PHP_EOL;
    echo "あなたの現在の得点は{}です。カードを引きますか？" . '(Y/N)' . PHP_EOL;

    echo "あなたの引いたカードは{}の{}です。" . PHP_EOL;
    echo "あなたの現在の得点は{}です。カードを引きますか？" . '(Y/N)' . PHP_EOL;

    echo "ディーラーの引いた２枚目のカードは{}の{}でした。" . PHP_EOL;
    echo "ディーラーの現在の得点は{}です。" . PHP_EOL;
    echo "ディーラーの引いたカードは{}の{}です。" . PHP_EOL;

    echo "あなたの得点は{}です。" . PHP_EOL;
    echo "ディーラーの得点は{}です。" . PHP_EOL;
    echo "あなたの{}です！" . PHP_EOL;

    echo 'ブラックジャックを終了します。' . PHP_EOL;

    return;
  }
}
