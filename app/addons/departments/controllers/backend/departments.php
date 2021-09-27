<?php

use Tygh\Registry;
use Tygh\Languages\Languages;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    $suffix = '';

    if ($mode == 'update_department') {
        $department_id = !empty($_REQUEST['department_id']) ? $_REQUEST['department_id'] : 0;
        $data = !empty($_REQUEST['department_data']) ? $_REQUEST['department_data'] : [];
        $department_id = fn_update_department($data, $department_id);
        if (!empty($department_id)) {
            $suffix = ".update_department?department_id={$department_id}";
        } else {
            $suffix = ".add_department";
        }
    } elseif ($mode == 'delete_department') {
        $department_id = !empty($_REQUEST['department_id']) ? $_REQUEST['department_id'] : 0;
        fn_delete_department($department_id);
        $suffix = ".manage_departments";
    }
    return [CONTROLLER_STATUS_OK, 'departments' . $suffix];

}

if ($mode == 'add_department' || $mode == 'update_department') {
    
    $department_id = !empty($_REQUEST['department_id']) ? $_REQUEST['department_id'] : 0;
    $department_data = fn_get_department_data($department_id, DESCR_SL);

    if (empty($department_data) && $mode == 'update') {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    Tygh::$app['view']->assign([
        'department_data' => $department_data,
        'u_info' => !empty($department_data['user_id']) ? fn_get_user_short_info($department_data['user_id']) : [],
        ]);
}

if ($mode == 'manage_departments') {
    // fn_print_die('test');
    list($departments, $search) = fn_get_departments($_REQUEST, Registry::get('settings.Appearance.admin_elements_per_page'), DESCR_SL);
     Tygh::$app['view']->assign('departments', $departments);
     Tygh::$app['view']->assign('search', $search);
} 
