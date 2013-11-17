<?php

!defined('IN_INIT') && exit('Access Denied');

require_once 'ctl_parent.php';

/**
 * 邮件
 *
 * @author duanyunchao
 * @version $Id$
 */
class ctl_email extends ctl_parent
{

    /**
     * 初始化
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 首页
     * 
     * @return void
     */
    public function index()
    {
        $return = array('data' => array(), 'count'          => 0);
        $return['state'] = get_params('state', 0, 'request', false);
        $url             = '?ct=email';

        $cond = array();
        $return['state'] !== false ? ($cond['state'] = $return['state']) : false;
        $start         = get_params('s', 0, 'get', 0);
        $limit         = 20;
        $order         = 'utime desc';

        $url = ($return['state'] !== false) ? $url . "&state={$return['state']}" : $url;

        $return['count'] = pub_mod_clock::get_count($cond);
        $return['data']  = pub_mod_clock::get_list($cond, $order, $start, $limit);

        if (!empty($return['data']))
        {
            foreach ($return['data'] as &$row)
            {
                $row['type_name'] = isset(pub_mod_clock::$TYPE[$row['type_id']]) ? pub_mod_clock::$TYPE[$row['type_id']] : '';
            }
        }

        /* 分页 */
        $config = array();
        $config['page_name']    = 's';
        $config['count_number'] = $return['count'];
        $config['url']          = $url;
        $config['per_count']    = $limit;
        $config['start']        = $start;
        $return['page']         = pagination($config);

        lib_template::assign('return', $return);
        lib_template::display('email_index.tpl');
    }

    /**
     * 白银
     * 
     * @return void
     */
    public function silver()
    {
        $return = array('state'   => false, 'message' => '');
        $form     = get_params('form', 3);

        if (!empty($form))
        {
            try
            {
                $data = array();
                $data['hign'] = isset($form['hign']) ? $form['hign'] : 0;
                $data['low']  = isset($form['low']) ? $form['low'] : 0;
                $cid          = isset($form['cid']) ? $form['cid'] : 0;
                $startup      = isset($form['startup']) ? $form['startup'] : 0;

                if (empty($data['hign']) || empty($data['low']))
                {
                    T(10001);
                }

                $params = array();
                $params['data']    = $data;
                $params['remark']  = isset($form['remark']) ? $form['remark'] : '';
                $params['state']   = $startup ? pub_mod_clock::STATE_STARTUP : pub_mod_clock::STATE_DEFAULT;
                $params['type_id'] = pub_mod_clock::TYPE_SILVER;
                $result            = pub_mod_clock::edit_clock($cid, $params);

                if (empty($result))
                {
                    T(10000);
                }

                goto_url(URL . '/?ct=email');
                $return['state'] = true;
            }
            catch (Exception $e)
            {
                $return['message'] = $e->getMessage();
            }
        }

        lib_template::display('email_silver.tpl');
    }

}

?>
