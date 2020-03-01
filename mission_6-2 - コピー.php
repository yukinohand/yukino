
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
	$sql = "CREATE TABLE IF NOT EXISTS tbtest_f"
	."("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "mailadress TEXT,"
	. "pass char(25)"
	.");";
	$stmt = $pdo->query($sql);

//テーブル一覧を表示するコマンドを使って作成が出来たか確認する。
	$sql ="SHOW TABLES";
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[0];
		echo '<br>';
	}
	echo "<hr>";

//テーブルの中身を確認するコマンドを使って、意図した内容のテーブルが作成されているか確認する。
	$sql ="SHOW CREATE TABLE tbtest_f";
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[1];
	}
	echo "<hr>";



if(!empty($_POST["name"])){
if(!empty($_POST["mailadress"])){
if(!empty($_POST["pass"])){
//作成したテーブルに、insertを行ってデータを入力する。
    $name =$_POST["name"];
    $mailadress=$_POST["mailadress"];
    $pass=$_POST["pass"];
    $sql = $pdo -> prepare("INSERT INTO tbtest_f (name, mailadress, pass) VALUES (:name, :mailadress, :pass)");
    $sql -> bindParam(":name", $name, PDO::PARAM_STR);
    $sql -> bindParam(":mailadress", $mailadress, PDO::PARAM_STR);
    $sql -> bindParam(":pass", $pass, PDO::PARAM_STR);
    $sql -> execute();

	//テーブル番号を呼び出す
	//取得したいidが呼び出せているかはわからない
	$sql = "SELECT * FROM tbtest_f";
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
	$id=$row['id'];
	}

			require 'src/Exception.php';
			require 'src/PHPMailer.php';
			require 'src/SMTP.php';
			require 'setting.php';

			// PHPMailerのインスタンス生成
			    $mail = new PHPMailer\PHPMailer\PHPMailer();

			    $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
			    $mail->SMTPAuth = true;
			    $mail->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
			    $mail->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
			    $mail->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
			    $mail->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
			    $mail->Port = SMTP_PORT; // 接続するTCPポート

			    // メール内容設定
			    $mail->CharSet = "UTF-8";
			    $mail->Encoding = "base64";
			    $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
			    $mail->addAddress($mailadress, '受信者さん'); //受信者（送信先）を追加する
			//    $mail->addReplyTo('xxxxxxxxxx@xxxxxxxxxx','返信先');
			//    $mail->addCC('xxxxxxxxxx@xxxxxxxxxx'); // CCで追加
			//    $mail->addBcc('xxxxxxxxxx@xxxxxxxxxx'); // BCCで追加
			    $mail->Subject = MAIL_SUBJECT; // メールタイトル
			    $mail->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
			    $body = $name ."さん". "<br>"."ご登録ありがとうございます。". "<br>"."会員番号は".$id."です。.". "<br>"."以下のURLよりメールアドレスの認証をよろしくお願いいたします。"."<br>"."https://tb-210501.tech-base.net/mission_6-2-1.php";
			    

			    $mail->Body  = $body; // メール本文
			    // メール送信の実行
			    if(!$mail->send()) {
			    	echo 'メッセージは送られませんでした！';
			    	echo 'Mailer Error: ' . $mail->ErrorInfo;
			    } else {
			    	echo '送信完了！';
			    }



}
}
}


	
	

?>

<body>

	<form action="mission_6-2.php" method="POST" >
	名前：<input type="text" name="name" size="30">

	<br>
	<form action="mission_6-2.php" method="POST" >
	メール：<input type="email" name="mailadress" size="30">

	<br>パスワード：<input type="text" name="pass" size="30">
	
	<input type="submit"  value="送信" > 
	</form>


</body>




</html>