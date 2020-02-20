<?php 
session_start();

$to = "hydraconis@yandex.ru"; // Ваш Электронный адрес

$name = stripslashes(htmlspecialchars($_POST['name']));
$phone = stripslashes(htmlspecialchars($_POST['phone']));

$email = $_POST['email'];

if(empty($phone)){
echo '<h1 style="color:red;">Пожалуйста заполните все поля</h1>';
echo '<meta http-equiv="refresh" content="2; url=http://'.$_SERVER['SERVER_NAME'].'">';
}
else{

$subject = 'Заявка с сайта - "'.$_SERVER['HTTP_HOST'].'"'; // заголовок письма

$sender="<noreply@{$_SERVER['HTTP_HOST']}>"; // Адрес отправителя
$header="Content-type:text/plain;charset=utf-8\r\nFrom: {$sender}\r\n";

$message = "ФИО: {$name}\nТелефон: {$phone}\nЕмайл: {$email}\n\nСайт: {$_SERVER['HTTP_HOST']}\nВремя: ".date("m.d.Y H:i:s")."\n\nИнформация о клиенте:\nIP: {$_SERVER['REMOTE_ADDR']}\nУстановленный язык: {$_SERVER['HTTP_ACCEPT_LANGUAGE']}\nБраузер и ОС: {$_SERVER['HTTP_USER_AGENT']}\nРеферер: {$_SESSION['server']['referer']}\n";
$success_url = 'success.php?name='.$name.'&phone='.$phone.'';

$verify = mail($to,$subject,$message,$header);
if ($verify == 'true'){
	echo("<script>document.location.href = '{$success_url}';</script>");
    //header('Location: '.);
    echo '<h1 style="color:green;">Поздравляем! Ваш заказ принят!</h1>';
    exit;
}
else 
    {
    echo '<h1 style="color:red;">Произошла ошибка!</h1>';
    }
}
?>
 