<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xoops\Core\Service\AbstractContract;
use Xoops\Core\Service\Contract\AdminwidgetInterface;
use Xoops\Core\Service\Response;

/**
 * Admin widgets provider for service manager
 *
 * Copyright © 2015 The XOOPS project http://sf.net/projects/xoops/
 * -----------------------------------------------------------------
 * @copyright    2015 The XOOPS project http://sf.net/projects/xoops/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package      AdminWidgetsProvider
 * @link         http://xoops.org
 * @since        2.6
 * @author       Eduardo Cortés <i.bitcero@gmail.com>
 * @category     ServiceProvider
 */
class AdminWidgetsProvider extends AbstractContract implements AdminwidgetInterface
{
    /**
     * Available widgets list
     * @var array
     */
    private $widgets = array(
        'counter'   => 'WidgetsCounter'
    );
    /**
     * Short name for service provider.
     *
     * @return string A unique name for the service provider
     */
    public function getName()
    {
        return 'system';
    }

    /**
     * Description of service provider
     *
     * @return bool|mixed|string
     */
    public function getDescription(){
        return __('Built in admin widgets provider', 'xoops');
    }

    /**
     * Loads a widget and return it
     *
     * @param $response
     * @param $id
     *
     * @return void
     */
    public function loadWidget($response, $id){
        if (! array_key_exists($id, $this->widgets)) {
            $response->setSuccess(false)->addErrorMessage(__('Widget ID is not recognized!', 'xoops'));
        } else {
            $path = dirname(__DIR__) . '/widgets/Widget' . ucfirst($id) . '.php';
            if (! file_exists($path)){
                $response->setSuccess(false)->addErrorMessage(__('Widget not found!', 'xoops'));
                return null;
            }
            require_once $path;
            $class = 'Widget' . ucfirst($id);
            $widget = new $class();
            $response->setValue($widget);
        }
    }

    /**
     * Returns the list of provided widgets
     *
     * @param $response
     *
     * @return mixed|void
     */
    public function widgetsList($response){
        $response->setValue($this->widgets);
    }
}