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
 * Protector
 *
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         protector
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id$
 */

$xoops = Xoops::getInstance();
/*
 General settings
 */
$modversion['name']        = _MI_PROTECTOR_NAME;
$modversion['description'] = constant('_MI_PROTECTOR_DESC');
$modversion['version']     = file_get_contents(__DIR__ . '/include/version.txt');
$modversion['credits']     = "PEAK Corp.";
$modversion['author']      = "GIJ=CHECKMATE PEAK Corp.(http://www.peak.ne.jp/)";
$modversion['help']        = 'page=help';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = "www.gnu.org/licenses/gpl-2.0.html/";
$modversion['official']    = 1;
$modversion['image']       = 'images/logo.png';
$modversion['icon']        = 'xicon-security';
$modversion['dirname']     = 'protector';

/*
 Settings for configs
*/
$modversion['release_date']        = '2011/10/08';
$modversion["module_website_url"]  = "http://www.xoops.org/";
$modversion["module_website_name"] = "XOOPS";
$modversion["module_status"]       = "RC";
$modversion['min_php']             = '5.3.7';
$modversion['min_xoops']           = "2.6.0";
$modversion['min_db']              = array('mysql' => '5.0.7', 'mysqli' => '5.0.7');

/*
 Admin menu
 Set to 1 if you want to display menu generated by system module
*/
$modversion['system_menu'] = 1;

/*
 Manage extension
 */
$modversion['extension'] = 1;
$modversion['extension_module'][] = 'system';

/*
 Mysql and tables
 */
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][0] = "protector_log";
$modversion['tables'][1] = "protector_access";

/*
 Admin things
*/
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Admin Templates
$modversion['templates'][] = array( 'file' => 'protector_advisory.html', 'description' => '', 'type' => 'admin' );
$modversion['templates'][] = array( 'file' => 'protector_prefix.html', 'description' => '', 'type' => 'admin' );
$modversion['templates'][] = array( 'file' => 'protector_center.html', 'description' => '', 'type' => 'admin' );

/*
 Blocks
*/
$modversion['blocks'] = array();

/*
 Menu
*/
$modversion['hasMain'] = 0;

