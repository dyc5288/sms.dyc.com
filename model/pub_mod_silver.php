<?php

!defined('IN_INIT') && exit('Access Denied');

/**
 * 白银
 *
 * @author duanyunchao
 * @version $Id$
 */
class pub_mod_silver
{

    /**
     * 获取当前白银价格
     * 
     * @return int
     */
    public static function get_curr_silver()
    {
        $url       = "http://www.pmec.com/flash/data/230_AG15.xml?r=" . time();
        $result    = curl($url);
        $cur_price = 10000;

        if ($result['code'] == 200)
        {
            $p    = xml_parser_create();
            $vals = array();
            $index = array();
            xml_parse_into_struct($p, $result['data'], $vals, $index);
            xml_parser_free($p);
            $last_index      = $index['SMBOL'][count($index['SMBOL']) - 1];
            $last_data       = $vals[$last_index];
            $last_attributes = $last_data['attributes'];
            $cur_time        = $last_attributes['DT'] . " " . $last_attributes['TDT'];
            $cur_price       = $last_attributes['EP'];
        }

        return array('price' => $cur_price, 'time'  => $cur_time);
    }

    /**
     * 获取当前白银价格
     * 
     * @return int
     */
    public static function get_curr_price()
    {
        $port   = 9003;
        $ip     = "183.62.250.10";
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if ($socket < 0)
        {
            echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
        }
        else
        {
            echo "CREATE　OK.\n";
        }

        echo "试图连接 '$ip' 端口 '$port'...\n";
        $result = socket_connect($socket, $ip, $port);

        if ($result < 0)
        {
            echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
        }
        else
        {
            echo "CONNECT OK\n";
        }

        $in  = "ez\r\n";
        $out = '';

        if (!socket_write($socket, $in, strlen($in)))
        {
            echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
        }
        else
        {
            echo "SEND OK！" . PHP_EOL;
            echo "发送的内容为:{$in}" . PHP_EOL;
        }

        while ($out = socket_read($socket, 8192))
        {
            echo "接收服务器回传信息成功！\n";
            echo "接受的内容为:", $out;
        }

        echo "关闭SOCKET...\n";
        socket_close($socket);
        echo "关闭OK\n";
    }

}

