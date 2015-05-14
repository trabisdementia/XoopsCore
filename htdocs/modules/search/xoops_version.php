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
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         logger
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id$
 */

$modversion                = array();
$modversion['name']        = _MI_SEARCH_NAME;
$modversion['description'] = _MI_SEARCH_DSC;
$modversion['version']     = 0.1;
$modversion['author']      = 'Trabis';
$modversion['nickname']    = 'trabis';
$modversion['credits']     = 'The XOOPS Project';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']    = 1;
//$modversion['help']           = 'page=help';
$modversion['image']   = 'images/logo.png';
$modversion['icon']    = 'xicon-search-square';
$modversion['dirname'] = 'search';

//about
$modversion['release_date']        = '2012/11/25';
$modversion['module_website_url']  = 'http://www.xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['module_status']       = 'ALPHA 1';
$modversion['min_php']             = '5.3.7';
$modversion['min_xoops']           = '2.6.0';

// paypal
$modversion['paypal'] = array(
    'business'      => 'xoopsfoundation@gmail.com',
    'item_name'     => '',
    'amount'        => 0,
    'currency_code' => 'USD',
);

// Admin menu
// Set to 1 if you want to display menu generated by system module
$modversion['system_menu'] = 1;
$modversion['onUpdate']    = 'include/update.php';

/*
 Manage extension
 */
$modversion['extension'] = 0;

// Admin things
$modversion['hasAdmin'] = 0;

// Menu
$modversion['hasMain'] = 1;

/*
 Blocks
*/
$modversion['blocks'] = array();

$modversion['blocks'][] = array(
    'file'        => 'search_blocks.php',
    'name'        => _MI_SEARCH_BNAME1,
    'description' => 'Shows search form block',
    'show_func'   => 'b_search_show',
    'template'    => 'block_search.tpl',
);

// Preferences
$modversion['config'] = array();

$modversion['config'][] = array(
    'name'        => 'enable_search',
    'title'       => '_MI_SEARCH_DOSEARCH',
    'description' => '_MI_SEARCH_DOSEARCHDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
);

$modversion['config'][] = array(
    'name'        => 'keyword_min',
    'title'       => '_MI_SEARCH_MINSEARCH',
    'description' => '_MI_SEARCH_MINSEARCHDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 3,
);
