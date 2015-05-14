<?php
/**
 * Module System menu
 *
 * Copyright © 2015 The XOOPS project http://sf.net/projects/xoops/
 * -----------------------------------------------------------------
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * -----------------------------------------------------------------
 * @copyright    The XOOPS project http://sf.net/projects/xoops/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package      system
 * @since        2.6
 * @author       Eduardo Cortés (AKA bitcero)    <i.bitcero@gmail.com>
 * @version      1
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

$adminmenu = array(

    // Blocks management
    array(
        'title'     => __('Blocks', 'hydrogen'),
        'link'      => 'blocks.php',
        'icon'      => 'xicon-dashboard'
    ),

    // Extensions management
    array(
        'title'     => __('Extensions', 'hydrogen'),
        'link'      => 'extensions.php',
        'icon'      => 'xicon-extension'
    ),

    // Groups management
    array(
        'title'     => __('Groups', 'hydrogen'),
        'link'      => 'groups.php',
        'icon'      => 'xicon-group'
    ),

    // Users management
    array(
        'title'     => __('Users', 'hydrogen'),
        'link'      => 'users.php',
        'icon'      => 'xicon-user'
    ),

    // Modules management
    array(
        'title'     => __('Modules', 'hydrogen'),
        'link'      => 'modules.php',
        'icon'      => 'xicon-module'
    ),

    // Preferences
    array(
        'title'     => __('Settings', 'hydrogen'),
        'link'      => 'settings.php',
        'icon'      => 'xicon-equalizer-v'
    ),

    // Services
    array(
        'title'     => __('Services', 'hydrogen'),
        'link'      => 'services.php',
        'icon'      => 'xicon-swap-v'
    ),

    // Template sets
    array(
        'title'     => __('Templates', 'hydrogen'),
        'link'      => 'tplsets.php',
        'icon'      => 'xicon-layers'
    ),

);

$adminmenu = \Xoops::getInstance()->events()->triggerReturnEvent('system.admin.menu', array($adminmenu));

/*
$xoops = Xoops::getInstance();
$groups = array();
if (is_object($xoops->user)) {
    $groups = $xoops->user->getGroups();
}

$all_ok = false;
if (!in_array(XOOPS_GROUP_ADMIN, $groups)) {
    $sysperm_handler = $xoops->getHandlerGroupperm();
    $ok_syscats = $sysperm_handler->getItemIds('system_admin', $groups);
} else {
    $all_ok = true;
}
// include system category definitions
include_once $xoops->path('/modules/system/constants.php');

$admin_dir = $xoops->path('/modules/system/admin');
$dirlist = XoopsLists::getDirListAsArray($admin_dir);
$index = 0;
foreach ($dirlist as $file) {
    if (XoopsLoad::fileExists($fileinc = $admin_dir . '/' . $file . '/xoops_version.php')) {
        include $fileinc;
        unset($fileinc);
        if ($modversion['hasAdmin']) {
            if ($xoops->getModuleConfig('active_' . $file, 'system')) {
                $category = isset($modversion['category']) ? intval($modversion['category']) : 0;
                if (false != $all_ok || in_array($modversion['category'], $ok_syscats)) {
                    $adminmenu[$index]['title'] = trim($modversion['name']);
                    $adminmenu[$index]['link'] = 'admin.php?fct=' . $file;
                    $adminmenu[$index]['image'] = $modversion['image'];
                }
            }
        }
        unset($modversion);
    }
    ++$index;
}
unset($dirlist);
*/