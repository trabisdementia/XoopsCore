<?php
/**
 * Icons for XOOPS
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

if (! function_exists('smarty_function_xoicon')) {
    function smarty_function_xoicon($params, Smarty_Internal_Template $tpl)
    {
        if (!array_key_exists('icon', $params)) {
            return null;
        }
        $icon = $params['icon'];
        if ('' == $icon) {
            return null;
        }
        if (array_key_exists('module', $params)) {
            $module = $params['module'];
        } else {
            $module = '';
        }
        if (isset($params['class'])) {
            $class = $params['class'];
        } else {
            $class = '';
        }
        $xoops = \Xoops::getInstance();
        $icon = $xoops->getIcon($icon, $module);
        if(substr($icon, 0, 4)){
            $icon = sprintf('<span class="xo-icon-svg ' . $class . '">%s</span>', $icon);
        } elseif (false !== strpos($icon, '/')) {
            $alt = isset($params['alt']) ? $params['alt'] : '';
            $icon = sprintf('<img src="%s"' . ('' != $alt ? ' alt="' . $alt . '"' : '') . '>');
        } else {
            $icon = sprintf('<span class="xo-icon-svg ' . $class . '"><span class="%s"></span></span>', $icon);
        }
        return $icon;
    }
}