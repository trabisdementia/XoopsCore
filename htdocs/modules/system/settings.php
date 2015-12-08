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

function setNamesAsKeys($options){

    $return = [];

    foreach($options as $option){
        $return[$option['name']] = $option;
    }

    return $return;

}

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

        // If module does not have config options then redirect to home
        if(empty($module->getInfo('config'))){
            $xoops->redirect([
                'url' => $xoops->url('admin.php'),
                'message' => __('This module does not have any configuration option'),
                'type' => 'warning'
            ]);
        }

        // Define Breadcrumb and tips
        $admin_page = new \Xoops\Module\Admin();
        //$admin_page->addBreadcrumbLink(SystemLocale::CONTROL_PANEL, \XoopsBaseConfig::get('url') . '/admin.php', true);
        $admin_page->addBreadcrumbLink(
            $module->getVar('name'),
            $xoops->url('modules/' . $module->getVar('dirname') . '/' . $module->getInfo('adminmenu'))
        );
        $admin_page->addBreadcrumbLink(
            __('Settings', 'system')
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
            $module->getInfo('icon')
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
            $xoops->redirect([
                'url' => 'settings.php',
                'type' => 'warning',
                'message' => __('No module has been specified!', 'system')
            ]);
        }

        // Load module
        $module = $xoops->getModuleByDirname($dirname);

        if(!$module){
            $xoops->redirect([
                'url' => 'settings.php',
                'type' => 'danger',
                'message' => __('No module specified!', 'system')
            ]);
        }

        $fileConfigs = setNamesAsKeys($module->getInfo('config'));
        $dbConfigs = $xoops->getModuleConfigs($dirname);
        $config_handler = $xoops->getHandlerConfig();
        $allConfigs =  $config_handler->getConfigs(new Criteria('conf_modid', $module->getVar('mid')));

        // New configs to be inserted
        $newConfigs = [];

        foreach( $allConfigs as $option ){

            // Get the name of config item
            $name = $option->getVar('conf_name');
            $key = array_search($name, array_keys($fileConfigs), true);

            // retrieve the value to save
            $value = isset($_POST[$name]) ? $_POST[$name] : null;

            if(!array_key_exists($name, $fileConfigs)){
                $config_handler->deleteConfig($option);
                continue;
            }

            if(
                $value == $option->getVar('conf_value') &&
                $fileConfigs[$name]['formtype'] == $option->getVar('conf_formtype') &&
                $fileConfigs[$name]['valuetype'] == $option->getVar('conf_valuetype')
            ){
                if(false !== $key){
                    array_splice($fileConfigs, $key, 1);
                }

                continue;
            }

            $fConfig = $fileConfigs[$name];
            $option->setVar('conf_valuetype', $fConfig['valuetype']);
            $option->setVar('conf_formtype', $fConfig['formtype']);

            // if default theme has been changed
            if ($name === 'theme_set' && $module->getVar('dirname') === 'system' && $value !== $option->getVar('conf_value')
            ) {
                $member_handler = $xoops->getHandlerMember();
                $member_handler->updateUsersByField('theme', $value);
            }

            // add read permission for the start module to all groups
            if ($name === 'startpage' && $module->getVar('dirname') === 'system' && $value != '--'
            ) {
                $member_handler = $xoops->getHandlerMember();
                $groups = $member_handler->getGroupList();
                $moduleperm_handler = $xoops->getHandlerGroupPermission();
                $module_handler = $xoops->getHandlerModule();
                $module = $xoops->getModuleByDirname($value);
                foreach ($groups as $groupid => $groupname) {
                    if (!$moduleperm_handler->checkRight('module_read', $module->getVar('mid'), $groupid)) {
                        $moduleperm_handler->addRight('module_read', $module->getVar('mid'), $groupid);
                    }
                }
            }

            $option->setConfValueForInput($value);
            $config_handler->insertConfig($option);

            // reduce file configs
            if(false !== $key){
                array_splice($fileConfigs, $key, 1);
            }

        }

        // Clean cached files, may take long time
        // User register_shutdown_function to keep running after connection closes
        // so that cleaning cached files can be finished
        // Cache management should be performed on a separate page
        $options = array(1, 2, 3); //1 goes for smarty cache, 3 goes for xoops_cache
        register_shutdown_function(array(&$system, 'cleanCache'), $options);
        $xoops->preload()->triggerEvent('system.preferences.save');
        if (!isset($redirect) && $redirect == '') {
            $redirect = $xoops->url('admin.php');
        }

        $xoops->redirect([
            'url' => $redirect,
            'type' => 'success',
            'icon' => 'xicon-check-bold',
            'message' => XoopsLocale::S_DATABASE_UPDATED
        ]);

        break;
}

