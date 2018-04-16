<?php
/**
 * description...
 * @copyright (c) 2012-2020, Hangzhou Infogo Tech Co., Ltd.
 *                 This is NOT a freeware, use is subject to license terms.
 * @package test.php
 * @author duanyunchao <duanyc@infogo.com.cn>
 * @link http://www.infogo.com.cn Company HomePage.
 * @since 18/4/14
 * @version $Id$
 */
$nonce = $_GET['nonce'];
$signature = $_GET['signature'];
$timestamp = $_GET['timestamp'];
$token = 'kosfe9rtue9r1';
$arr = array($nonce, $token, $timestamp);
sort($arr);
$tmpstr = implode('', $arr);

if (sha1($tmpstr) == $signature)
{
	echo $_GET['echostr'];
}