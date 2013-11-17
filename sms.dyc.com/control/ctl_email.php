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
        lib_template::display('email_index.tpl');
    }

}

?>
