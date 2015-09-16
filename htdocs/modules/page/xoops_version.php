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
 * page module
 *
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         page
 * @since           2.6.0
 * @author          Mage Grégory (AKA Mage)
 * @version         $Id$
 */
$modversion                = array();
$modversion['name']        = PageLocale::MODULE_NAME;
$modversion['description'] = PageLocale::MODULE_DESC;
$modversion['version']     = 1;
$modversion['author']      = 'Xoops Core Development Team';
$modversion['nickname']    = 'Mage Laurent JEN (aka DuGris)';
$modversion['credits']     = 'The XOOPS Project';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']    = 1;
$modversion['help']        = 'page=help';
$modversion['image']       = 'images/logo.png';
$modversion['icon']        = 'xicon-file-text';
$modversion['dirname']     = 'page';

//about
$modversion['release_date']        = '2013/01/01';
$modversion['module_website_url']  = 'http://www.xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['module_status']       = 'Alpha';
$modversion['min_php']             = '5.3.7';
$modversion['min_xoops']           = '2.6.0';

// paypal
$modversion['paypal']                  = array();
$modversion['paypal']['business']      = 'xoopsfoundation@gmail.com';
$modversion['paypal']['item_name']     = 'Donation : ' . PageLocale::MODULE_DESC;
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'USD';

// Admin menu
// Set to 1 if you want to display menu generated by system module
$modversion['system_menu'] = 1;

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Scripts to run upon installation or update
$modversion['onInstall'] = 'include/install.php';

// JQuery
$modversion['jquery'] = 1;

// Menu
$modversion['hasMain'] = 1;

// Mysql file
$modversion['schema']           = 'sql/schema.yml';
//$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][1] = 'page_content';
$modversion['tables'][2] = 'page_related';
$modversion['tables'][3] = 'page_related_link';
$modversion['tables'][4] = 'page_rating';

// blocks
$i                                       = 0;
$modversion['blocks'][$i]['file']        = 'page_blocks.php';
$modversion['blocks'][$i]['name']        = PageLocale::BLOCKS_CONTENTS;
$modversion['blocks'][$i]['description'] = PageLocale::BLOCKS_CONTENTS_DSC;
$modversion['blocks'][$i]['show_func']   = 'page_blocks_show';
$modversion['blocks'][$i]['edit_func']   = 'page_blocks_edit';
$modversion['blocks'][$i]['options']     = 'content|create|DESC|5|0';
$modversion['blocks'][$i]['template']    = 'page_blocks.tpl';
++$i;
$modversion['blocks'][$i]['file']        = 'page_blocks.php';
$modversion['blocks'][$i]['name']        = PageLocale::BLOCKS_ID;
$modversion['blocks'][$i]['description'] = PageLocale::BLOCKS_ID_DSC;
$modversion['blocks'][$i]['show_func']   = 'page_blocks_show';
$modversion['blocks'][$i]['edit_func']   = 'page_blocks_edit';
$modversion['blocks'][$i]['options']     = 'id|0';
$modversion['blocks'][$i]['template']    = 'page_blocks_id.tpl';

// Preferences
$i                                       = 0;
$editors                                 = XoopsLists::getDirListAsArray(\XoopsBaseConfig::get('root-path') . '/class/xoopseditor');
$modversion['config'][$i]['name']        = 'page_editor';
$modversion['config'][$i]['title']       = PageLocale::CONF_EDITOR;
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'dhtmltextarea';
$modversion['config'][$i]['options']     = $editors;
++$i;
$modversion['config'][$i]['name']        = 'page_adminpager';
$modversion['config'][$i]['title']       = PageLocale::CONF_ADMINPAGER;
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 20;
++$i;
$modversion['config'][$i]['name']        = 'page_userpager';
$modversion['config'][$i]['title']       = PageLocale::CONF_USERPAGER;
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 20;
++$i;
$modversion['config'][$i]['name']        = 'page_dateformat';
$modversion['config'][$i]['title']       = PageLocale::CONF_DATEFORMAT;
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['options']     = array(
    date('d/m/y') => 'd/m/y',
    date('d-m-y') => 'd-m-y',
    date('d.m.y') => 'd.m.y',
    date('d/m/Y') => 'd/m/Y',
    date('d-m-Y') => 'd-m-Y',
    date('d.m.Y') => 'd.m.Y',
    date('m/d/y') => 'm/d/y',
    date('m-d-y') => 'm-d-y',
    date('m.d.y') => 'm.d.y',
    date('m/d/Y') => 'm/d/Y',
    date('m-d-Y') => 'm-d-Y',
    date('m.d.Y') => 'm.d.Y'
);
$modversion['config'][$i]['default']     = 'm/d/y';
++$i;
$modversion['config'][$i]['name']        = 'page_timeformat';
$modversion['config'][$i]['title']       = PageLocale::CONF_TIMEFORMAT;
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['options']     = array(date('H:i') => 'H:i', date('H:i:s') => 'H:i:s', date('H:i A') => 'H:i A', date('H:i:s A ') => 'H:i:s A');
$modversion['config'][$i]['default']     = 'H:i:s';
