# PHP ブラックジャック（CLI版）

PHPのオブジェクト指向設計を実践するために作成した、コマンドライン上で動作するブラックジャックゲームです。転職活動におけるポートフォリオとして、設計力・実装力・品質意識をアピールするために公開しています。

---

## デモ

![Seat Tree Demo](public/demo.gif)

---

## コンセプト

「動けばよい」ではなく、**保守・拡張しやすい設計を意識した実装**を目指しました。
クラスの責務分離・インターフェース・Trait・抽象クラスといったオブジェクト指向の主要概念を実際のゲームロジックに落とし込み、コードの読みやすさと変更しやすさを重視しています。

---

## 主な機能

- 52枚フルデッキのシャッフル（Fisher–Yatesアルゴリズム）
- プレイヤー・CPU（最大2人）・ディーラーの複数人対戦
- ブラックジャックのルールに準拠したゲーム進行
  - プレイヤーのヒット/スタンド選択
  - ディーラーの17点ルール（17点以上になるまで自動ドロー）
  - ディーラーの2枚目カードの伏せ/公開制御
  - Aの点数を1点/11点で自動切り替えするバースト回避ロジック
- 勝敗・引き分けの判定と結果表示

---

## 使用技術

| 項目           | 内容                                                |
| -------------- | --------------------------------------------------- |
| 言語           | PHP 8.x                                             |
| 実行環境       | Docker（Apache + PHP）                              |
| テスト         | PHPUnit                                             |
| 静的解析       | PHPStan                                             |
| コードスタイル | PHP_CodeSniffer、PHP Mess Detector                  |
| 開発環境       | VS Code + Dev Container（Xdebugによるデバッグ対応） |

---

## ディレクトリ構成の概要

```
black_jack/
├── docker/               # Docker設定（Dockerfile, php.ini, xdebug.ini）
├── docker-compose.yml
└── src/
    ├── index.php         # エントリーポイント
    ├── composer.json
    ├── lib/
    │   └── black_jack/
    │       ├── Card.php          # カード1枚を表すエンティティ
    │       ├── Deck.php          # 52枚の山札・シャッフル・ドロー
    │       ├── HandTrait.php     # 手札管理・合計点計算（Trait）
    │       ├── CardHolder.php    # カードを持つ共通インターフェース
    │       ├── EvaluateCard.php  # カードの点数評価ロジック
    │       ├── Player.php        # プレイヤー抽象クラス
    │       ├── PlayerA.php       # 人間プレイヤー（ヒット/スタンド入力）
    │       ├── PlayerCpuFirst.php / PlayerCpuSecond.php  # CPU対戦相手
    │       ├── Dealer.php        # ディーラー（シャッフル・17点ルール）
    │       ├── Rule.php          # 勝敗判定ロジック
    │       ├── Message.php       # 表示メッセージ生成
    │       ├── HowManyPlayers.php # 参加人数入力
    │       └── Game.php          # ゲーム進行の制御
    └── tests/
        └── black_jack/   # 各クラスに対応するユニットテスト
```

---

## 開発の背景とアピールポイント

### 開発の背景

PHPとオブジェクト指向を体系的に学ぶため、実際に動くアプリケーションを自力で設計・実装しました。チュートリアルをなぞるだけでなく、「なぜこの設計にするのか」を考えながら作ることを重視しました。

### アピールポイント

**1. 責務に基づいたクラス設計**
カード・山札・手札・ルール・メッセージをそれぞれ独立したクラスに分離し、単一責任の原則を意識した設計にしています。

**2. インターフェース・抽象クラス・Traitの使い分け**
`CardHolder`インターフェースで共通の振る舞いを定義し、`Player`抽象クラスで具体クラスへの制約を設けています。手札の操作と合計点計算は`HandTrait`として切り出し、`Player`と`Dealer`の両方で再利用しています。

**3. Aの柔軟な点数計算**
Aを11点として扱いつつ、バーストする場合に自動で1点へ切り替えるロジックを`HandTrait::totalScore()`内に実装しています。

**4. 品質ツールの導入**
PHPStan（静的解析）・PHP_CodeSniffer（コードスタイル）・PHPUnit（ユニットテスト）を導入し、コードの品質を継続的に担保できる環境を整えています。

**5. Docker + Dev Containerによる再現性のある開発環境**
Xdebugを組み込んだDocker環境を構築し、VS CodeのDev Containerでワンコマンドで開発を始められる構成にしています。

---

## 環境構築

```bash
# Docker イメージのビルド
docker-compose build

# Docker コンテナの起動
docker-compose up -d

# ゲームの実行
docker-compose exec app php index.php

# テストの実行
docker-compose exec app ./vendor/bin/phpunit

# 静的解析
docker-compose exec app ./vendor/bin/phpstan analyse -c phpstan.neon

# コンテナの停止・削除
docker-compose down
```

### Dev Container（VS Code）での起動

1. `docker-compose build` でイメージをビルド
2. VS Codeの「Remote-Containers: Open Folder in Container」でコンテナを開く
3. VSCode内ターミナルからコマンドを実行
4. 終了時は `docker-compose down`

#### Xdebugでのデバッグ

1. コードにブレークポイントを設定
2. デバッグビューを開き「Listen for Xdebug」を選択して開始
3. コードを実行

> `.vscode/launch.json` の port が `9003` であることを確認してください。
