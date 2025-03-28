# coachtech フリマアプリ

## 概要

このアプリは、Laravel を使用したシンプルなフリマアプリです。
ユーザー登録、商品出品、購入、コメント、お気に入り登録などの基本機能に対応しています。
Docker による環境構築や、メール認証付きログインも実装済みです。

---

## 機能要件について

本アプリは、課題で提示されたすべての機能要件（US001〜US009）を満たすように実装されています。

- Fortify を用いた会員登録・ログイン・ログアウト機能（メール認証付き）
- ユーザープロフィールの確認・編集機能（画像アップロード含む）
- 商品の出品・編集・削除・画像アップロード
- 商品一覧・詳細・検索・いいね・コメント機能
- 購入処理（配送先選択・支払い方法選択・購入完了処理）
- マイページ（出品商品・購入商品一覧）表示機能
- バリデーションおよびエラーメッセージ対応（全項目）

### Stripe 接続について

- 「カード支払い」「コンビニ支払い」の選択後、**Stripe の決済画面に接続される仕様を実装**済みです。
- 本アプリは決済画面までの動線を保証しており、**実際の課金は行われません（デモ用）**。
- セキュリティの都合上、決済処理自体はバックエンドでは未実装です。

---

## 環境構築手順

### コンテナビルド・起動

```bash
docker compose up -d --build
```

### Laravel 初期セットアップ

```bash
cp src/.env.example src/.env
docker compose exec php bash

# 以下はphpコンテナ内で実行
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

---

## 開発環境 URL

- トップページ：http://localhost/
- ユーザー登録画面：http://localhost/register
- phpMyAdmin：http://localhost:8080/

---

## 使用技術（実行環境）

- PHP 7.4.9
- Laravel 8.83.29
- MySQL 8.0.26
- nginx 1.21.1
- Stripe PHP SDK

---

## 補足技術情報

- **メール送信確認：** MailHog にて確認済み
- **ログイン時：** メール認証必須
  未認証ユーザーはログイン後に「メール認証を完了してください」と表示され、認証ページへリダイレクトされます
- **Faker（fzaninotto/faker）：**
  Laravel 8.x 環境における標準の Faker ライブラリを使用。
  住所関連のダミーデータ生成には `ja_JP` の日本語プロバイダーを一部導入したほか、
  Fakerで正しく日本語の都道府県名を扱えない問題に対応するため、
  独自の `PrefectureProvider` を作成し、テストやSeederで使用しています。
  これにより、日本語での郵便番号・都道府県・住所を自然に再現したテストデータの生成が可能になっています。

---

## ER 図

`flea_market.drawio.png`

---

## 設計・仕様メモ

- `/mypage` はプロフィール画面を指し、`profile.blade.php` を使用します
- `mypage.blade.php` は削除済み
- `UserController@show` アクション内で `tab=buy` / `tab=sell` の値に応じて表示を切り替える実装です
  → 出品商品・購入商品一覧はルートを分けず、**タブ形式で 1 ルートに統合されています**
- 設計書に準拠した構成で、提出に適した状態です

---

## テストに関する注意事項

- 登録時のテストケース「register with all valid inputs redirects to login」を通すために、
  `RegisterController` に `VerifyEmail` 通知送信処理を一時的に追加しています
  → 本番環境では Fortify による通知で十分なため、該当コードはコメントアウト or 削除してください

- 「SOLD ラベル表示」テストでは、ログインユーザーが出品者にならないように別ユーザーの商品を作成しています

### 決済処理（Stripe）に関するテスト仕様

- 「購入する」ボタンを押下した際に、Stripe の checkout 画面にリダイレクトされることを確認する Feature テストを実装しています。
  - `assertRedirect(route('checkout', ['item_id' => $item->id]))` にて確認。
- Stripe 決済完了後に表示される `payment_success.blade.php` の表示テストについては、
  今後別ファイル（例：`PaymentSuccessTest`）にて `assertViewIs('payment_success')` を使って確認予定です。

---

## メール認証後のリダイレクト先について

現在はテスト仕様に合わせて `/login` にリダイレクトしていますが、
本番運用ではユーザー体験を考慮し、 `/mypage` に変更することを推奨します。

```php
// routes/web.php の verification.verify より
return redirect('/login'); // ← テスト用
// return redirect('/mypage'); // ← 本番時はこちら
```
