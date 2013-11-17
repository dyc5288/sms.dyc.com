<?php

/**
 * 白银监控
 * 
 * @author duanyunchao
 * @version $Id$
 */
define('PATH_ROOT_CLI', strtr(__FILE__, array('\\'                       => '/', '/worker/SILVER_ALARM.php' => '', 'SILVER_ALARM.php'         => '')));
include PATH_ROOT_CLI . '/init.php';

/* 调试模式 */
$flag = hlp_common::get_cmd_flag();

if (!empty($flag['test']))
{
    var_dump($flag);
    lib_gearman::add_job($GLOBALS['CONFIG']['gearman'], 'SILVER_ALARM', $flag, 3);
    exit();
}

if (isset($flag['help']))
{
    echo "php SILVER_ALARM.php -debug 1 注册\n";
    echo "\n";
    exit();
}

/* 执行任务 */
lib_gearman::do_job($GLOBALS['CONFIG']['gearman'], "SILVER_ALARM", "SILVER_ALARM");

/**
 * 白银监控
 *
 * @param resource $job
 * @return boolean
 */
function SILVER_ALARM($job)
{
    $params = $job->workload();
    $params = unserialize($params);

    if (!empty($params))
    {
        $return = array('state'      => false, 'start_time' => time(), 'params'     => $params, 'email'      => array());

        try
        {
            while (true)
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
                    $cur_time        = $last_attributes['EP'] . " " . $last_attributes['TDT'];
                    $cur_price       = $last_attributes['EP'];
                }

                $return['cur_price'] = $cur_price;
                $email               = 'dyc5288@qq.com';
                $user_name           = "段公子";
                $subject             = pub_mod_clock::$TYPE[pub_mod_clock::TYPE_SILVER];
                $message             = "监控报警, 目前价格为";
                $clock_list          = pub_mod_clock::get_all_startup();

                if (!empty($clock_list))
                {
                    foreach ($clock_list as $row)
                    {
                        if ($row['type_id'] == pub_mod_clock::TYPE_SILVER)
                        {
                            $hign = $row['data']['hign'];
                            $low  = $row['data']['low'];

                            if ($cur_price >= $hign || $hign <= $low)
                            {
                                $message .= "{$cur_price}元/公斤，请关注。{$cur_time}最新数据！";
                                $return['email'][$row['cid']] = hlp_email::send_email($email, $user_name, $subject, $message);
                                sleep(300);
                            }
                        }
                    }
                }

                if (CLI_DEBUG_LEVEL)
                {
                    print_r($return);
                }

                sleep(1);
            }

            $return['state'] = true;
        }
        catch (Exception $e)
        {
            $return['err_msg']  = $e->getMessage();
            $return['err_code'] = $e->getCode();
            lib_gearman::add_job($GLOBALS['CONFIG']['gearman'], 'SILVER_ALARM', array('sliver' => 1), 3);
        }

        $return['use_time'] = time() - $return['start_time'];

        if (CLI_DEBUG_LEVEL)
        {
            print_r($return);
        }

        lib_database::close_mysql();
        unset($params);
        return $return['state'];
    }

    return false;
}

