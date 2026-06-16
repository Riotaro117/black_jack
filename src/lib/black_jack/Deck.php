<?php
namespace BlackJack;


require_once(__DIR__ . '/Card.php');

class Deck
{
  public const ALL_SUITS = ['ハート', 'クラブ', 'スペード', 'ダイヤ'];
  public const ALL_NUMBERS = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
  public $cards = []; // 本来はprivateが望ましい

  public function __construct()
  {
    foreach (self::ALL_SUITS as $suit) {
      foreach (self::ALL_NUMBERS as $number) {
        $this->cards[] = new Card($suit, $number);
      }
    }
  }

  public function shuffleDeck(): array
  {
    // ['HA','H2'......,'DK']合計52枚が整列して入ってくる
    // 最後尾は0からスタートの51番目
    for ($i = count($this->cards) - 1; $i > 0; $i--) {
      $j = mt_rand(0, $i);
      [$this->cards[$i], $this->cards[$j]] = [$this->cards[$j], $this->cards[$i]];
    }
    return $this->cards;
  }

  public function drawCard(): Card
  {
    if (count($this->cards) === 0) {
      // ロジックの例外エラー
      throw new \LogicException('山札がありません');
    }
    // 山札の一番上からカードを取り出す
    $draw_card = array_pop($this->cards);
    return $draw_card;
  }
}
