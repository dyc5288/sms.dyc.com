<?php

/**
 * 测试
 * 
 * @author duanyunchao
 * @version $Id$
 */
require '../init.php';

$email = 'dyc5288@qq.com';
$user_name = "段公子";
$subject = "测试发邮件";
$message = "收到没，收到请回复";

$result = hlp_email::send_email($email, $user_name, $subject, $message);

var_dump($result);