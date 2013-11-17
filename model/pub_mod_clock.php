<?php

/**
 * 定时报警 
 * 
 * @author duanyunchao
 * @version $Id$
 */
class pub_mod_clock
{
    /* 状态 */
    const STATE_DEFAULT = 0;
    const STATE_STARTUP = 1;
    const STATE_DELETE  = 2;
    
    /* 业务类型 */
    const TYPE_SILVER = 1;

    /**
     * 获取一条
     *
     * @param int $cid
     * @return array
     */
    public static function get_clock($cid)
    {
        if (empty($cid))
        {
            return false;
        }

        $result = dbc_clock::get_one($cid);

        if ($result)
        {
            $result['data'] = @json_decode(urldecode($result['data']), true);
        }

        return $result;
    }

    /**
     * 添加
     * 
     * @return void
     */
    public static function edit_clock($cid, $params)
    {
        if (empty($params))
        {
            return false;
        }

        $clock_obj = dbc_clock::get_one($cid);
        $column    = array('type_id', 'data', 'state', 'remark');
        $param_array = array();

        foreach ($column as $column_name)
        {
            if (isset($params[$column_name]))
            {
                switch ($column_name)
                {
                    case 'data':
                        $params[$column_name] = urlencode(json_encode($params[$column_name]));
                        break;
                }

                if (empty($clock_obj) || $clock_obj[$column_name] != $params[$column_name])
                {
                    $param_array[$column_name] = $params[$column_name];
                }
            }
        }

        if (empty($param_array))
        {
            return true;
        }

        if (!empty($clock_obj))
        {
            return dbc_clock::update($cid, $param_array);
        }
        else
        {
            return dbc_clock::insert($param_array);
        }
    }

    /**
     * 获取列表
     * 
     * @return void
     */
    public static function get_list($cond, $order, $start = 0, $limit = 10)
    {
        $start = intval($start);
        $limit = intval($limit);
        return dbc_clock::get_list($cond, $order, $start, $limit);
    }

    /**
     * 获取个数
     * 
     * @return void
     */
    public static function get_count($cond)
    {
        return dbc_clock::get_count($cond);
    }

    /**
     * 获取所有启动
     *
     * @return array 
     */
    public static function get_all_startup()
    {
        $result = dbc_user_address::get_all_startup();

        if (!empty($result))
        {
            foreach ($result as &$row)
            {
                $row['data'] = @json_decode(urldecode($row['data']), true);
            }
        }

        return $result;
    }

}
