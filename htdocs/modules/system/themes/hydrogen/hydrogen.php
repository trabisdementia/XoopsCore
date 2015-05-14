<?php
/**
 * Hydrogen Theme
 * A new control panel theme for XOOPS
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
 * @copyright     The XOOPS project http://sf.net/projects/xoops/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package       system
 * @subpackage    GUI
 * @since         2.6
 * @author        Eduardo Cortés (AKA bitcero)    <i.bitcero@gmail.com>
 * @version       1
 */


class XoopsGuiHydrogen
{

    function header()
    {
        // Hydrogen helper
        include XOOPS_ADMINTHEME_PATH . '/hydrogen/class/hydrogen.class.php';
        include XOOPS_ADMINTHEME_PATH . '/hydrogen/include/hy.translate.php';
        $hydrogen = HydrogenHelper::getInstance();

        $xoops = Xoops::getInstance();
        $xoops->loadLocale('system');

        // URL for theme resources
        $res_url = XOOPS_ADMINTHEME_URL . '/hydrogen';

        $xoops->theme()->addStylesheet("http://fonts.googleapis.com/css?family=Roboto:300,400,500,700");
        $xoops->theme()->addStylesheet( $res_url . '/css/bootstrap.min.css' );
        $xoops->theme()->addStylesheet( $res_url . '/css/xoops-icons.min.css' );
        $xoops->theme()->addStylesheet( $res_url . '/css/perfect-scrollbar.min.css' );
        $xoops->theme()->addStylesheet( $res_url . '/css/hydrogen.min.css' );

        $xoops->theme()->addBaseScriptAssets('@jquery');
        $xoops->theme()->addScript( $res_url . '/js/bootstrap.min.js' );
        $xoops->theme()->addScript( $res_url . '/js/perfect-scrollbar.jquery.min.js' );
        $xoops->theme()->addScript( $res_url . '/js/js.ck.min.js' );
        $xoops->theme()->addScript( $res_url . '/js/hydrogen.min.js' );

        $xoops->tpl()->assign( 'xoops_cp_url', XOOPS_URL . '/modules/system' );
        $hydrogen->add_data('url', $res_url);

        $avatar_provider = $xoops->service('Avatar');
        $admin_data = array(
            'name'      => $xoops->user->getVar('name'),
            'uname'     => $xoops->user->getVar('uname'),
            'avatar'    => $avatar_provider->getAvatarUrl(array('email'=>$xoops->user->getVar('email')))->getValue()
        );
        $hydrogen->add_data('user', $admin_data);

        // System menu
        $adminmenu = array();
        include $xoops->path('/modules/system/menu.php');
        $hydrogen->add_data('systemMenu', $adminmenu);
        unset($adminmenu);

        // Current module menu
        if ($xoops->isModule() && 'system' != $xoops->module->dirname()){
            $hydrogen->add_data('currentModule', array(
                'dirname'   => $xoops->module->dirname(),
                'name'      => $xoops->module->getVar('name'),
                'link'      => $hydrogen->makeModuleLink($xoops->module),
                'icon'      => $hydrogen->getIcon($xoops->module->modinfo['icon']),
                'menu'      => $xoops->module->getAdminMenu()
            ));
        }

        // Modules Menus
        XoopsLoad::load('module', 'system');
        $system_module = new SystemModule();
        $module_list = $system_module->getModuleList();

        foreach ($module_list as $module){
            if ('system' == $module->modinfo['dirname']){
                continue;
            }
            $hydrogen->append_data('modules', array(
                'dirname'   => $module->modinfo['dirname'],
                'name'      => $module->getVar('name'),
                'link'      => $hydrogen->makeModuleLink($module),
                'icon'      => $hydrogen->getIcon($module->modinfo['icon']),
                'menu'      => $module->getAdminMenu()
            ));
        }

        // Extensions Menu
        XoopsLoad::load('extension', 'system');
        $system_extension = new SystemExtension();
        $extension_list = $system_extension->getExtensionList();

        foreach ($extension_list as $extension){
            if ('system' == $extension->modinfo['dirname']){
                continue;
            }
            $hydrogen->append_data('extensions', array(
                'dirname'   => $extension->modinfo['dirname'],
                'name'      => $extension->getVar('name'),
                'link'      => $hydrogen->makeModuleLink($extension),
                'icon'      => $hydrogen->getIcon($extension->modinfo['icon']),
                'menu'      => $extension->getAdminMenu()
            ));
        }

        // is menu collapsed?
        if (isset($_COOKIE['hydrogensb'])){
            $hydrogen->add_data('collapsed', true);
        }

        // Load language
        \Xoops\Core\Helper\PoLocale::getInstance()->loadThemeLocale('hydrogen', true);

        $hydrogen->buildLanguage();

/*

        XoopsLoad::load('extension', 'system');
        $system_extension = new SystemExtension();

        $adminmenu = null;
        include __DIR__ . '/menu.php';
        if (!$xoops->isModule() || 'system' == $xoops->module->getVar('dirname', 'n')) {
            $modpath = XOOPS_URL . '/admin.php';
            //$modname = DefaultThemeLocale::SYSTEM_OPTIONS;
            $modid = 1;
            $moddir = 'system';

            $mod_options = $adminmenu;
            foreach (array_keys($mod_options) as $item) {
                $mod_options[$item]['link'] = empty($mod_options[$item]['absolute'])
                    ? XOOPS_URL . '/modules/' . $moddir . '/' . $mod_options[$item]['link']
                    : $mod_options[$item]['link'];
                $mod_options[$item]['icon'] = empty($mod_options[$item]['icon']) ? ''
                    : XOOPS_ADMINTHEME_URL . '/default/' . $mod_options[$item]['icon'];
                unset($mod_options[$item]['icon_small']);
            }

        } else {
            $moddir = $xoops->module->getVar('dirname', 'n');
            $modpath = XOOPS_URL . '/modules/' . $moddir;
            $modname = $xoops->module->getVar('name');
            $modid = $xoops->module->getVar('mid');

            $mod_options = $xoops->module->getAdminMenu();
            foreach (array_keys($mod_options) as $item) {
                $mod_options[$item]['link'] = empty($mod_options[$item]['absolute'])
                    ? XOOPS_URL . "/modules/{$moddir}/" . $mod_options[$item]['link'] : $mod_options[$item]['link'];
                if ( XoopsLoad::fileExists($xoops->path("/media/xoops/images/icons/32/" . $mod_options[$item]['icon']) ) ) {
                    $mod_options[$item]['icon'] = $xoops->url("/media/xoops/images/icons/32/" . $mod_options[$item]['icon']);
                } else {
                    $mod_options[$item]['icon'] = $xoops->url("/modules/" . $xoops->module->dirname() . "/icons/32/" . $mod_options[$item]['icon']);
                }
            }
        }
        $xoops->tpl()->assign('mod_options', $mod_options);
        $xoops->tpl()->assign('modpath', $modpath);
        $xoops->tpl()->assign('modname', $modname);
        $xoops->tpl()->assign('modid', $modid);
        $xoops->tpl()->assign('moddir', $moddir);

        // Modules list

        $xoops->tpl()->assign('module_menu', $module_list);
        unset($module_list);

        // Extensions list
        $extension_list = $system_extension->getExtensionList();
        $xoops->tpl()->assign('extension_menu', $extension_list);
        unset($extension_list);

        $extension_mod = $system_extension->getExtension( $moddir );
        $xoops->tpl()->assign('extension_mod', $extension_mod);

        // add preferences menu
        $menu = array();

        $OPT = array();

        $menu[] = array(
            'link' => XOOPS_URL . '/modules/system/admin.php?fct=preferences', 'title' => XoopsLocale::PREFERENCES,
            'absolute' => 1, 'url' => XOOPS_URL . '/modules/system/', 'options' => $OPT
        );
        $menu[] = array('title' => 'separator');

        // Module adminmenu
        if ($xoops->isModule() && $xoops->module->getVar('dirname') != 'system') {

            if ($xoops->module->getInfo('system_menu')) {
                //$xoops->theme()->addStylesheet('modules/system/css/menu.css');

                $xoops->module->loadAdminMenu();
                // Get menu tab handler
                /* @var $menu_handler SystemMenuHandler *
                $menu_handler = $xoops->getModuleHandler('menu', 'system');
                // Define top navigation
                $menu_handler->addMenuTop(XOOPS_URL . "/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $xoops->module->getVar('mid', 'e'), XoopsLocale::PREFERENCES);
                if ($xoops->module->getInfo('extension')) {
                    $menu_handler->addMenuTop(XOOPS_URL . "/modules/system/admin.php?fct=extensions&amp;op=update&amp;module=" . $xoops->module->getVar('dirname', 'e'), XoopsLocale::A_UPDATE);
                } else {
                    $menu_handler->addMenuTop(XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&amp;op=update&amp;module=" . $xoops->module->getVar('dirname', 'e'), XoopsLocale::A_UPDATE);
                }
                if ($xoops->module->getInfo('blocks')) {
                    $menu_handler->addMenuTop(XOOPS_URL . "/modules/system/admin.php?fct=blocksadmin&amp;op=list&amp;filter=1&amp;selgen=" . $xoops->module->getVar('mid', 'e') . "&amp;selmod=-2&amp;selgrp=-1&amp;selvis=-1", XoopsLocale::BLOCKS);
                }
                if ($xoops->module->getInfo('hasMain')) {
                    $menu_handler->addMenuTop(XOOPS_URL . "/modules/" . $xoops->module->getVar('dirname', 'e') . "/", SystemLocale::GO_TO_MODULE);
                }
                // Define main tab navigation
                $i = 0;
                $current = $i;
                foreach ($xoops->module->adminmenu as $menu) {
                    if (stripos($_SERVER['REQUEST_URI'], $menu['link']) !== false) {
                        $current = $i;
                    }
                    $menu_handler->addMenuTabs( $xoops->url('modules/' . $xoops->module->getVar('dirname') . '/' . $menu['link']), $menu['title']);
                    ++$i;
                }
                if ($xoops->module->getInfo('help')) {
                    if (stripos($_SERVER['REQUEST_URI'], 'admin/' . $xoops->module->getInfo('help')) !== false) {
                        $current = $i;
                    }
                    $menu_handler->addMenuTabs('../../system/help.php?mid=' . $xoops->module->getVar('mid', 's') . '&amp;' . $xoops->module->getInfo('help'), XoopsLocale::HELP);
                }

                // Display navigation tabs
                $xoops->tpl()->assign('xo_system_menu', $menu_handler->render($current, false));
            }
        }*/

    }

    public function footer()
    {
        $xoops = Xoops::getInstance();
        $xoops->theme()->renderMainTools();

        $hydrogen = HydrogenHelper::getInstance();
        // Breadcrumb
        $hydrogen->add_data('breadcrumb', \Xoops\Core\Helper\Breadcrumb::getInstance()->render());

        $hydrogen->render_data();
    }
}
