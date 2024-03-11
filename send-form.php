<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $mail->setFrom('a.rtm.mlkn@yandex.ru', 'Электролегис');
    $mail->addAddress('a.rtm.mlkn@yandex.ru', 'a.rtm.mlkn@yandex.ru');
    
    // Добавление контента письма
    $mail->isHTML(true);                                  
    $mail->Subject = 'Новая заявка!';
    $mail->Body    = 'Имя: ' . $name . '<br>Телефон: ' . $phone . '<br>Почта: ' . $email . '<br>Сообщение клиента:<br>' . $text;
    
    // Отправка письма
    $mail->send();

    // Редирект
    header('Location: /index.html');
    exit;
  } catch (Exception $e) {
    echo "Письмо не может быть отправлено. Ошибка: {$mail->ErrorInfo}";
  }
}
?>
