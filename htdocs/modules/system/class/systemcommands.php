<?php
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/**
 * Module System Commands
 *
 * Copyright © 2015 The XOOPS project http://xoops.org
 * -----------------------------------------------------------------
 * @copyright    The XOOPS project http://xoops.org
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package      system
 * @since        2.6
 * @author       Eduardo Cortés (AKA bitcero)    <i.bitcero@gmail.com>
 */

class SystemHeaderCommands
{

    static public function logoMode($mode){
        return self::viewCommands($mode, 'logo');
    }

    static public function viewMode($mode){
        return self::viewCommands($mode, 'view');
    }

    static public function viewCommands($mode, $type)
    {
        $xoops = \Xoops::getInstance();
        $xoops->tpl()->assign('view_' . $type, $mode);
        $xoops->tpl()->assign('command', $type . '-mode');
        return $xoops->tpl()->fetch("admin:system/system-header-commands.tpl");
    }
}