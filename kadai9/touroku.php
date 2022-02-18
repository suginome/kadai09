<!DOCTYPE html>
<html lang="ja">

<head>
   <meta charset="UTF-8">
   <title>ユーザー登録</title>
   <link href="css/record.css" rel="stylesheet">
</head>

<body>
   <header>
      <nav class="navbar navbar-default">
            <div class="container-fluid">
               <div class="navbar-header"><a class="navbar-brand" href="record_index.php">戻る</a></div>
            </div>
      </nav>
   </header>

   <form method="post" action="touroku_insert.php">
      <h1 class="kihon">ユーザー登録
                  <div class=jouhou>
                        
                       <p>名前<br><input type="text" name="name"/></p>
                       <p>ID<br><input type="text" name="lid"></p>
                       <p>PW<br><input type="text" name="lpw"></p>
                       <p>管理者フラグ<br><input type="text" name="kanri_flg"></p>
                       <p><br><input type="text" name="life_flg"></p>
                      </div>
         <input type="submit" value="登録">
         <input type="button" onclick="history.back()" value="戻る">
      </h1>
   </form>


<!-- formタグ界隈を修正。NULLを一回外す？ -->



</body>