/*
 Preferences
*/
$modversion['config'][1] = array(
    'name'             => 'global_disabled',
    'title'            => '_MI_PROTECTOR_GLOBAL_DISBL',
    'description'      => '_MI_PROTECTOR_GLOBAL_DISBLDSC',
    'formtype'         => 'yesno',
    'valuetype'        => 'int',
    'default'          => "0",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'default_lang',
    'title'            => '_MI_PROTECTOR_DEFAULT_LANG',
    'description'      => '_MI_PROTECTOR_DEFAULT_LANGDSC',
    'formtype'         => 'text',
    'valuetype'        => 'text',
    'default'          => $xoops->getConfig('language'),
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'log_level',
    'title'            => '_MI_PROTECTOR_LOG_LEVEL',
    'description'      => '',
    'formtype'         => 'select',
    'valuetype'        => 'int',
    'default'          => 255,
    'options'          => array(
        '_MI_PROTECTOR_LOGLEVEL0'   => 0,
        '_MI_PROTECTOR_LOGLEVEL15'  => 15,
        '_MI_PROTECTOR_LOGLEVEL63'  => 63,
        '_MI_PROTECTOR_LOGLEVEL255' => 255
    )
);
$modversion['config'][] = array(
    'name'             => 'banip_time0',
    'title'            => '_MI_PROTECTOR_BANIP_TIME0',
    'description'      => '',
    'formtype'         => 'text',
    'valuetype'        => 'int',
    'default'          => 86400,
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'reliable_ips',
    'title'            => '_MI_PROTECTOR_RELIABLE_IPS',
    'description'      => '_MI_PROTECTOR_RELIABLE_IPSDSC',
    'formtype'         => 'textarea',
    'valuetype'        => 'array',
    'default'          => "^192.168.|127.0.0.1",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'session_fixed_topbit',
    'title'            => '_MI_PROTECTOR_HIJACK_TOPBIT',
    'description'      => '_MI_PROTECTOR_HIJACK_TOPBITDSC',
    'formtype'         => 'text',
    'valuetype'        => 'int',
    'default'          => 24,
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'groups_denyipmove',
    'title'            => '_MI_PROTECTOR_HIJACK_DENYGP',
    'description'      => '_MI_PROTECTOR_HIJACK_DENYGPDSC',
    'formtype'         => 'group_multi',
    'valuetype'        => 'array',
    'default'          => array(1),
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'san_nullbyte',
    'title'            => '_MI_PROTECTOR_SAN_NULLBYTE',
    'description'      => '_MI_PROTECTOR_SAN_NULLBYTEDSC',
    'formtype'         => 'yesno',
    'valuetype'        => 'int',
    'default'          => "1",
    'options'          => array()
);
/* $modversion['config'][] = array(
    'name'          => 'die_nullbyte' ,
    'title'         => '_MI_PROTECTOR_DIE_NULLBYTE' ,
    'description'   => '_MI_PROTECTOR_DIE_NULLBYTEDSC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => "1" ,
    'options'       => array()
) ; */
$modversion['config'][] = array(
    'name'             => 'die_badext',
    'title'            => '_MI_PROTECTOR_DIE_BADEXT',
    'description'      => '_MI_PROTECTOR_DIE_BADEXTDSC',
    'formtype'         => 'yesno',
    'valuetype'        => 'int',
    'default'          => "1",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'contami_action',
    'title'            => '_MI_PROTECTOR_CONTAMI_ACTION',
    'description'      => '_MI_PROTECTOR_CONTAMI_ACTIONDS',
    'formtype'         => 'select',
    'valuetype'        => 'int',
    'default'          => 3,
    'options'          => array(
        '_MI_PROTECTOR_OPT_NONE'     => 0,
        '_MI_PROTECTOR_OPT_EXIT'     => 3,
        '_MI_PROTECTOR_OPT_BIPTIME0' => 7,
        '_MI_PROTECTOR_OPT_BIP'      => 15
    )
);
$modversion['config'][] = array(
    'name'             => 'isocom_action',
    'title'            => '_MI_PROTECTOR_ISOCOM_ACTION',
    'description'      => '_MI_PROTECTOR_ISOCOM_ACTIONDSC',
    'formtype'         => 'select',
    'valuetype'        => 'int',
    'default'          => 0,
    'options'          => array(
        '_MI_PROTECTOR_OPT_NONE'     => 0,
        '_MI_PROTECTOR_OPT_SAN'      => 1,
        '_MI_PROTECTOR_OPT_EXIT'     => 3,
        '_MI_PROTECTOR_OPT_BIPTIME0' => 7,
        '_MI_PROTECTOR_OPT_BIP'      => 15
    )
);
$modversion['config'][] = array(
    'name'             => 'union_action',
    'title'            => '_MI_PROTECTOR_UNION_ACTION',
    'description'      => '_MI_PROTECTOR_UNION_ACTIONDSC',
    'formtype'         => 'select',
    'valuetype'        => 'int',
    'default'          => 0,
    'options'          => array(
        '_MI_PROTECTOR_OPT_NONE'     => 0,
        '_MI_PROTECTOR_OPT_SAN'      => 1,
        '_MI_PROTECTOR_OPT_EXIT'     => 3,
        '_MI_PROTECTOR_OPT_BIPTIME0' => 7,
        '_MI_PROTECTOR_OPT_BIP'      => 15
    )
);
$modversion['config'][] = array(
    'name'             => 'id_forceintval',
    'title'            => '_MI_PROTECTOR_ID_INTVAL',
    'description'      => '_MI_PROTECTOR_ID_INTVALDSC',
    'formtype'         => 'yesno',
    'valuetype'        => 'int',
    'default'          => "0",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'file_dotdot',
    'title'            => '_MI_PROTECTOR_FILE_DOTDOT',
    'description'      => '_MI_PROTECTOR_FILE_DOTDOTDSC',
    'formtype'         => 'yesno',
    'valuetype'        => 'int',
    'default'          => "1",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'bf_count',
    'title'            => '_MI_PROTECTOR_BF_COUNT',
    'description'      => '_MI_PROTECTOR_BF_COUNTDSC',
    'formtype'         => 'text',
    'valuetype'        => 'int',
    'default'          => "10",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'bwlimit_count',
    'title'            => '_MI_PROTECTOR_BWLIMIT_COUNT',
    'description'      => '_MI_PROTECTOR_BWLIMIT_COUNTDSC',
    'formtype'         => 'text',
    'valuetype'        => 'int',
    'default'          => 0,
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'dos_skipmodules',
    'title'            => '_MI_PROTECTOR_DOS_SKIPMODS',
    'description'      => '_MI_PROTECTOR_DOS_SKIPMODSDSC',
    'formtype'         => 'text',
    'valuetype'        => 'text',
    'default'          => "",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'dos_expire',
    'title'            => '_MI_PROTECTOR_DOS_EXPIRE',
    'description'      => '_MI_PROTECTOR_DOS_EXPIREDSC',
    'formtype'         => 'text',
    'valuetype'        => 'int',
    'default'          => "60",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'dos_f5count',
    'title'            => '_MI_PROTECTOR_DOS_F5COUNT',
    'description'      => '_MI_PROTECTOR_DOS_F5COUNTDSC',
    'formtype'         => 'text',
    'valuetype'        => 'int',
    'default'          => "20",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'dos_f5action',
    'title'            => '_MI_PROTECTOR_DOS_F5ACTION',
    'description'      => '',
    'formtype'         => 'select',
    'valuetype'        => 'text',
    'default'          => "exit",
    'options'          => array(
        '_MI_PROTECTOR_DOSOPT_NONE'     => 'none',
        '_MI_PROTECTOR_DOSOPT_SLEEP'    => 'sleep',
        '_MI_PROTECTOR_DOSOPT_EXIT'     => 'exit',
        '_MI_PROTECTOR_DOSOPT_BIPTIME0' => 'biptime0',
        '_MI_PROTECTOR_DOSOPT_BIP'      => 'bip',
        '_MI_PROTECTOR_DOSOPT_HTA'      => 'hta'
    )
);
$modversion['config'][] = array(
    'name'             => 'dos_crcount',
    'title'            => '_MI_PROTECTOR_DOS_CRCOUNT',
    'description'      => '_MI_PROTECTOR_DOS_CRCOUNTDSC',
    'formtype'         => 'text',
    'valuetype'        => 'int',
    'default'          => "40",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'dos_craction',
    'title'            => '_MI_PROTECTOR_DOS_CRACTION',
    'description'      => '',
    'formtype'         => 'select',
    'valuetype'        => 'text',
    'default'          => "exit",
    'options'          => array(
        '_MI_PROTECTOR_DOSOPT_NONE'     => 'none',
        '_MI_PROTECTOR_DOSOPT_SLEEP'    => 'sleep',
        '_MI_PROTECTOR_DOSOPT_EXIT'     => 'exit',
        '_MI_PROTECTOR_DOSOPT_BIPTIME0' => 'biptime0',
        '_MI_PROTECTOR_DOSOPT_BIP'      => 'bip',
        '_MI_PROTECTOR_DOSOPT_HTA'      => 'hta'
    )
);
$modversion['config'][] = array(
    'name'             => 'dos_crsafe',
    'title'            => '_MI_PROTECTOR_DOS_CRSAFE',
    'description'      => '_MI_PROTECTOR_DOS_CRSAFEDSC',
    'formtype'         => 'text',
    'valuetype'        => 'text',
    'default'          => "/(msnbot|Googlebot|Yahoo! Slurp)/i",
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'bip_except',
    'title'            => '_MI_PROTECTOR_BIP_EXCEPT',
    'description'      => '_MI_PROTECTOR_BIP_EXCEPTDSC',
    'formtype'         => 'group_multi',
    'valuetype'        => 'array',
    'default'          => array(1),
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'disable_features',
    'title'            => '_MI_PROTECTOR_DISABLES',
    'description'      => '',
    'formtype'         => 'select',
    'valuetype'        => 'int',
    'default'          => 1,
    'options'          => array(
        'xmlrpc'               => 1,
        'xmlrpc + 2.0.9.2 bugs'=> 1025,
        '_NONE'                => 0
    )
);
$modversion['config'][] = array(
    'name'             => 'enable_dblayertrap',
    'title'            => '_MI_PROTECTOR_DBLAYERTRAP',
    'description'      => '_MI_PROTECTOR_DBLAYERTRAPDSC',
    'formtype'         => 'yesno',
    'valuetype'        => 'int',
    'default'          => 1,
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'dblayertrap_wo_server',
    'title'            => '_MI_PROTECTOR_DBTRAPWOSRV',
    'description'      => '_MI_PROTECTOR_DBTRAPWOSRVDSC',
    'formtype'         => 'yesno',
    'valuetype'        => 'int',
    'default'          => 0,
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'enable_bigumbrella',
    'title'            => '_MI_PROTECTOR_BIGUMBRELLA',
    'description'      => '_MI_PROTECTOR_BIGUMBRELLADSC',
    'formtype'         => 'yesno',
    'valuetype'        => 'int',
    'default'          => 1,
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'spamcount_uri4user',
    'title'            => '_MI_PROTECTOR_SPAMURI4U',
    'description'      => '_MI_PROTECTOR_SPAMURI4UDSC',
    'formtype'         => 'textbox',
    'valuetype'        => 'int',
    'default'          => 0,
    'options'          => array()
);
$modversion['config'][] = array(
    'name'             => 'spamcount_uri4guest',
    'title'            => '_MI_PROTECTOR_SPAMURI4G',
    'description'      => '_MI_PROTECTOR_SPAMURI4GDSC',
    'formtype'         => 'textbox',
    'valuetype'        => 'int',
    'default'          => 5,
    'options'          => array()
);

$modversion['config'][] = array(
    'name'             => 'stopforumspam_action',
    'title'            => '_MI_PROTECTOR_STOPFORUMSPAM_ACTION',
    'description'      => '_MI_PROTECTOR_STOPFORUMSPAM_ACTIONDSC',
    'formtype'         => 'select',
    'valuetype'        => 'text',
    'default'          => 'none',
    'options'          => array(
        '_NONE'                      => 'none',
        '_MI_PROTECTOR_OPT_NONE'     => 'log',
        '_MI_PROTECTOR_OPT_SAN'      => 'san',
        '_MI_PROTECTOR_OPT_BIPTIME0' => 'biptime0',
        '_MI_PROTECTOR_OPT_BIP'      => 'bip'
    )
);

/*
 Comments
*/
$modversion['hasComments'] = 0;

/*
 Notification
*/
$modversion['hasNotification'] = 0;
