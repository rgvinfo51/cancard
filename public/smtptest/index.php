<?php
$message = '';

if (isset($_POST['email']) && !empty($_POST['email'])){
        $email_to = $_POST['email'];
     $header = "From: Orvi <salesorvi@gmail.com>\r\n";
        $header.= 'Reply-To: '.$authoremail."\r\n";
        $header.= "MIME-Version: 1.0\r\n"; 
        $header.= "Content-Type: text/plain; charset=utf-8\r\n"; 
        $header.= "X-Priority: 1\r\n"; 
        //mail($email_to, $email_subject, $email_message, $header);
        
            include("class.phpmailer.php"); //you have to upload class files "class.phpmailer.php" and "class.smtp.php"

            $mail = new PHPMailer();

            $mail->IsSMTP();
            //$mail->Mailer = "mail";
            $mail->SMTPAuth = true;

            $mail->Host = "ssl://smtp.gmail.com";

            $mail->Username = "repletesoftware@gmail.com";
            $mail->Password = "Rss##2021"; 

            $mail->From = "repletesoftware@gmail.com";
            $mail->FromName = "Repeltesoftware";

            $mail->AddAddress($email_to,"Repeltesoftware");
            $mail->Subject = $_POST['subject'];
            $mail->Body = $_POST['body'];
          
            //$file_tmp  = $_FILES['abstractfile']['tmp_name'];
            //$file_name = $_FILES['abstractfile']['name'];
            //$mail->AddAttachment($file_tmp, $file_name);
            $mail->IsHTML(true);
            $str1= "gmail.com";
            $str2=strtolower("salesorvi@gmail.com");
            If(strstr($str2,$str1) || 1==1)
            {
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
                if(!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                    echo "<br><br> * Please double check the user name and password to confirm that both of them are correct. <br><br>";
                    echo "* If you are the first time to use gmail smtp to send email, please refer to this link :http://www.smarterasp.net/support/kb/a1546/send-email-from-gmail-with-smtp-authentication-but-got-5_5_1-authentication-required-error.aspx?KBSearchID=137388";
                } 
                else {
                    echo "Email Sent Successfully";
                   // echo "File Sent Successfully."; 
                }
            }
            else{
                    $mail->Port = 25;
                    if(!$mail->Send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                        echo "<br><BR>* Please double check the user name and password to confirm that both of them are correct. <br>";
                    } 
                    else {
                        echo "Email Sent Successfully";
                    }
            }  

}else{
  if (isset($_POST['submit'])){
    $message = "No email address specified!<br>";
  }
}

if (!empty($message)){
  $message .= "<br><br>n";
}
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
      Mail test
    </title>
  </head>
  <body>
    <?php echo $message; ?>
    <form method="post" action="">
      <table>
        <tr>
          <td>
            e-mail
          </td>
          <td>
            <input name="email" value="<?php if (isset($_POST['email'])
            && !empty($_POST['email'])) echo $_POST['email']; ?>">
          </td>
        </tr>
        <tr>
          <td>
            subject
          </td>
          <td>
            <input name="subject">
          </td>
        </tr>
        <tr>
          <td>
            message
          </td>
          <td>
            <textarea name="body"></textarea>
          </td>
        </tr>
        <tr>
          <td>
            &nbsp;
          </td>
          <td>
            <input type="submit" value="send" name="submit">
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>