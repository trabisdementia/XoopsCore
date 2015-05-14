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
 * Widgets container for admin widgets
 *
 * Copyright © 2015 The XOOPS project http://sf.net/projects/xoops/
 * -----------------------------------------------------------------
 * @copyright    2015 The XOOPS project http://sf.net/projects/xoops/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package      Smarty
 * @link         http://xoops.org
 * @since        2.6
 * @author       Eduardo Cortés <i.bitcero@gmail.com>
 */
class WidgetsContainer
{
    private $widgets = array();

    /**
     * Magic method to store a new widget
     *
     * @param string $id Widget identifier
     * @param $widget    Widget object
     */
    public function __set($id, $widget)
    {
        if (is_a($widget, '\Xoops\Core\Helper\AbstractWidget')){
            $this->widgets[$id] = $widget;
        }
    }

    /**
     * Gets a single widget from store
     *
     * @param string $id Widget identifier
     *
     * @return bool
     */
    public function __get($id)
    {
        if (array_key_exists($id, $this->widgets)){
            return $this->widgets[$id];
        } else {
            return false;
        }
    }
    /**
     * Access the only instance of this class
     */
    static function getInstance()
    {
        static $instance;

        if (!isset($instance)) {
            $instance = new HydrogenHelper();
        }
        return $instance;
    }
}