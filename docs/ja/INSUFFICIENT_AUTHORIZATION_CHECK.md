# 認可制御不備の概要

認可制御不備とは、ログイン済みのユーザーが許可されていないデータへアクセスや変更を行えてしまう脆弱性です。適切な認可の仕組みを設けることで、ユーザーを検証し、データへの不正アクセスや変更を阻止する必要があります。

## 日本語 | [English](../en/INSUFFICIENT_AUTHORIZATION_CHECK.md)

## 発生しうる脅威

認可制御不備があると、正規のユーザーに成りすますことができます。これにより、ユーザーの個人情報の漏洩や改ざんされるリスクがあります。

## 攻撃手法

認可制御の不備による攻撃では、攻撃者は通常、アクセスする権限のないリソースや機能にアクセスしようとします。これは、Web アプリケーションがユーザー操作を適切に認可していない場合に起こる問題です。<br>
例えば、攻撃者が変更可能な URL のパラメータやフォームのデータを操作することで、他のユーザーの個人情報を閲覧したり、操作したりします。

## 対策方法

ユーザーが実施する操作に対して、彼らの権限を検証し、許可されていない操作を行わせないようにする必要があります。セッション管理を適切に行い、ユーザー ID を安全に扱うことで、不正なアクセスを試みる者がユーザーになりすますことを防ぎます。<br>
例えば、セッション変数を用いてユーザー ID を管理し、データベースにアクセスする際はこの ID を用いて検証を行います。

## ハンズオン

### 1. ログインする

http://localhost/login にアクセスし、Email：`john@example.com`, Password：`password`を入力し、ログインしてください。

### 2. マイページ → ユーザー情報編集画面にアクセスする

以下の添付画像に記載されているように、マイページにアクセスしてください。

![authorization](../img/authorization1.png)

以下の添付画像に記載されているように、ユーザー情報編集画面にアクセスしてください。

![authorization](../img/authorization2.png)

### 3. URL を確認し、適当な ID を入力し、他のユーザーのなりすましを試みる

ユーザー情報編集画面にて、URL を確認します。ID が 1 であることが確認できます。

![authorization](../img/authorization3.png)

URL の 1 の部分を 2 に変更して、「Enter」をクリックします。<br>
他のユーザー情報を閲覧することができました。ProtectMe の Name は公開情報ですが、Email は非公開情報です。よって、これは情報漏洩です。

![authorization](../img/authorization4.png)

### 4. 他のユーザー情報を編集する

Name と Email に適当な値を入力し、「Update」ボタンをクリックします。<br>
フラッシュメッセージが表示され、他のユーザー情報を編集することができました。

![authorization](../img/authorization5.png)

### 5. 他のユーザー情報を編集できないように認可制御する

| #   | 手順                                                        |
| --- | ----------------------------------------------------------- |
| 1   | セッションからログインユーザーの ID を取得する              |
| 2   | 該当リソースの ID を取得する                                |
| 3   | 「ログインユーザー ID」と「該当リソースの ID」 を比較する   |
| 4   | `false`と判定された場合、HTTP レスポンスの 403 エラーを返す |

