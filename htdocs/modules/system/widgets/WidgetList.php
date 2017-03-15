<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use \Xoops\Core\Helper\AbstractWidget;

/**
 * Widget that shows a cool formated list
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
class WidgetList extends AbstractWidget
{
    /**
     * List items container
     *
     * @var array
     */
    private $items = array();
    /**
     * Tools container
     *
     * @var array
     */
    private $tools = array();

    /**
     * Add a new item to list.
     *
     * @param array $item Must contain a key for each column of the list
     */
    public function addItem($item){
        if (is_array($item) || empty($item)){
            $this->items[] = $item;
        }
    }

    public function getItems(){
        return $this->items;
    }

    /**
     * Add a new tool to list heading
     *
     * @param $tool
     */
    public function addTool($tool){
        if(!is_array($tool) || empty($tool)){
            return false;
        }

        // Check if tool have a title and content
        if (! isset($tool['content'])){
            return false;
        }

        $transit = array();
        $transit['title']       = $tool['title'];
        $transit['content']     = $tool['content'];
        if (isset($tool['link'])){
            $transit['link'] = '' != $tool['link'] ? $tool['link'] : '#';
        } else {
            $transit['link'] = '#';
        }
        if (isset($tool['id'])){
            $transit['id'] = '' != $tool['id'] ? $tool['id'] : 'tool-' . count($this->tools);
        } else {
            $transit['id'] = 'tool-' . count($this->tools);
        }
        if (isset($tool['type'])){
            $transit['type'] = 'button' == $tool['type'] ? $tool['type'] : '';
        } else {
            $transit['type'] = '';
        }
        if (isset($tool['class'])){
            $transit['class'] = '' != $tool['class'] ? $tool['class'] : '';
        } else {
            $transit['class'] = '';
        }
        $this->tools[] = $transit;
    }

    public function getTools(){
        return $this->tools;
    }

    /**
     * Render HTML
     *
     * @return mixed|string
     * @throws Exception
     * @throws SmartyException
     */
    public function render()
    {
        $xoops = \Xoops::getInstance();
        $xoops->tpl()->assign('widget', array(
            'id'            => $this->id,
            'link'          => $this->link,
            'collapse'      => $this->collapse,
            'tools'         => $this->tools,
            'items'         => $this->items,
            'type'          => $this->type,
            'class'         => $this->class,
            'title'         => $this->title
        ));
        return $xoops->tpl()->fetch('widget:system/widget-list.tpl');
    }
}