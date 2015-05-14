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
 * Widget that shows a counter
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
class WidgetCounter extends AbstractWidget
{
    /**
     * Support for counter columns
     * @var array
     */
    private $columns = array();

    public function &addColumn($id){
        if ('' == $id){
            return false;
        }

        $this->columns[$id] = (object) array();
        return $this->columns[$id];
    }

    public function &column($id){
        if ('' == $id){
            return false;
        }
        if (! array_key_exists($id, $this->columns)){
            return false;
        }
        return $this->columns[$id];
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
        $prop = array();
        /**
         * Layout style for Widget.
         * Accepted values:
         *  'vertical'
         *  'horizontal'
         */
        $prop['orientation']    = '' != $this->orientation ? $this->orientation : 'horizontal';

        $prop['layout']         = 'solid' == $this->layout ? $this->layout : 'split';

        /**
         * Background color for widget. This value must be a CSS class name:
         * Available:
         *  bg-azure, bg-sky, bg-pink, bg-orange, bg-yellow, bg-palgreen, bg-primary
         *  bg-success, bg-info, bg-danger, bg-warning
         */
        $prop['bgcolor']        = $this->bgcolor;

        /**
         * Size for widget. Can be: 'small', 'normal', 'large' or 'xlarge'
         */
        $prop['size']           = '' != $this->size ? $this->size : 'normal';
        if (! in_array($prop['size'], array('small','normal', 'large', 'xlarge'))){
            $prop['size'] = 'normal';
        }

        // Format counter
        if (empty($this->columns)){
            if (is_numeric($this->counter)){
                if(1000000 <= $this->counter){
                    $this->counter = number_format($this->counter / 1000000, 1) . 'M';
                } elseif (1000 <= $this->counter){
                    $this->counter = number_format($this->counter / 1000, 1) . 'K';
                }
            }
        } else {
            foreach( $this->columns as $id => &$column){
                if (is_numeric($column->counter)){
                    if(1000000 <= $column->counter){
                        $column->counter = number_format($column->counter / 1000000, 1) . 'M';
                    } elseif (1000 <= $column->counter){
                        $column->counter = number_format($column->counter / 1000, 1) . 'K';
                    }
                }
            }
        }

        $xoops = \Xoops::getInstance();
        $xoops->tpl()->assign('widget', array(
            'id'        => $this->id,
            'property'  => $prop,
            'counter'   => $this->counter,
            'tagline'   => $this->tagline,
            'icon'      => HydrogenHelper::getInstance()->getIcon($this->icon),
            'columns'   => $this->columns
        ));
        return $xoops->tpl()->fetch('widget:system/widget-counter.tpl');
    }
}