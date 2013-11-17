<?php

/**
 * 定时报警
 * 
 * @author duanyunchao
 * @version $Id$
 */
class dbc_clock
{
    /**
     * 表名
     * 
     * @var string
     */
    const TABLE_NAME = 'dyc_clock';

    /**
     * 单条
     *
     * @param int $tid
     * @return boolean 
     */
    public static function get_one($cid, $is_cache = true)
    {
        if (empty($cid))
        {
            return false;
        }

        if ($is_cache)
        {
            $cache_key = "{$cid}";
            $cache     = GM('D_100', $cache_key);

            if ($cache !== false)
            {
                return $cache;
            }
        }

        $table  = hlp_common::get_split_table(null, self::TABLE_NAME);
        $sql    = "SELECT * FROM {$table['name']} WHERE cid = '{$cid}' ";
        $result = lib_database::get_one($sql, $table['index']);

        if ($is_cache)
        {
            $result = empty($result) ? array() : $result;
            SM($result, 'D_101', $cache_key, 86400);
        }

        return $result;
    }

    /**
     * 插入
     *
     * @param array $key_values
     * @return int 
     */
    public static function insert($key_values = array())
    {
        if (empty($key_values))
        {
            return false;
        }

        $key_values['ctime'] = time();
        $table               = hlp_common::get_split_table(null, self::TABLE_NAME);
        $result              = lib_database::duplicate($key_values, $table['name'], $table['index']);

        if ($result)
        {
            $cid = lib_database::insert_id();
            DM('D_100', $cid);
            DM('D_101', 'startup');
        }

        return $result;
    }

    /**
     * 修改
     *
     * @param int $cid
     * @param array $key_values 
     * @return boolean
     */
    public static function update($cid, $key_values = array())
    {
        if (empty($cid) || empty($key_values))
        {
            return false;
        }

        $table               = hlp_common::get_split_table(null, self::TABLE_NAME);
        $where               = " cid = '{$cid}' ";
        $key_values['utime'] = time();
        $result              = lib_database::update($key_values, $where, $table['name'], $table['index']);

        if ($result)
        {
            $cid = lib_database::insert_id();
            DM('D_100', $cid);
            DM('D_101', 'startup');
        }

        return $result;
    }

    /**
     * 获取所有启动的定时器
     *
     * @param boolean $is_cache
     * @return array 
     */
    public static function get_all_startup($is_cache = true)
    {
        if ($is_cache)
        {
            $cache = GM('D_101', 'startup');

            if ($cache !== false)
            {
                return $cache;
            }
        }

        $table  = hlp_common::get_split_table($user_id, self::TABLE_NAME);
        $sql    = "SELECT * FROM {$table['name']} WHERE state = '1' limit 2000";
        $result = lib_database::get_all($sql, $table['index']);

        if ($is_cache)
        {
            $result = empty($result) ? array() : $result;
            SM($result, 'D_101', 'startup', 86400);
        }

        return $result;
    }

    /**
     * 列表
     *
     * @param array $cond
     * @param string $order
     * @param int $start
     * @param int $limit
     * @return array 
     */
    public static function get_list($cond = array(), $order = false, $start = 0, $limit = 10)
    {
        $where = self::_get_where($cond);
        $table = hlp_common::get_split_table(null, self::TABLE_NAME);
        $order = !empty($order) ? "ORDER BY {$order}" : "";

        $sql = "SELECT *  FROM {$table['name']} {$where} {$order} LIMIT {$start}, {$limit}";
        return lib_database::get_all($sql, $table['index']);
    }

    /**
     * 获取数据
     *
     * @param array $cond
     * @return array
     */
    public static function get_count($cond)
    {
        $where = self::_get_where($cond);
        $table = hlp_common::get_split_table(null, self::TABLE_NAME);

        $sql    = "SELECT COUNT(*) as count FROM {$table['name']} {$where}";
        $result = lib_database::get_one($sql, $table['index']);

        if ($result)
        {
            return $result['count'];
        }

        return false;
    }

    /**
     * 获取条件
     *
     * @param array $cond
     * @return string 
     */
    private static function _get_where($cond = array())
    {
        $where = "WHERE 1 = 1 ";

        if (isset($cond['cid']))
        {
            $where .= "AND cid = '{$cond['cid']}' ";
        }

        if (isset($cond['type_id']))
        {
            $where .= "AND type_id = '{$cond['type_id']}' ";
        }

        if (isset($cond['state']))
        {
            $where .= "AND state = '{$cond['state']}' ";
        }

        return $where;
    }

}
