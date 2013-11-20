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

}

