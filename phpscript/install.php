<?php

/**
 * 安装脚本
 * 
 * @author duanyunchao
 * @version $Id$
 */
/** 初始化 */
require '../init.php';

/* 调试模式 */
$flag = hlp_common::get_cmd_flag();

if (!empty($flag['help']))
{
    //echo "/usr/sbin/gearmand --pid-file=/var/run/gearman/gearmand.pid --user=gearman --daemon --log-file=/var/log/gearman-job-server/gearman.log --listen=127.0.0.1" . PHP_EOL;
    //echo "/usr/bin/spawn-fcgi -a 127.0.0.1 -p 9000 -C 5 -u www-data -g www-data -f /usr/bin/php5-cgi -P /var/run/fastcgi-php.pid" . PHP_EOL;
    //echo "/usr/bin/memcached -m 64 -p 11211 -u memcache -l 127.0.0.1" . PHP_EOL;
    echo "php install.php -dyc_clock 1" . PHP_EOL;
}

if (!empty($flag['dyc_clock']))
{
    $number = 1;
    $sql    = "CREATE TABLE IF NOT EXISTS `%s` (
        `cid` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
        `type_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT  '类型ID',
        `data` text NOT NULL DEFAULT '' COMMENT '数据根据具体业务不一样',
        `ctime` int(10) DEFAULT NULL DEFAULT '0' COMMENT '添加时间',
        `utime` int(10) DEFAULT NULL DEFAULT '0' COMMENT '修改时间',
        `state` tinyint(4) DEFAULT NULL DEFAULT '0' COMMENT '0：关闭，1：开启，2：删除',
        `remark` varchar(50) NOT NULL DEFAULT '' COMMENT '内容',
        PRIMARY KEY (`cid`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='定时报警'";

    if ($flag['dyc_clock'] == 1)
    {
        hlp_tool::create_table('dyc_clock', $sql, $number);
    }
    else if ($flag['dyc_clock'] == 2)
    {
        hlp_tool::drop_table('dyc_clock', $number);
    }
}

echo "success" . PHP_EOL;
