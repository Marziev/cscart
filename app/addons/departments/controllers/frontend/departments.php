<?php

use Tygh\Registry;
use Tygh\Languages\Languages;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == 'departments') {

    Tygh::$app['session']['continue_url'] = "departments.departments";
    $params = $_REQUEST;

    if ($items_per_page = fn_change_session_param(Tygh::$app['session'], $_REQUEST, 'items_per_page')) {
        $params['items_per_page'] = $items_per_page;
    }
    if ($sort_by = fn_change_session_param(Tygh::$app['session'], $_REQUEST, 'sort_by')) {
        $params['sort_by'] = $sort_by;
    }
    if ($sort_order = fn_change_session_param(Tygh::$app['session'], $_REQUEST, 'sort_order')) {
        $params['sort_order'] = $sort_order;
    }

    $params['user_id'] = Tygh::$app['session']['auth']['user_id'];
    list($departments, $search) = fn_get_departments($params, 3, CART_LANGUAGE);

    Tygh::$app['view']->assign('departments', $departments);
    Tygh::$app['view']->assign('search', $search);
    Tygh::$app['view']->assign('columns', 3);

    fn_add_breadcrumb(__('departments'));

} elseif ($mode === 'department') {
    
$department_data = [];
$department_id = !empty($_REQUEST['department_id']) ? $_REQUEST['department_id'] : 0;
$department_data = fn_get_department_data($department_id, CART_LANGUAGE);

    if (empty($department_data)) {
        return [CONTROLLER_STATUS_NO_PAGE];
    }

Tygh::$app['view']->assign('department_data', $department_data);

fn_add_breadcrumb($department_data['department']);

$params = $_REQUEST;
$params['extend'] = ['description'];
$params['item_ids'] = !empty($department_data['staff_ids']) ? implode(',', $department_data['staff_ids']) : -1;

if ($items_per_page = fn_change_session_param(Tygh::$app['session']['search_params'], $_REQUEST, 'items_per_page')) {
    $params['items_per_page'] = $items_per_page;
}
if ($sort_by = fn_change_session_param(Tygh::$app['session']['search_params'], $_REQUEST, 'sort_by')) {
    $params['sort_by'] = $sort_by;
}
if ($sort_order = fn_change_session_param(Tygh::$app['session']['search_params'], $_REQUEST, 'sort_order')) {
    $params['sort_order'] = $sort_order;
}

list($staffs, $search) = fn_get_users($params, Registry::get('settings.Appearance.admin_per_page'));
fn_filters_handle_search_result($params, $staffs, $search);
fn_gather_additional_products_data($staffs, [
    'get_icon'      => true,
    'get_detailed'  => true,
    'get_options'   => true,
    'get_discounts' => true,
    'get_features'  => false
]);

$selected_layout = fn_get_products_layout($_REQUEST);
$h_department = fn_get_user_info($department_data['user_id']);

Tygh::$app['view']->assign('staffs', $staffs);
Tygh::$app['view']->assign('search', $search);
Tygh::$app['view']->assign('selected_layout', $selected_layout);
Tygh::$app['view']->assign('h_department', $h_department);
}
