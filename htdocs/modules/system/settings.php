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


}

