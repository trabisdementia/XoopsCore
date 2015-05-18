<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

namespace Xoops\Core\Helper;

/**
 * Toolbar controller for GUI
 *
 * Copyright © 2015 The XOOPS project http://sf.net/projects/xoops/
 * -----------------------------------------------------------------
 * @copyright    2015 The XOOPS project http://sf.net/projects/xoops/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package      CoreHelpers
 * @link         http://xoops.org
 * @since        2.6
 * @author       Eduardo Cortés <i.bitcero@gmail.com>
 */
class Toolbar
{
    /**
     * Tools container
     * @var array
     */
    protected $tools = array();

    /**
     * Add a new button (tool) to toolbar.
     *
     * Example:
     * <pre>
     * $toolbar = \Xoops\Core\Helper\Toolbar::getInstance();
     * $toolbar->addTool(
     *      'My button',
     *      array(
     *          'href'        => '#' //default #
     *          'id'          => 'my-button',
     *          'data-action' => 'anything',
     *          ...
     *      )
     * );
     * </pre>
     *
     * The paramter <code>$attr</code> can contain any HTMl attribute
     * to be passed to toolbar button.
     *
     * @param       $caption
     * @param array $attr
     */
    public function addTool($caption, $icon, $attr = array())
    {
        if ('' != $caption){
            $this->tools[] = array(
                'caption'       => $caption,
                'icon'          => $icon,
                'attributes'    => $attr
            );
        }
    }

    public function render()
    {
        $rendered_tools = array();
        foreach ($this->tools as $tool){
            if(! isset($tool['href'])){
                $tool['href'] = '#';
            }
            $rendered_tools[] = array(
                'caption'       => $tool['caption'],
                'icon'          => $tool['icon'],
                'attributes'    => $this->renderAttributes($tool['attributes'])
            );
        }
        $xoops = \Xoops::getInstance();
        $xoops->tpl()->assign('xo_toolbar_tools', $rendered_tools);
        return $xoops->tpl()->fetch("admin:system/admin_toolbar.tpl");
    }

    private function renderAttributes($attr)
    {
        if (empty($attr)){
            return '';
        }

        $ret = '';
        foreach($attr as $name => $value){
            $ret .= $name . '="' . $value . '" ';
        }
        return $ret;
    }

    /**
     * Access the only instance of this class
     */
    static function getInstance()
    {
        static $instance;

        if (!isset($instance)) {
            $instance = new Toolbar();
        }
        return $instance;
    }
}
