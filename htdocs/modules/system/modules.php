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
 * Modules Manager
 *
 * @copyright   XOOPS Project (http://xoops.org)
 * @license     GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author      Kazumi Ono (AKA onokazu)
 * @package     system
 * @version     $Id$
 */

require 'include/check-rights.php';

use \Xoops\Core\Helper\HeaderCommands;
use \Xoops\Core\Request;

// Check users rights
if (!$xoops->isUser() || !$xoops->isModule() || !$xoops->user->isAdmin($xoops->module->mid())) {
    exit(XoopsLocale::E_NO_ACCESS_PERMISSION);
}

//if (isset($_POST)) {
//    foreach ($_POST as $k => $v) {
//        ${$k} = $v;
//    }
//}

// Get Action type
$op = $system->cleanVars($_REQUEST, 'op', 'list', 'string');
$module = $system->cleanVars($_REQUEST, 'module', '', 'string');

if (in_array($op, array('install', 'update', 'uninstall'))) {
    if (!$xoops->security()->check()) {
        $ax = new \Xoops\Core\Helper\AjaxResponse();
        $ax->response(array(
            'type' => 'error',
            'message' => __('Session token invalid!', 'system'),
            'reload' => 1
        ));
    }
}
$myts = MyTextsanitizer::getInstance();

// Location
$xoops->locationId = 'system-modules';
$ax = new \Xoops\Core\Helper\AjaxResponse();

switch ($op) {

    case 'list':
        // Call Header
        $xoops->header('admin:system/system-modules.tpl');
        // Define Stylesheet
        $xoops->theme()->addStylesheet('modules/system/css/admin.min.css');
        // Define scripts
        $xoops->theme()->addScript('media/jquery/plugins/jquery.jeditable.js');
        $xoops->theme()->addScript('modules/system/js/admin.js');
        $xoops->theme()->addScript('modules/system/js/module.min.js');

        // Modules language
        $xoops->tpl()->assign('systemLang', array(
            'installed' => __('Installed', 'system'),
            'available' => __('Available', 'system'),
            'download' => __('Download Modules', 'system'),
            'authors' => __('Author(s): %s', 'system'),
            'author_aka' => __('%s (aka %s)', 'system'),
            'version' => 'Version: %s',
            'view_list' => 'View as list',
            'view_cards' => 'View as cards',
            'module' => 'Module',
        ));

        // Define Breadcrumb and tips
        $admin_page = new \Xoops\Module\Admin();
        //$admin_page->addBreadcrumbLink(SystemLocale::CONTROL_PANEL, \XoopsBaseConfig::get('url') . '/admin.php', true);
        $admin_page->addBreadcrumbLink(
            SystemLocale::MODULES_ADMINISTRATION
        );

        $admin_page->addTips(SystemLocale::MODULES_TIPS);
        $admin_page->renderBreadcrumb();
        $admin_page->renderTips();

        // Header Commands
        $view = $system->cleanVars($_COOKIE, 'xoopsModsView', 'list', 'string');
        $view_icons = $system->cleanVars($_COOKIE, 'xoopsModsIcons', 'images', 'string');
        $commands = HeaderCommands::getInstance();
        $commands->addCommand('mods-display', SystemHeaderCommands::viewMode($view));
        $commands->addCommand('icons-display', SystemHeaderCommands::logoMode($view_icons));
        $xoops->events()->triggerEvent('system.header.commands', $commands, $xoops->locationId);

        // Module header
        $admin_page->renderModuleHeader(
            __('Modules Manager', 'system'),
            __('Install, uninstall, download and manage modules', 'system'),
            'xicon-module'
        );

        // Modules buttons
        $admin_page->addItemButton(
            __('Installed', 'system'),
            '#installed',
            'xicon-module',
            array(
                'data-toggle' => 'modules'
            ),
            'btn-default btn-primary'
        );

        $admin_page->addItemButton(
            __('Available', 'system'),
            '#available',
            'xicon-check',
            array(
                'data-toggle' => 'modules'
            )
        );

        $admin_page->addItemButton(
            __('Download', 'system'),
            '#download',
            'xicon-download',
            array(
                'data-toggle' => 'modules'
            ),
            'btn-default btn-orange'
        );
        $admin_page->renderButton('center');

        $system_module = new SystemModule();

        $list = $system_module->getModuleList();
        $install = $system_module->getInstalledModules();

        $xoops->tpl()->assign('xoops', $xoops);
        $xoops->tpl()->assign('modules_list', $list);
        $xoops->tpl()->assign('modules_available', $install);
        $xoops->tpl()->assign('view_mode', $view);
        $xoops->tpl()->assign('logo_mode', $view_icons);

        // Call Footer
        $xoops->footer();
        break;

    case 'available-modules':
    case 'installed-modules':

        $xoops->theme();
        $system_module = new SystemModule();
        $install = $op == 'installed-modules' ? $system_module->getModuleList() : $system_module->getInstalledModules();

        $xoops->tpl()->assign('modules_list', $install);
        $xoops->tpl()->assign('xoops', $xoops);

        $view = $system->cleanVars($_COOKIE, 'xoopsModsView', 'list', 'string');
        $view_icons = $system->cleanVars($_COOKIE, 'xoopsModsIcons', 'images', 'string');
        $xoops->tpl()->assign('logo_mode', $view_icons);

        if ('installed-modules' == $op) {
            $tpl_modules = $view == 'list' ? "admin:system/system-modules-table.tpl" : "admin:system/system-modules-card.tpl";
        } else {
            $tpl_modules = $view == 'list' ? "admin:system/system-available-table.tpl" : "admin:system/system-available-card.tpl";
        }

        $xoops->tpl()->assign('systemLang', array(
            'module' => __('Module', 'system'),
            'version' => __('Version', 'system'),
            'updated' => __('Updated', 'system'),
            'author' => __('Author(s)', 'system'),
            'availableModules' => __('Available Modules', 'system'),
            'install' => __('Install Module', 'system'),
            'noAvailable' => __('There are not available modules to install', 'system'),
        ));

        $ax->response(array(
            'content' => $xoops->tpl()->fetch($tpl_modules)
        ));

        break;

    case 'change-view':

        $xoops = \Xoops::getInstance();
        $xoops->header();
        $system_module = new SystemModule();
        $mode = $system->cleanVars($_POST, 'mode', 'list', 'string');
        $logo_mode = $system->cleanVars($_POST, 'logo_mode', 'images', 'string');
        $tab = Request::getString('tab', 'installed', 'post');

        if('available' == $tab){
            $list = $system_module->getInstalledModules();
        } else {
            $list = $system_module->getModuleList();
        }

        setcookie('xoopsModsView', $mode, time() + (365 * 3600), '/', null, null, true);
        setcookie('xoopsModsIcons', $logo_mode, time() + (365 * 3600), '/', null, null, true);

        $xoops->tpl()->assign('modules_list', $list);
        $xoops->tpl()->assign('logo_mode', $logo_mode);

        $xoops->tpl()->assign('systemLang', array(
            'author_aka' => __('%s (AKA %s)', 'system'),
        ));



        if ('cards' == $mode) {

            if($tab == 'available'){
                $tpl_modules = "admin:system/system-available-card.tpl";
            } else{
                $tpl_modules = "admin:system/system-modules-card.tpl";
            }

        } else {

            if($tab == 'available'){
                $tpl_modules = "admin:system/system-available-table.tpl";
            } else{
                $tpl_modules = "admin:system/system-modules-table.tpl";
            }
        }

        $xoops->tpl()->assign('systemLang', array(
            'module' => __('Module', 'system'),
            'version' => __('Version', 'system'),
            'updated' => __('Updated', 'system'),
            'author' => __('Author(s)', 'system'),
            'availableModules' => __('Available Modules', 'system'),
            'install' => __('Install Module', 'system')
        ));

        $content = $xoops->tpl()->fetch($tpl_modules);

        $ax = new \Xoops\Core\Helper\AjaxResponse();
        $ax->response(array(
            'type' => 'success',
            'content' => $content,
            'mode' => $mode,
            'list'  => $tab
        ));
        break;

    case 'details':

        $mid = Request::getInt('mid', 0, 'get');

        if (0 >= $mid) {

            $mid = Request::getString('mid', '', 'get');

            if ($mid == '') {
                $ax->response(array(
                    'type' => 'error',
                    'message' => __('No module ID has been provided', 'system')
                ));
            }

        }

        $xoops = \Xoops::getInstance();
        $xoops->header();

        $module_handler = $xoops->getHandlerModule();
        $moduleperm_handler = $xoops->getHandlerGroupPermission();

        if (is_numeric($mid)) {
            $module = $module_handler->get($mid);
        } else {
            $xoops->loadLocale($mid);
            $module = new Xoops\Core\Kernel\Handlers\XoopsModule();
            $module->loadInfoAsVar($mid);
        }
        $xoops->tpl()->assign('module', $module);

        // Not installed
        if ($module->getVar('mid') <= 0) {
            $tpl_info = 'admin:system/admin-available-details.tpl';
        } else {
            $tpl_info = 'admin:system/admin-module-details.tpl';
        }

        $xoops->tpl()->assign('systemLang', array(
            'name' => __('Module name:', 'system'),
            'dirname' => __('Directory:', 'system'),
            'description' => __('Description:', 'system'),
            'version' => __('Version:', 'system'),
            'license' => __('License:', 'system'),
            'website' => __('Website', 'system'),
            'help' => __('Documentation', 'system'),
            'authors' => __('Author(s):', 'system'),
            'author_aka' => __('%s (AKA %s)', 'system'),
            'help' => __('Help', 'system'),
            'web' => __('Website', 'system'),
            'general' => __('General', 'system'),
            'dbtables' => __('DB Tables', 'system'),
            'blocks' => __('Blocks', 'system'),
            'options' => __('Options', 'system'),
            'blocksDescription' => __('Next are the blocks provided for module.', 'system'),
            'settingsDescription' => __('Next are the configuration options that this module will create if installed.', 'system'),
            'tablesDescription' => __('Next tables will be created if module is installed.', 'system'),
        ));

        $ax->response(array(
            'title' => sprintf(__('%s Details', 'system'), $module->getVar('name')),
            'content' => $xoops->tpl()->fetch($tpl_info),
            'close' => __('Close', 'system'),
            'installed' => $module->getVar('mid') > 0 ? 1 : 0
        ));
        break;

    case 'rename':
        $xoops->logger()->quiet();
        //$xoops->disableErrorReporting();

        $mid = $system->cleanVars($_POST, 'id', 0, 'int');
        $value = $system->cleanVars($_POST, 'value', '', 'string');
        if ($mid != 0) {
            $module_handler = $xoops->getHandlerModule();
            $module = $module_handler->getById($mid);
            $module->setVar('name', $value);
            if ($module_handler->insertModule($module)) {
                echo $value;

            }
        }
        break;

    case 'order':
        // Get Module Handler
        $module_handler = $xoops->getHandlerModule();
        if (isset($_POST['mod'])) {
            $i = 1;
            foreach ($_POST['mod'] as $order) {
                if ($order > 0) {
                    $module = $module_handler->getById($order);
                    //Change order only for visible modules
                    if ($module->getVar('weight') != 0) {
                        $module->setVar('weight', $i);
                        if (!$module_handler->insertModule($module)) {
                            $error = true;
                        }
                        ++$i;
                    }
                }
            }
        }
        exit;
        break;

    case 'active':
        $xoops->logger()->quiet();
        //$xoops->disableErrorReporting();
        // Get module handler
        $module_handler = $xoops->getHandlerModule();
        $block_handler = $xoops->getHandlerBlock();
        $module_id = $system->cleanVars($_POST, 'mid', 0, 'int');
        if ($module_id > 0) {
            $module = $module_handler->getById($module_id);
            $old = $module->getVar('isactive');
            // Set value
            $module->setVar('isactive', !$old);
            if (!$module_handler->insertModule($module)) {
                $error = true;
            }
            $blocks = $block_handler->getByModule($module_id);
            /* @var $block XoopsBlock */
            foreach ($blocks as $block) {
                $block->setVar('isactive', !$old);
                $block_handler->insertBlock($block);
            }
            //Set active modules in cache folder
            $xoops->setActiveModules();

            // Send confirmation
            $ax->response(array(

                'type' => 'success',
                'message' => $module->getVar('isactive') ? sprintf(__('Module %s activated successfully!', 'system'), $module->getVar('name')) :
                    sprintf(__('Module %s deactivated successfully!', 'system'), $module->getVar('name')),
                'active' => $module->getVar('isactive'),
                'mid' => $module->getVar('mid')

            ));


        } else {

            $ax->response(array(
                'type' => 'error',
                'message' => __('No module ID has been provided!', 'system')
            ));

        }
        break;

    case 'display_in_menu':
        $xoops->logger()->quiet();
        //$xoops->disableErrorReporting();
        // Get module handler
        $module_handler = $xoops->getHandlerModule();
        $module_id = $system->cleanVars($_POST, 'mid', 0, 'int');
        if ($module_id > 0) {
            $module = $module_handler->getById($module_id);
            $old = $module->getVar('weight');
            // Set value
            $module->setVar('weight', !$old);
            if (!$module_handler->insertModule($module)) {
                $error = true;
            } else {
                echo !$old;
            }
        }
        break;

    case 'install':

        $xoops->theme();

        $module = $system->cleanVars($_POST, 'dirname', '', 'string');

        $ret = array();
        $system_module = new SystemModule();
        $ret = $system_module->install($module);
        if ($ret) {
            $xoops->tpl()->assign('install', 1);
            $xoops->tpl()->assign('module', $ret);
            $xoops->tpl()->assign('from_title', SystemLocale::MODULES_ADMINISTRATION);
            $xoops->tpl()->assign('from_link', $system->adminVersion('modulesadmin', 'adminpath'));
            $xoops->tpl()->assign('title', XoopsLocale::A_INSTALL);
            $xoops->tpl()->assign('log', $system_module->trace);
        } else {
            $ax->response(array(
                'type'      => 'error',
                'title'     => __('Error on installation', 'system'),
                'message'   => implode('<br>', $system_module->error)
            ));
        }
        $folder = array(1, 2, 3);
        $system->cleanCache($folder);
        //Set active modules in cache folder
        $xoops->setActiveModules();
        // Call Footer

        $xoops->tpl()->assign('systemLang', array(
            'module' => __('Module', 'system'),
            'log' => __('Log', 'system'),
            'blocks' => __('Blocks', 'system'),
            'settings' => __('Preferences', 'system'),
            'dashboard' => __('Dashboard', 'system')
        ));

        $ax->response(array(
            'title' => __('Installation Log', 'system'),
            'content' => $xoops->tpl()->fetch('admin:system/admin-module-logger.tpl'),
            'close' => __('Close', 'system'),
            'dirname' => $module
        ));

        break;

    case 'uninstall':
        $mid = $system->cleanVars($_POST, 'mid', 0, 'int');
        $module_handler = $xoops->getHandlerModule();
        $module = $module_handler->getById($mid);

        // Define Stylesheet
        $xoops->theme();

        $ret = array();
        $system_module = new SystemModule();
        $ret = $system_module->uninstall($module->getVar('dirname'));
        $xoops->tpl()->assign('module', $ret);
        if ($ret) {
            $xoops->tpl()->assign('from_title', SystemLocale::MODULES_ADMINISTRATION);
            $xoops->tpl()->assign('from_link', $system->adminVersion('modulesadmin', 'adminpath'));
            $xoops->tpl()->assign('title', XoopsLocale::A_UNINSTALL);
            $xoops->tpl()->assign('log', $system_module->trace);
            $xoops->tpl()->assign('systemLang', array(
                'module' => __('Module', 'system'),
                'log' => __('Log', 'system'),
                'blocks' => __('Blocks', 'system'),
                'settings' => __('Preferences', 'system'),
                'dashboard' => __('Dashboard', 'system')
            ));
        }
        $folder = array(1, 2, 3);
        $system->cleanCache($folder);
        //Set active modules in cache folder
        $xoops->setActiveModules();

        $ax->response(array(
            'title' => sprintf(__('%s Uninstall Log', 'system'), $module->getVar('name')),
            'content' => $xoops->tpl()->fetch('admin:system/admin-module-logger.tpl'),
            'close' => __('Close', 'system'),
            'mid' => $module->getVar('mid')
        ));

        break;

    case 'update':

        $ax = new \Xoops\Core\Helper\AjaxResponse();

        $mid = $system->cleanVars($_POST, 'mid', 0, 'int');
        $module_handler = $xoops->getHandlerModule();
        $block_handler = $xoops->getHandlerBlock();
        $module = $module_handler->getById($mid);

        $xoops->theme();
        $ret = array();
        $system_module = new SystemModule();
        $ret = $system_module->update($module->getVar('dirname'));
        $xoops->tpl()->assign('module', $ret);
        if ($ret) {
            $xoops->tpl()->assign('install', 1);
            $xoops->tpl()->assign('from_title', __('Modules', 'system'));
            $xoops->tpl()->assign('from_link', 'modules.php');
            $xoops->tpl()->assign('title', XoopsLocale::A_UPDATE);
            $xoops->tpl()->assign('log', $system_module->trace);
            $xoops->tpl()->assign('systemLang', array(
                'module' => __('Module', 'system'),
                'log' => __('Log', 'system'),
                'blocks' => __('Blocks', 'system'),
                'settings' => __('Preferences', 'system'),
                'dashboard' => __('Dashboard', 'system')
            ));
        }
        $folder = array(1, 2, 3);
        $system->cleanCache($folder);
        //Set active modules in cache folder
        $xoops->setActiveModules();
        // Call Footer

        $ax->response(array(
            'title' => sprintf(__('%s Update Report', 'system'), $module->getVar('name')),
            'content' => $xoops->tpl()->fetch('admin:system/admin-module-logger.tpl'),
            'close' => __('Close', 'system'),
            'updated' => XoopsLocale::formatTimestamp($module->getVar('last_update'), 's'),
            'version' => round($module->getInfo('version'), 2),
            'mid' => $module->getVar('mid')
        ));

        break;
}
