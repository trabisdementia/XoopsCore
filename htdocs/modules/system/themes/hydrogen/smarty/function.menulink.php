<?php
/**
 * Menu links Hydrogen Smarty plugin
 * Part of Hydrogen Theme for Xoops GUI
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
 * @package       hydrogen
 * @subpackage    Smarty
 * @since         2.6
 * @author        Eduardo Cortés (AKA bitcero)    <i.bitcero@gmail.com>
 * @version       1
 */

function smarty_function_menulink($params, Smarty_Internal_Template $tpl){
    if (! array_key_exists('menu', $params)){
        return null;
    }
    $menu = $params['menu'];
    if (! is_array($menu)){
        return null;
    }
    // Get module param
    if (! array_key_exists('module', $params)){
        $module = '';
    } else {
        $module = $params['module'];
    }
    // Check if is a relative URL
    if ( preg_match( "/^[http:\/\/|https:\/\/|ftp:\/\/|\/\/|\/]/", $menu['link'] ) ){
        // Absolute URL
        return $menu['link'];
    } else {
        $xoops = \Xoops::getInstance();
        $module_url = $xoops->url('modules/' . $module . '/');
        return $module_url . $menu['link'];
    }

}