Laravel では認可制御するために、ゲートやポリシーという仕組みが備わっています（[詳細](https://readouble.com/laravel/10.x/ja/authorization.html)）。今回は学習が目的であるため、Laravel の認可制御を使用せず、自前で実装します。

#### 既存の該当コードの説明（ルーティング）

```php
Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
```

<https://github.com/yuta-sawamura/protect-me/blob/main/src/routes/web.php#L39>

1. `Route::put:`<br>
   これは、[HTTP](https://developer.mozilla.org/ja/docs/Web/HTTP/Overview) の PUT メソッドに対応するルートを定義しています。PUT メソッドは通常、既存のリソースを更新するために使用されます。
2. `'/{user}':`<br>
   ここで定義されている`/{user}`は、URL パラメータです。これにより、ユーザーの ID などの特定のユーザーリソースを指定するために、URL 内で動的なセグメントを使用できるようになります。例えば、`users/1` という URL は ID が 1 のユーザーを指します。<br>
   Laravel はこのパラメータを取得し、リクエストされた `User` のインスタンスをデータベースから検索して取得します。具体的には以下のようなクエリが発行されます。

    ```sql
     SELECT * FROM `users` WHERE `id` = 1 LIMIT 1;
    ```

    ![authorization](../img/authorization6.png)
    ＜テーブル情報＞<br>

    ```sql
     CREATE TABLE `users` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ```

3. `[UserController::class, 'update']:`<br>
   この配列は、リクエストを処理するために呼び出されるコントローラーとメソッドを指定しています。この場合、`UserController` の `update` メソッドがリクエストを処理します。
4. `->name('users.update'):`<br>
   `name` メソッドは、ルートに名前を付けるために使用されます。これにより、アプリケーションの他の部分からルートを参照しやすくなります（例：リダイレクトやリンク生成時）。ここでは、ルートに`'users.update'`という名前が付けられています。

#### 既存の該当コードの説明（`update`）

```php
/**
 * 指定されたリソースを更新します。
 * @param Request $request // HTTPリクエストオブジェクトを受け取る
 * @param User $user // 更新するUserモデルのインスタンスを受け取る
 * @return RedirectResponse // 更新後にリダイレクトレスポンスを返す
 */
public function update(Request $request, User $user): RedirectResponse
{
    // リクエストデータのバリデーションルールを定義し、バリデーションを実施する
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'], // 名前は必須、文字列、最大255文字
        'email' => [
            'required', // メールは必須
            'string', // 文字列
            'email', // メール形式であること
            'max:255', // 最大255文字
            Rule::unique('users')->ignore($user->id), // usersテーブル内で一意であり、現在のユーザーは除外
        ],
    ]);

    // ユーザーモデルを更新する（バリデーション済みのデータで）
    $user->update($validated);

    // ユーザー編集ページにリダイレクトし、ステータスメッセージとともに
    return redirect()->route('users.edit', $user)->with('status', 'Your profile has been updated.');
}
```

<https://github.com/yuta-sawamura/protect-me/blob/main/src/app/Http/Controllers/UserController.php#L44-L65>

#### 認可制御する

既存コードは認可制御がされていないため、以下の処理を実装します。

```php
public function update(Request $request, User $user): RedirectResponse
{
    // 認可制御
    // Authファサードのidメソッドを使用してログインユーザーの ID を取得することができる。Doc: https://readouble.com/laravel/10.x/ja/authentication.html
    // Userモデルインスタンスからidフィールドを取得する。
    if (Auth::id() !== $user->id) {
        // abort関数でHTTPレスポンスコードを指定してエラーレスポンスを生成し、即座にリクエスト処理を終了させる。
        abort(403, 'You do not have permission to edit this blog');
    }

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id),
        ],
    ]);

    $user->update($validated);

    return redirect()->route('users.edit', $user)->with('status', 'Your profile has been updated.');
}
```

| #   | 手順                                                        | 該当コード                 |
| --- | ----------------------------------------------------------- | -------------------------- |
| 1   | セッションからログインユーザーの ID を取得する              | `Auth::id();`              |
| 2   | 該当リソースの ID を取得する                                | `$user->id;`               |
| 3   | 「ログインユーザー ID」と「該当リソースの ID」 を比較する   | `Auth::id() !== $user->id` |
| 4   | `false`と判定された場合、HTTP レスポンスの 403 エラーを返す | `abort(403, '...');`       |

Laravel では、受信リクエストの処理時、`Auth`ファサードの`id`メソッドを使用して認証済みユーザー ID を取得することができます（[詳細](https://readouble.com/laravel/10.x/ja/authentication.html)）。

### 6. 他のユーザー情報を編集できるか確認する

他のユーザー情報にアクセスします。<http://localhost/users/2/edit>
Name と Email に適当な値を入力し、更新します。以下のようなエラー画面が表示された場合、認可制御が成功しています。

![authorization](../img/authorization7.png)

### 7. 他のユーザー情報にアクセスできないように認可制御する

他のユーザー情報の編集機能は認可制御することができましたが、他のユーザー情報のアクセスに対する認可制御ができていません。<br>
他のユーザー情報にアクセスします。<http://localhost/users/2/edit><br>
先ほどと同様の認可制御の処理を実装します。<br>

＜認可制御前＞

```php
public function edit(User $user): View
{
    return view('users.edit', [
        'user' => $user,
    ]);
}
```

<https://github.com/yuta-sawamura/protect-me/blob/main/src/app/Http/Controllers/UserController.php#L31-L42>

＜認可制御後＞

```php
public function edit(User $user): View
{
    // 認可制御
    // Authファサードのidメソッドを使用してログインユーザーの ID を取得することができる。Doc: https://readouble.com/laravel/10.x/ja/authentication.html
    // Userモデルインスタンスからidフィールドを取得する。
    if (Auth::id() !== $user->id) {
        // abort関数でHTTPレスポンスコードを指定してエラーレスポンスを生成し、即座にリクエスト処理を終了させる。
        abort(403, 'You do not have permission to edit this blog');
    }
    return view('users.edit', [
        'user' => $user,
    ]);
}
```

### 8. 他のユーザー情報にアクセスできないように認可制御する

他のユーザー情報に改めてアクセスします。<http://localhost/users/2/edit><br>
以下のようなエラー画面が表示された場合、認可制御が成功しています。
![authorization](../img/authorization8.png)

自身のユーザー情報には問題なくアクセスできるか確認します。<http://localhost/users/1/edit><br>
以下のように正常アクセスできれば問題ありません。
![authorization](../img/authorization9.png)
