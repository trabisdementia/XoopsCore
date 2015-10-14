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
 * banners module
 *
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         banners
 * @since           2.6.0
 * @author          Mage Gregory (AKA Mage)
 * @version         $Id: $
 */
$modversion = array();
$modversion['name']           = _MI_BANNERS_NAME;
$modversion['description']    = _MI_BANNERS_DESC;
$modversion['version']        = 0.1;
$modversion['author']         = 'Mage Gregory';
$modversion['nickname']       = 'Mage';
$modversion['credits']        = 'The XOOPS Project';
$modversion['license']        = 'GNU GPL 2.0';
$modversion['license_url']    = 'http://www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']       = 1;
$modversion['help']           = 'page=help';
$modversion['image']          = 'images/logo.png';
$modversion['icon']           = 'xicon-irradescent';
$modversion['dirname']        = 'banners';

$modversion['author']      = array(
    array(
        'name'      => 'Mage Gregory',
        'email'     => '',
        'aka'       => 'Mage',
        'url'       => 'http://xoops.org'
    )
);

$modversion['website']     = array(
    'url'   => 'http://xoops.org',
    'name'  => 'XOOPS'
);

//about
$modversion['release_date']        = '2011/01/02';
$modversion['module_website_url']  = 'http://www.xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['module_status']       = 'ALPHA';
$modversion['min_php']             = '5.3.7';
$modversion['min_xoops']           = '2.6.0';

// paypal
$modversion['paypal']                  = array();
$modversion['paypal']['business']      = 'xoopsfoundation@gmail.com';
$modversion['paypal']['item_name']     = 'Donation : ' . _MI_BANNERS_DESC;
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

// table definitions
$modversion['schema'] = 'sql/schema.yml';
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file or schema (without prefix!)
$modversion['tables'] = array(
    'banners_banner',
    'banners_bannerclient',
);

// blocks
$modversion['blocks'][] = array(
    'file'        => 'banners_blocks.php',
    'name'        => _MI_BANNERS_BLOCKS_RANDOM,
    'description' => _MI_BANNERS_BLOCKS_RANDOMDSC,
    'show_func'   => 'banners_blocks_show',
    'edit_func'   => 'banners_blocks_edit',
    'options'     => 'random|1|H|0',
    'template'    => 'banners_blocks_random.tpl',
);

$modversion['blocks'][] = array(
    'file'        => 'banners_blocks.php',
    'name'        => _MI_BANNERS_BLOCKS_ID,
    'description' => _MI_BANNERS_BLOCKS_IDDSC,
    'show_func'   => 'banners_blocks_show',
    'edit_func'   => 'banners_blocks_edit',
    'options'     => 'id||H',
    'template'    => 'banners_blocks_id.tpl',
);

// Preferences
$modversion['config'][] = array(
    'name'        => 'banners_myip',
    'title'       => '_MI_BANNERS_PREFERENCE_MYIP',
    'description' => '_MI_BANNERS_PREFERENCE_MYIPDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '127.0.0.1',
);

$modversion['config'][] = array(
    'name'        => 'banners_pager',
    'title'       => '_MI_BANNERS_PREFERENCE_PAGER',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 15,
);

$modversion['config'][] = array(
    'name'        => 'banners_clientspager',
    'title'       => '_MI_BANNERS_PREFERENCE_CLIENTSPAGER',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 15,
);
