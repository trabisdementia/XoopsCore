<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

namespace Xoops\Core\Helper;

/**
 * Abstract class for admin widgets
 *
 * Copyright © 2015 The XOOPS project http://sf.net/projects/xoops/
 * -----------------------------------------------------------------
 * @copyright    2015 The XOOPS project http://sf.net/projects/xoops/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package      system
 * @link         http://xoops.org
 * @since        2.6
 * @author       Eduardo Cortés <i.bitcero@gmail.com>
 * @category     AdminWidgets
 */
abstract class AbstractWidget
{
    /**
     * Name to use as ID in HTML code
     * @var string
     */
    protected $id = '';

    /**
     * All properties for widget
     * @var array
     */
    protected $properties = array();

    /**
     * @param string $id HTML identifier
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Magic method to set widget properties
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }

    /**
     * Magic method to get widget properties
     *
     * @param $name
     *
     * @return bool
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->properties)){
            return $this->properties[$name];
        } else {
            return false;
        }
    }

    /**
     * Transport the widget content to Smarty.
     * Widgets are stored in var <code>$widgets</code>, then you can get
     * the widget with the next smarty code:
     *
     * <pre>
     * <{xowidget id="widget_id" param1="parameter value" param2="..."}>
     * </pre>
     */
    public function transport(){
        \WidgetsContainer::getInstance()->{$this->id} = $this;
    }

    /**
     * Render widget content
     * @return mixed
     */
    abstract public function render();
}
