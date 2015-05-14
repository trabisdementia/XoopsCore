<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * @package   thumbs
 * @author    Richard Griffith <richard@geekwright.com>
 * @copyright 2014 The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license   GNU GPL v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link      http://xoops.org
 */

$modversion                = array();
$modversion['name']        = _MI_THUMBS_NAME;
$modversion['description'] = _MI_THUMBS_DESC;
$modversion['version']     = 1.0;
$modversion['author']      = 'Xoops Core Development Team';
$modversion['nickname']    = 'geekwright <richard@geekwright.com>';
$modversion['credits']     = 'The XOOPS Project';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']    = 1;
$modversion['help']        = 'page=help';
$modversion['image']       = 'images/logo.png';
$modversion['icon']        = 'xicon-thumbnails';
$modversion['dirname']     = 'thumbs';

//about
$modversion['release_date']        = '2014/07/28';
$modversion['module_website_url']  = 'http://www.xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['module_status']       = 'ALPHA 1';
$modversion['min_php']             = '5.3.7';
$modversion['min_xoops']           = '2.6.0';

// paypal
$modversion['paypal'] = array(
    'business'      => 'xoopsfoundation@gmail.com',
    'item_name'     => _MI_THUMBS_DESC,
    'amount'        => 0,
    'currency_code' => 'USD',
);

// Manage extension
$modversion['extension'] = 1;

// Admin menu
// Set to 1 if you want to display menu generated by system module
$modversion['system_menu'] = 1;

// Admin things
$modversion['hasAdmin']   = true;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 0;

// Blocks
//$modversion['blocks'] = array();

// Preferences
$modversion['config'] = array();

$modversion['config'][] = array(
    'name'        => 'thumbs_width',
    'title'       => '_MI_THUMBS_MAX_WIDTH',
    'description' => '_MI_THUMBS_MAX_WIDTH_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 128,
);

$modversion['config'][] = array(
    'name'        => 'thumbs_height',
    'title'       => '_MI_THUMBS_MAX_HEIGHT',
    'description' => '_MI_THUMBS_MAX_HEIGHT_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 128,
);
