# 10-4-6 Debugging & Middleware Hands-on 🛠️

Laravel 10.x を使用したデバッグ手法の体験およびミドルウェアによる HTTP ライフサイクルのログ追跡を行うハンズオンリポジトリです。

---

## 🛠️ 実施内容・解決した課題

### 1. Mass Assignment エラーの解消 🛡️
* **課題:** フォームからユーザー登録を行った際、一括代入によるセキュリティ保護機能によって `MassAssignmentException` が発生。
* **解決策:** `app/Models/User.php` 内の `$fillable` プロパティに保存を許可するカラム（`name`, `email`, `password`）を正しく定義し、安全なデータ登録を可能に修正しました。

### 2. デバッグ手法の実践 🔍
* `dd()`（Dump and Die）を用いて、ブラウザから届いたリクエストデータ（CSRFトークンや入力値）の検証を実施。
* `storage/logs/laravel.log` のスタックトレース（`#0` 付近）からエラー発生箇所と根本原因を特定するプロセスを修得。

### 3. HTTP ライフサイクルログ（ミドルウェア）の実装 🧅
* **概要:** コントローラーを呼び出す前後でログを出力するミドルウェア `LogHttpLifecycle` を作成。
* **役割:** 
  * リクエスト受信時（`=== Request received ===`）: HTTPメソッド、アクセスURL、入力データを記録 📥
  * レスポンス送信時（`=== Response sent ===`）: 返却されたステータスコードを記録 📤
* **登録:** `Kernel.php` にエイリアス `log.lifecycle` を登録し、`routes/web.php` でルートグループに適用。

---

## 💻 開発環境

* **OS:** Windows / WSL2 (Ubuntu)
* **PHP:** 8.2
* **Framework:** Laravel 10.x
* **Container:** Docker / Laravel Sail