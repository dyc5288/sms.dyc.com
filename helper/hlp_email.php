<?php

!defined('IN_INIT') && exit('Access Denied');

/**
 * 邮件发送
 *
 * @author duanyunchao
 * @version $Id$
 */
class hlp_email
{

    /**
     * 发送邮件
     *
     * @param sring $email 接受者邮件
     * @param sring $user_name 接受者称呼
     * @param string $subject 标题
     * @param string $message 内容
     * @return void
     */
    public static function send_email($email, $user_name, $subject, $message)
    {
        require_once(PATH_LIBRARY . "/mail/class.phpmailer.php");
        $mail_conf = $GLOBALS['CONFIG']['mail'];

        $mail = new PHPMailer();        //建立邮件发送类

        $mail->IsSMTP();                // 使用SMTP方式发送
        $mail->Host = $mail_conf['Host'];               // 您的企业邮局域名
        $mail->SMTPAuth = true;                         // 启用SMTP验证功能
        $mail->Username = $mail_conf['Username'];       // 邮局用户名(请填写完整的email地址)
        $mail->Password = $mail_conf['Password'];       // 邮局密码
        $mail->From = $mail_conf['From'];               //邮件发送者email地址
        $mail->FromName = $mail_conf['FromName'];
        $mail->AddAddress("{$email}", $user_name);      //收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
        //$mail->AddReplyTo("", "");
        //$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
        //Add Attachment
        if (count($_FILES) > 0)
        {
            foreach ($_FILES as $f)
            {
                $mail->AddAttachment($f['tmp_name'], $f['name']);
            }
        }

        $mail->IsHTML(true);                            // set email format to HTML //是否使用HTML格式
        $mail->Subject = $subject;                      //邮件标题
        $mail->Body = $message;                         //邮件内容
        //$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略
        $mail->Send();

        if ($mail->IsError())
        {
            die($mail->ErrorInfo);
        }

        return true;
    }

}

?>
