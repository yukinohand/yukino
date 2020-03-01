<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php
//データベースの接続
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


//データベースにテーブルを作成
	$sql = "CREATE TABLE IF NOT EXISTS tbtest_g"
	."("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "movie char(32),"
	. "tag TEXT"
	.");";
	$stmt = $pdo->query($sql);


if(!empty($_POST["movie"])){
if(!empty($_POST["tag"])){

    $movie=$_POST["movie"];
    $tag=$_POST["tag"];


 //正常に送信してテーブルに挿入
    $sql = $pdo -> prepare("INSERT INTO tbtest_g (movie, tag) VALUES (:movie, :tag)");
    $sql -> bindParam(":movie", $movie, PDO::PARAM_STR);
    $sql -> bindParam(":tag", $tag, PDO::PARAM_STR);
    $sql -> execute();

	//リロードして重複投稿のの防止
	header('Location: https://tb-210501.tech-base.net/mission_6-2-2.php');
	 exit;

}}
?>

<body>
映画を投稿しよう！
	<form action="mission_6-2-2.php" method="POST" >
	映画のタイトル：<input type="text" name="movie" size="30">

	<br>
	ハッシュタグ：<input type="text" name="tag"  value="#" size="30">

	<input id="submit_button" type="submit"  value="送信" > 

		<a href="#" class="btn-square"> #笑 </a>
		<style>
		input#submit_button {
		.btn-square {
		  display: inline-block;
		  padding: 0.5em 1em;
		  text-decoration: none;
		  background: #668ad8;/*ボタン色*/
		  color: #FFF;
		  border-bottom: solid 4px #627295;
		  border-radius: 3px;
		}
		.btn-square:active {
		  /*ボタンを押したとき*/
		  -webkit-transform: translateY(4px);
		  transform: translateY(4px);/*下に動く*/
		  border-bottom: none;/*線を消す*/
		}
		</style>
		
		<a href="#" class="btn-square">#涙</a>
		<style>
		.btn-square {
		  display: inline-block;
		  padding: 0.5em 1em;
		  text-decoration: none;
		  background: #668ad8;/*ボタン色*/
		  color: #FFF;
		  border-bottom: solid 4px #627295;
		  border-radius: 3px;
		}
		.btn-square:active {
		  /*ボタンを押したとき*/
		  -webkit-transform: translateY(4px);
		  transform: translateY(4px);/*下に動く*/
		  border-bottom: none;/*線を消す*/
		}
		</style>

		<a href="#" class="btn-square">#悲</a>
		<style>
		.btn-square {
		  display: inline-block;
		  padding: 0.5em 1em;
		  text-decoration: none;
		  background: #668ad8;/*ボタン色*/
		  color: #FFF;
		  border-bottom: solid 4px #627295;
		  border-radius: 3px;
		}
		.btn-square:active {
		  /*ボタンを押したとき*/
		  -webkit-transform: translateY(4px);
		  transform: translateY(4px);/*下に動く*/
		  border-bottom: none;/*線を消す*/
		}
		</style>

		<a href="#" class="btn-square">#楽しい</a>
		<style>
		.btn-square {
		  display: inline-block;
		  padding: 0.5em 1em;
		  text-decoration: none;
		  background: #668ad8;/*ボタン色*/
		  color: #FFF;
		  border-bottom: solid 4px #627295;
		  border-radius: 3px;
		}
		.btn-square:active {
		  /*ボタンを押したとき*/
		  -webkit-transform: translateY(4px);
		  transform: translateY(4px);/*下に動く*/
		  border-bottom: none;/*線を消す*/
		}
		</style>

		<a href="#" class="btn-square">#恐怖</a>
		<style>
		.btn-square {
		  display: inline-block;
		  padding: 0.5em 1em;
		  text-decoration: none;
		  background: #668ad8;/*ボタン色*/
		  color: #FFF;
		  border-bottom: solid 4px #627295;
		  border-radius: 3px;
		}
		.btn-square:active {
		  /*ボタンを押したとき*/
		  -webkit-transform: translateY(4px);
		  transform: translateY(4px);/*下に動く*/
		  border-bottom: none;/*線を消す*/
		}
		</style>


	</form>


</body>



<body>
ジャンル別映画<br>

	<div class="box2">
	    <p>笑える映画</p>
	</div>
	<style>
	.box2 {
	    padding: 0.5em 1em;
	    margin: 2em 0;
	    width: 8%;
	    font-weight: bold;
	    color: #6091d3;/*文字色*/
	    background: #FFF;
	    border: solid 3px #6091d3;/*線*/
	    border-radius: 10px;/*角の丸み*/
	}
	.box2 p {
	    margin: 0; 
	    padding: 0;
	}
	</style>
</body>
<?php

	$sql = 'SELECT DISTINCT movie FROM tbtest_g where tag="#笑"';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['movie'].'<br>';
	echo "<hr>";
	}
?>
<body>
	<div class="box2">
	    <p>感動する映画</p>
	</div>
	
</body>
<?php

	$sql = 'SELECT DISTINCT movie FROM tbtest_g where tag="#涙"';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['movie'].'<br>';
	echo "<hr>";
	}
?>
<body>

	<div class="box2">
	    <p>悲しい映画</p>
	</div>

</body>
<?php

	$sql = 'SELECT DISTINCT movie FROM tbtest_g where tag="#悲"';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['movie'].'<br>';
	echo "<hr>";
	}
?>

<body>

	<div class="box2">
	    <p>楽しい映画</p>
	</div>

</body>
<?php

	$sql = 'SELECT DISTINCT movie FROM tbtest_g where tag="#楽しい"';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['movie'].'<br>';
	echo "<hr>";
	}
?>

<body>

	<div class="box2">
	    <p>怖い映画</p>
	</div>

<?php

	$sql = 'SELECT DISTINCT movie FROM tbtest_g where tag="#恐怖"';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['movie'].'<br>';
	echo "<hr>";
	}
?>

</html>