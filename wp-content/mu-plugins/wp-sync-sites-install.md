# WordPress Sites Sync インストール手順

## 概要

FascinaとTwelorの2つのWordPressサイト間で、カスタム投稿タイプとメディアを双方向リアルタイム同期するプラグインです。

## 機能

- カスタム投稿タイプ（gallery, course, coupon, nailist, banner, qa, home）の同期
- メディア（画像、ファイル）の同期
- ターム（カテゴリー、タグなど）の同期
- 投稿ID、メディアID、タームIDの統一
- 双方向リアルタイム同期

## 重要: データベース同期について

**動作確認する前に、必ずデータベースを同期して投稿ID、メディアID、タームIDを揃えてください。**

既存のデータがある場合、同じIDで異なる投稿が存在すると、同期時に誤って上書きされる可能性があります。

## インストール手順

### ステップ0: データベースの同期（既存データがある場合）

**重要**: 既存のデータがある場合は、先にデータベースを同期してください。

1. All-in-One WP Migrationプラグインをインストール（両方のサイト）
2. Fascina側のデータをエクスポート
3. Twelor側にインポート（既存データを上書き）
4. URLを置換（`http://fascina.local` → `http://twelor.local`）
5. **メディアファイルをコピー**（`wp-content/uploads/`フォルダを直接コピー）

**重要**: All-in-One WP Migrationでデータベースを同期しても、メディアファイル（`wp-content/uploads/`）はコピーされない場合があります。必ずメディアフォルダを手動でコピーしてください。

詳細は `wp-sync-sites-migration-guide.md` と `wp-sync-sites-media-sync.md` を参照してください。

### ステップ1: プラグインファイルの配置

1. `wp-sync-sites.php`を両方のサイトの`wp-content/mu-plugins/`ディレクトリに配置
   - Fascina側: `wp-content/mu-plugins/wp-sync-sites.php`
   - Twelor側: `wp-content/mu-plugins/wp-sync-sites.php`

### ステップ2: Application Passwordの生成

**Fascina側:**

1. WordPress管理画面にログイン
2. ユーザー > プロフィール
3. 「Application Passwords」セクションまでスクロール
4. 「新しいアプリケーションパスワード名」に「Twelor Sync」と入力
5. 「新しいパスワードを追加」をクリック
6. 表示されたパスワードをコピー（例: `xxxx xxxx xxxx xxxx xxxx xxxx`）

**Twelor側:**

1. 同様の手順でApplication Passwordを生成
2. パスワードをコピー

### ステップ3: wp-config.phpの設定

**Fascina側の`wp-config.php`に追加:**

```php
// WordPress Sites Sync 設定
define('SYNC_SITE_URL', 'http://twelor.local');
define('SYNC_AUTH_USER', 'admin');
define('SYNC_AUTH_PASS', 'xxxx xxxx xxxx xxxx xxxx xxxx'); // Twelor側で生成したApplication Password
```

**Twelor側の`wp-config.php`に追加:**

```php
// WordPress Sites Sync 設定
define('SYNC_SITE_URL', 'http://fascina.local');
define('SYNC_AUTH_USER', 'admin');
define('SYNC_AUTH_PASS', 'xxxx xxxx xxxx xxxx xxxx xxxx'); // Fascina側で生成したApplication Password
```

**重要:** Application Passwordはスペースを含む形式でそのまま使用できます。

### ステップ4: 動作確認

1. **Fascina側でテスト:**
   - 管理画面でギャラリーを1つ作成
   - Twelor側の管理画面で同じギャラリーが作成されているか確認
   - 投稿IDが同じか確認

2. **Twelor側でテスト:**
   - 管理画面でクーポンを1つ作成
   - Fascina側の管理画面で同じクーポンが作成されているか確認
   - 投稿IDが同じか確認

3. **更新のテスト:**
   - Fascina側でギャラリーのタイトルを変更
   - Twelor側でタイトルが更新されているか確認

4. **削除のテスト:**
   - Fascina側でギャラリーを削除
   - Twelor側で同じギャラリーが削除されているか確認

## トラブルシューティング

### 問題: 同期が動作しない

