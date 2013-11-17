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
    public static function get_one($cid)
    {
        if (empty($cid))
        {
            return false;
        }

        $table = hlp_common::get_split_table(null, self::TABLE_NAME);
        $sql   = "SELECT * FROM {$table['name']} WHERE cid = '{$cid}' ";
        return lib_database::get_one($sql, $table['index']);
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

        $table = hlp_common::get_split_table(null, self::TABLE_NAME);
        return lib_database::duplicate($key_values, $table['name'], $table['index']);
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

        $table = hlp_common::get_split_table(null, self::TABLE_NAME);
        $where = " cid = '{$cid}' ";
        return lib_database::update($key_values, $where, $table['name'], $table['index']);
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
