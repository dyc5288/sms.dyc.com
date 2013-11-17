<?php

/**
 * 主页
 * 
 * @author duanyunchao
 * @version $Id$
 */
!defined('IN_INIT') && exit('Access Denied');

require_once 'ctl_parent.php';

class ctl_index extends ctl_parent
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
        lib_template::display('index.tpl');
    }

}
