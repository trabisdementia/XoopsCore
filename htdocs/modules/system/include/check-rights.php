<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xoops\Core\Kernel\Criteria;
use Xoops\Core\FixedGroups;

/**
 * System admin
 *
 * @copyright   XOOPS Project (http://xoops.org)
 * @license     GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author      Kazumi Ono (AKA onokazu)
 * @package     system
 * @version     $Id$
 */

// Include header
include dirname(__DIR__) . '/header.php';

// Get main instance
$xoops = Xoops::getInstance();
$system = System::getInstance();
$system_breadcrumb = SystemBreadcrumb::getInstance();

$error = false;
if ($system->checkRight()) {
    if (isset($fct) && $fct != '') {
        $fct = preg_replace("/[^a-z0-9_\-]/i", "", $fct);
        if (XoopsLoad::fileExists($file = $xoops->path('modules/' . $xoopsModule->getVar('dirname', 'n') . '/admin/' . $fct . '/xoops_version.php'))) {
            // Load language file
            //system_loadLanguage($fct, $xoopsModule->getVar('dirname', 'n'));
            // Include Configuration file
            require $file;
            unset($file);

            // Get System permission handler
            $sysperm_handler = $xoops->getHandlerGroupperm();

            $category = !empty($modversion['category']) ? (int)($modversion['category']) : 0;
            unset($modversion);

            if ($category > 0) {
                $group = $xoopsUser->getGroups();
                if (in_array(FixedGroups::ADMIN, $group) || false != $sysperm_handler->checkRight('system_admin', $category, $group, $xoopsModule->getVar('mid'))) {
                    if (XoopsLoad::fileExists($file = $xoops->path('modules/' . $xoopsModule->getVar('dirname', 'n') . '/admin/' . $fct . '/main.php'))) {
                        include_once $file;
                        unset($file);
                    } else {
                        $error = true;
                    }
                } else {
                    $error = true;
                }
            } elseif ($fct == 'version') {
                if (XoopsLoad::fileExists($file = $xoops->path('modules/' . $xoopsModule->getVar('dirname', 'n') . '/admin/version/main.php'))) {
                    include_once $file;
                    unset($file);
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}