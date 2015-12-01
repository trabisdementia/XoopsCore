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
        $xoops = Xoops::getInstance();
        // Hydrogen helper
        include $xoops->path('modules/system/themes/hydrogen/class/hydrogen.class.php');
        include $xoops->path('modules/system/themes/hydrogen/include/hy.translate.php');
        $hydrogen = HydrogenHelper::getInstance();

        $xoops->loadLocale('system');

        // URL for theme resources
        $res_url = $xoops->url('modules/system/themes/hydrogen');

        $xoops->theme()->addStylesheet("http://fonts.googleapis.com/css?family=Roboto:300,400,500,700");
        $xoops->theme()->addStylesheet( $res_url . '/css/bootstrap.min.css' );
        $xoops->theme()->addStylesheet( $res_url . '/css/xoops-icons.min.css' );
        $xoops->theme()->addStylesheet( $res_url . '/css/perfect-scrollbar.min.css' );
        $xoops->theme()->addStylesheet( $res_url . '/css/hydrogen.min.css' );
        $xoops->theme()->headContent(null, '<script>var xoURL = "' . $xoops->url() . '";</script>');

        $xoops->theme()->addScript( $res_url . '/js/bootstrap.min.js' );
        //$xoops->theme()->addScript( $res_url . '/js/perfect-scrollbar.jquery.min.js' );
        $xoops->theme()->addScript( $res_url . '/js/js.ck.min.js' );
        $xoops->theme()->addScript( $res_url . '/js/hydrogen.min.js' );

        $xoops->tpl()->assign( 'xoops_cp_url', $xoops->url('admin.php') );
        $xoops->tpl()->assign('xoops_url', rtrim($xoops->url(), '/'));
        $hydrogen->add_data('url', $res_url);

        // Include Javascript language strings
        include $xoops->path('/modules/system/include/js-lang.php');

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
        if ($xoops->isModule()){
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
            if ('system' == $module->modinfo['dirname'] || !$module->getVar('isactive')){
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

        if ($xoops->isModule()){
            $xoops->theme()->addBodyClass($xoops->module->dirname());
        } else {
            $xoops->theme()->addBodyClass('system');
        }

        // Load language
        \Xoops\Core\Helper\PoLocale::getInstance()->loadThemeLocale('hydrogen', true);

        $hydrogen->buildLanguage();
        $xoops->tpl()->assign('token_value', $xoops->security()->createToken());

    }

    public function footer()
    {
        $xoops = Xoops::getInstance();
        $xoops->theme()->renderMainTools();

        $hydrogen = HydrogenHelper::getInstance();
        // Breadcrumb
        $hydrogen->add_data('breadcrumb', \Xoops\Core\Helper\Breadcrumb::getInstance()->render());

        // Body classes
        $hydrogen->add_data('body_classes', $xoops->theme()->renderBodyClasses());

        // Toolbar
        $hydrogen->add_data('toolbar', \Xoops\Core\Helper\Toolbar::getInstance()->render());

        // Location
        $hydrogen->add_data('location', $xoops->locationId);

        //Alerts
        $hydrogen->add_data('alerts', \Xoops\Core\Helper\GuiAlerts::getInstance()->get());

        // Redirection messages
        if($_SESSION['redirect_messages']){
            $hydrogen->add_data('redirection', $_SESSION['redirect_messages']);
        }

        $hydrogen->render_data();
    }
}
