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
 * avatars extension
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         avatar
 * @since           2.6.0
 * @author          Mage Grégory (AKA Mage)
 * @version         $Id$
 */
$modversion                = array();
$modversion['name']        = AvatarsLocale::MODULE_NAME;
$modversion['description'] = AvatarsLocale::MODULE_DESC;
$modversion['version']     = 0.1;
$modversion['author']      = 'Andricq Nicolas,Mage Gregory';
$modversion['nickname']    = 'MusS,Mage';
$modversion['credits']     = 'The XOOPS Project';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']    = 1;
$modversion['help']        = 'page=help';
$modversion['image']       = 'images/logo.png';
$modversion['icon']        = 'xicon-user-o';
$modversion['dirname']     = 'avatars';
//about
$modversion['release_date']        = '2012/01/15';
$modversion['module_website_url']  = 'http://www.xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['module_status']       = 'ALPHA';
$modversion['min_php']             = '5.3.7';
$modversion['min_xoops']           = '2.6.0';

// paypal
$modversion['paypal'] = array(
    'business'      => 'xoopsfoundation@gmail.com',
    'item_name'     => 'Donation : ' . AvatarsLocale::MODULE_DESC,
    'amount'        => 0,
    'currency_code' => 'USD',
);

// Admin menu
// Set to 1 if you want to display menu generated by system module
$modversion['system_menu'] = 1;

/*
 Manage extension
 */
$modversion['extension'] = 1;
$modversion['extension_module'][] = 'system';

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Scripts to run upon installation or update
$modversion['onInstall'] = 'include/install.php';

// Table definitions
$modversion['schema'] = 'sql/schema.yml';
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables created by sql file or schema (without prefix!)
$modversion['tables'] = array(
    'avatars_avatar',
    'avatars_user_link',
);

// JQuery
$modversion['jquery'] = 1;

// Preferences
$modversion['config'][] = array(
    'name'        => 'avatars_allowupload',
    'title'       => 'CONF_ALLOWUPLOAD',
    'description' => '',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
);

$modversion['config'][] = array(
    'name'        => 'avatars_postsrequired',
    'title'       => 'CONF_POSTSREQUIRED',
    'description' => 'CONF_POSTSREQUIREDDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 0,
);

$modversion['config'][] = array(
    'name'        => 'avatars_imagewidth',
    'title'       => 'CONF_IMAGEWIDTH',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 128,
);

$modversion['config'][] = array(
    'name'        => 'avatars_imageheight',
    'title'       => 'CONF_IMAGEHEIGHT',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 128,
);

$modversion['config'][] = array(
    'name'        => 'avatars_imagefilesize',
    'title'       => 'CONF_IMAGEFILESIZE',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 35000,
);

$modversion['config'][] = array(
    'name'        => 'avatars_pager',
    'title'       => 'CONF_PAGER',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 20,
);
