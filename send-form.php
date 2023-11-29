<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  var_dump($_POST);
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $text = $_POST['text'];

  // Создание нового объекта для отправки писем
  $mail = new PHPMailer(true);
                              
  try {
    // Настройка параметров сервера
    $mail->isSMTP();                                   
    $mail->Host = 'smtp.yandex.ru';
    $mail->SMTPAuth = true;                               
    $mail->Username = 'a.rtm.mlkn@yandex.ru';                 
    $mail->Password = 'rtvlsxeqszlzufut';                           
    $mail->SMTPSecure = 'ssl';                            
    $mail->Port = 465;                                   
     
    // Установка параметров для отправки письма
    $mail->setFrom('a.rtm.mlkn@yandex.ru', 'Mailer');
    $mail->addAddress('a.rtm.mlkn@yandex.ru', 'Owner');
    
    // Добавление контента письма
    $mail->isHTML(true);                                  
    $mail->Subject = 'Новое сообщение от ' . $name;
    $mail->Body    = $text;
    
    // Отправка письма
    $mail->send();
    echo 'Письмо отправлено';
  } catch (Exception $e) {
    echo "Письмо не может быть отправлено. Ошибка: {$mail->ErrorInfo}";
  }
}
?>
