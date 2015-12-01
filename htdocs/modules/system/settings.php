<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

require 'include/check-rights.php';

use \Xoops\Core\Helper\HeaderCommands;
use \Xoops\Core\Request;

/**
 * Settings Manager
 *
 * @copyright   XOOPS Project (http://xoops.org)
 * @license     GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author      Kazumi Ono (AKA onokazu)
 * @author      Eduardo Cortes (AKA bitcero)
 * @package     system
 * @version     $Id$
 */

$op = $system->cleanVars($_REQUEST, 'op', 'showmod', 'string');

switch ($op) {

    case 'showmod':
        
        $mod = $system->cleanVars($_GET, 'mod', '', 'string');

        if ('' == $mod) {
            $mod = $system->cleanVars($_GET, 'mod', 1, 'int');
            if (!$mod) {
                $xoops->redirect('settings.php', 1);
            }
        }

        // Load the module
        if (is_numeric($mod)) {

            $module = $xoops->getModuleById($mod);
            $xoops->loadLanguage('modinfo', $module->getVar('dirname'));

        } else {

            $module = $xoops->getModuleByDirname($mod);

        }

        if(!$module){
            $xoops->redirect('settings.php', 0, __('Module not found!', 'system'));
        }

        // Define Breadcrumb and tips
        $admin_page = new \Xoops\Module\Admin();
        //$admin_page->addBreadcrumbLink(SystemLocale::CONTROL_PANEL, \XoopsBaseConfig::get('url') . '/admin.php', true);
        $admin_page->addBreadcrumbLink(
            __('Settings', 'system'), 'settings.php'
        );
        $admin_page->addBreadcrumbLink(
            $module->getVar('name')
        );

        $xoops->header('admin:system/system-preferences.tpl');

        $form = $xoops->getModuleForm(null, 'preferences');
        $xoops->tpl()->assign('settingsCategories', $form->getForm($module));
        $xoops->tpl()->assign('form', $form);
        $xoops->tpl()->assign('token', $xoops->security()->getTokenHTML());
        $xoops->tpl()->assign('dirname', $module->getVar('dirname'));

        $xoops->theme()->addStylesheet('modules/system/css/admin.min.css');

        // Language
        $xoops->tpl()->assign('systemLang', [
            'submit' => __('Save Settings', 'system'),
            'cancel' => __('Cancel', 'system')
        ]);

        // Module header
        $admin_page->renderModuleHeader(
            sprintf(__('%s Settings', 'system'), $module->getVar('name')),
            __('Configure settings options for this module', 'system'),
            'xicon-settings'
        );

        $xoops->footer();

        break;

    case 'save':

        if (!$xoops->security()->check()) {
            $xoops->redirect([
                'url' => "settings.php",
                'type' => 'danger',
                'message' => implode('<br />', $xoops->security()->getErrors())
            ]);
        }

        $dirname = Request::getString('dirname', null, 'POST');

        if('' == $dirname){
            $xoops->redirect('settings.php', 3, __('No module has been specified!', 'system'));
        }

        if ('' == $mod) {
            $mod = $system->cleanVars($_GET, 'mod', 1, 'int');
            if (!$mod) {
                $xoops->redirect('settings.php', 1);
            }
        }

        // Load the module
        if (is_numeric($mod)) {

            $module = $xoops->getModuleById($mod);
            $xoops->loadLanguage('modinfo', $module->getVar('dirname'));

        } else {

            $module = $xoops->getModuleByDirname($mod);

        }

        $xoopsTpl = new XoopsTpl();
        $count = count($conf_ids);
        $tpl_updated = false;
        $theme_updated = false;
        $startmod_updated = false;
        $lang_updated = false;
        $config_handler = $xoops->getHandlerConfig();
        if ($count > 0) {
            for ($i = 0; $i < $count; ++$i) {
                $config = $config_handler->getConfig($conf_ids[$i]);
                $new_value = isset(${$config->getVar('conf_name')}) ? ${$config->getVar('conf_name')} : null;
                if (!is_null($new_value) && (is_array($new_value) || $new_value != $config->getVar('conf_value'))) {
                    // if language has been changed
                    if (!$lang_updated && $config->getVar('conf_catid') == XOOPS_CONF
                        && $config->getVar('conf_name') === 'locale'
                    ) {
                        $xoops->setConfig('locale', ${$config->getVar('conf_name')});
                        $lang_updated = true;
                    }

                    // if default theme has been changed
                    if (!$theme_updated && $config->getVar('conf_catid') == XOOPS_CONF
                        && $config->getVar('conf_name') === 'theme_set'
                    ) {
                        $member_handler = $xoops->getHandlerMember();
                        $member_handler->updateUsersByField('theme', ${$config->getVar('conf_name')});
                        $theme_updated = true;
                    }

                    // add read permission for the start module to all groups
                    if (!$startmod_updated && $new_value != '--'
                        && $config->getVar('conf_catid') == XOOPS_CONF
                        && $config->getVar('conf_name') === 'startpage'
                    ) {
                        $member_handler = $xoops->getHandlerMember();
                        $groups = $member_handler->getGroupList();
                        $moduleperm_handler = $xoops->getHandlerGroupPermission();
                        $module_handler = $xoops->getHandlerModule();
                        $module = $xoops->getModuleByDirname($new_value);
                        foreach ($groups as $groupid => $groupname) {
                            if (!$moduleperm_handler->checkRight('module_read', $module->getVar('mid'), $groupid)) {
                                $moduleperm_handler->addRight('module_read', $module->getVar('mid'), $groupid);
                            }
                        }
                        $startmod_updated = true;
                    }

                    $config->setConfValueForInput($new_value);
                    $config_handler->insertConfig($config);
                }
                unset($new_value);
            }
        }

        // Clean cached files, may take long time
        // User register_shutdown_function to keep running after connection closes
        // so that cleaning cached files can be finished
        // Cache management should be performed on a separate page
        $options = array(1, 2, 3); //1 goes for smarty cache, 3 goes for xoops_cache
        register_shutdown_function(array(&$system, 'cleanCache'), $options);
        $xoops->preload()->triggerEvent('system.preferences.save');
        if (isset($redirect) && $redirect != '') {
            $xoops->redirect($redirect, 2, XoopsLocale::S_DATABASE_UPDATED);
        } else {
            $xoops->redirect("admin.php?fct=preferences", 2, XoopsLocale::S_DATABASE_UPDATED);
        }

        break;
}

