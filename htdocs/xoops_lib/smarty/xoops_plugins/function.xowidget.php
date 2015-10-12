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
 * Smarty plugin that loads a widget
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

/**
 * Retrieves a transported widget
 *
 * Accepted parameters:
 * <ul>
 * <li><strong>id</strong> (required). The widget id to find. This id must correspond to id provided when the widget
 * was created.</li>
 * <li>Any other parameter supported for widget (see widget docs).</li>
 * </ul>
 *
 * Example:
 * <pre>
 * <{xowidget id="widget_id" icon="..." layout="..." ...}>
 * </pre>
 *
 * @param array $params
 * @param $smarty
 *
 * @return string
 */
function smarty_function_xowidget($params, &$smarty)
{

    include_once XOOPS_ROOT_PATH . '/modules/system/class/WidgetsContainer.php';

    if (! array_key_exists('id', $params)){
        return __('Widget ID not specified!', 'xoops');
    }
    $id = $params['id'];

    if (array_key_exists('widget', $params)){
        // Crear un nuevo widget
        $xoops = \Xoops::getInstance();
        $widgets = $xoops->service('AdminWidget');
        $widget = $widgets->loadWidget($params['widget'])->getValue();

        if (! $widget){
            return sprintf(__('Widget %s could not be located!', 'xoops'), $params['widget']);
        }
        $widget->setId($id);

    } else {
        if (false === ($widget = WidgetsContainer::getInstance()->{$id})){
            return sprintf(__('Widget %s not found!', 'xoops'), $id);
        }
    }

    foreach( $params as $name => $value ){
        $widget->{$name} = $value;
    }

    return $widget->render();
}
