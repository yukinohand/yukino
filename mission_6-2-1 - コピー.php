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
?>

<body>
会員登録が完了しました！
<br>
ログイン

	<form action="mission_6-2-1.php" method="POST" >
	会員番号：<input type="text" name="number" size="30">
	<br>
	メール：<input type="text" name="mailadress" size="30">
	<br>
	パスワード：<input type="text" name="pass" size="30">	
	<input type="submit"  value="送信" > 
	</form>
</body>

<?php

if(!empty($_POST["mailadress"])){
if(!empty($_POST["pass"])){
	$mail_2=$_POST["mailadress"];
	$pass=$_POST["pass"];
	$number=$_POST["number"];
	$sql= "SELECT * FROM tbtest_f where id=$number";
	$stmt= $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach($results as $row){	
	$password=$row["pass"];
		if($pass==$password){
		header('Location: https://tb-210501.tech-base.net/mission_6-2-2.php');
		exit();
		}else{
		echo "会員番号、メールアドレスまたはパスワードが間違っています。";
		}
	}
}}

?>
</html>