**確認事項:**
1. `wp-config.php`に設定が正しく追加されているか
2. Application Passwordが正しく設定されているか
3. 両方のサイトが起動しているか
4. ネットワーク接続が正常か

**デバッグ方法:**
- `wp-content/debug.log`を確認
- ブラウザの開発者ツールでネットワークタブを確認
- REST APIエンドポイントに直接アクセスしてテスト

### 問題: HTTP 401エラー（認証エラー）

**エラーメッセージ:**
```
WPS Sync Error: HTTP 401 | URL: http://twelor.local/wp-json/sync/v1/post | Response: {"code":"rest_forbidden","message":"その操作を実行する権限がありません。","data":{"status":401}}
```

**原因:**
- Application Passwordが正しく設定されていない
- Twelor側の`wp-config.php`に設定が不足している
- Application Passwordの形式が間違っている（スペースが含まれている場合）

**解決方法:**

1. **Twelor側の`wp-config.php`を確認:**
   ```php
   define('SYNC_SITE_URL', 'http://fascina.local');
   define('SYNC_AUTH_USER', 'admin');
   define('SYNC_AUTH_PASS', 'application_password'); // Application Passwordを設定
   ```

2. **Application Passwordを再生成:**
   - Twelor側のWordPress管理画面 → ユーザー > プロフィール
   - 「Application Passwords」セクション
   - 既存のパスワードを削除
   - 新しいApplication Passwordを生成
   - Fascina側の`wp-config.php`の`SYNC_AUTH_PASS`を更新

3. **Fascina側のApplication Passwordも確認:**
   - Fascina側でも同様にApplication Passwordを生成
   - Twelor側の`wp-config.php`の`SYNC_AUTH_PASS`を更新

4. **両方のサイトで同じユーザー名とApplication Passwordを使用:**
   - 両方のサイトで同じユーザー名（例: `admin`）を使用
   - 両方のサイトで同じApplication Passwordを使用（推奨）
   - または、各サイトで異なるApplication Passwordを生成し、相手側の`wp-config.php`に設定

5. **`wp-config.php`の設定を確認:**
   - スペースや引用符が正しく設定されているか確認
   - Application Passwordにスペースが含まれている場合、そのまま使用（プラグインが自動的に処理します）

**注意**: Application Passwordは、表示時にはスペースを含む形式（例: `xxxx xxxx xxxx xxxx xxxx xxxx`）ですが、`wp-config.php`に設定する際は、そのまま（スペースを含む形式）で設定してください。プラグインが自動的にスペースを削除して処理します。

### 問題: 無限ループが発生する

**原因:**
- 同期フラグが正しく機能していない可能性

**解決方法:**
- プラグインを一時的に無効化: `define('SYNC_DISABLED', true);`
- データベースから`_sync_in_progress`メタデータを削除

### 問題: 投稿IDが一致しない

**原因:**
- 既存のデータがある場合、投稿IDが既に使用されている

**解決方法:**
- All-in-One WP Migrationなどのプラグインでデータベースを同期
- または、手動で投稿IDを調整

## 注意事項

1. **初期設定時:** 既存のデータがある場合、投稿IDを揃える必要があります
2. **バックアップ:** 同期を開始する前に、必ず両方のサイトのバックアップを取ってください
3. **リビジョン:** リビジョンは同期されません（意図的な設計）
4. **パフォーマンス:** 大量のデータがある場合、初回同期に時間がかかる可能性があります

## 同期されるデータ

### 投稿データ
- タイトル、本文、抜粋
- ステータス、公開日時
- メタデータ（カスタムフィールド）
- ACFフィールド
- アイキャッチ画像
- タームの紐付け
- 表示順（menu_order）

### メディアデータ
- ファイルデータ
- タイトル、説明、alt属性
- メタデータ

### タームデータ
- 名前、スラッグ、説明
- 親子関係
- メタデータ

## 同期されないデータ

- リビジョン（revision）
- 自動保存（autosave）
- コメント
- ユーザー情報
- プラグイン設定
- テーマ設定

## 無効化方法

一時的に同期を無効化する場合:

```php
// wp-config.phpに追加
define('SYNC_DISABLED', true);
```

## サポート

問題が発生した場合は、`wp-content/debug.log`を確認してください。

