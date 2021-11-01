<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/
use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if ($mode == 'test') {
        $d = $_REQUEST['day'];
        $m = $_REQUEST['month'];
        $y = $_REQUEST['year'];

        $age = getAge($y, $m, $d);
        if ($age >= 18) {
            fn_set_cookie('AGECHECK', 'allow');
        } else {
            fn_set_cookie('AGECHECK', 'deny');
        }
        
        return [CONTROLLER_STATUS_OK, "index.index"]; 
    }
}

