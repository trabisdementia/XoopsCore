<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

namespace Xoops\Core\Service\Contract;

/**
 * Admin widgets service interface
 *
 * Copyright © 2015 The XOOPS project http://sf.net/projects/xoops/
 * -----------------------------------------------------------------
 * @copyright    2015 The XOOPS project http://sf.net/projects/xoops/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package      Xoops\Core
 * @link         http://xoops.org
 * @since        2.6
 * @author       Eduardo Cortés <i.bitcero@gmail.com>
 * @version      1.0
 * @category     Xoops\Core\Service\Contract\AdminWidgetInterface
 */
interface AdminwidgetInterface
{
    const MODE = \Xoops\Core\Service\Manager::MODE_MULTIPLE;

    /**
     * Loads and return a widget identified by ID and sets internal id to $name
     *
     * @param $response
     * @param $id
     * @param $name
     *
     * @return mixed
     */
    public function loadWidget($response, $id);

    /**
     * Get the list (as array) af all provided widgets
     * @param $response
     *
     * @return mixed
     */
    public function widgetsList($response);
}