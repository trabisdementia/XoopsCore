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
 * Controller for Admin GUI alerts
 *
 * Copyright © 2015 The XOOPS project http://xoops.org
 * -----------------------------------------------------------------
 * @copyright    2015 The XOOPS project http://sf.net/projects/xoops/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package      Helpers
 * @link         http://xoops.org
 * @since        2.6
 * @author       Eduardo Cortés <i.bitcero@gmail.com>
 */

class GuiAlerts
{
    /**
     * Messages container
     *
     * @var array
     */
    private $messages = array();

    /**
     * Add a new message to alerts container. The message must be an array:
     * <pre>
     * array (
     *      'icon'          => 'xicon-...',
     *      'text'          => 'Message content',
     *      'type'          => 'error|info|success|warning',
     *      'module_name'   => 'Module name to show'
     * )
     * <pre>
     *
     * @param $message
     * @return bool
     */
    public function add($message)
    {
        if (! is_array($message) || empty($message)){
            return false;
        }

        $message['text'] = strip_tags($message['text'], '<strong><span><a><em><small>');
        $this->messages[] = $message;
        return true;
    }

    private function shortcutAdd($type, $text, $icon, $module){
        if ('' == $text){
            return false;
        }

        $xoops = \Xoops::getInstance();
        if ('' == $module){
            $module = $xoops->module ? $xoops->module->name() : __('System', 'xoops');
        }

        $types = array(
            'info'      => 'xicon-info',
            'warning'   => 'xicon-alert-triangle',
            'success'   => 'xicon-check-circle',
            'error'     => 'xicon-report'
        );

        if (! isset($types[$type])){
            $type = 'info';
        }

        $message = array(
            'icon'      => '' == $icon ? $icon : $types[$type],
            'text'      => $text,
            'module'    => $module,
            'type'      => $type
        );
        return $this->add($message);
    }

    /**
     * Shortcut for add() method.
     *
     * @param        $text
     * @param string $icon
     * @param string $module
     *
     * @return bool
     */
    public function addInfo($text, $icon = 'xicon-info', $module = '')
    {
        return $this->shortcutAdd('info', $text, $icon, $module ? __('System', 'xoops') : $module);
    }

    public function addWarning($text, $icon = 'xicon-alert-triangle', $module = ''){
        return $this->shortcutAdd('warning', $text, $icon, $module ? __('System', 'xoops') : $module);
    }

    public function addSuccess($text, $icon = 'xicon-check-circle', $module = ''){
        return $this->shortcutAdd('success', $text, $icon, $module ? __('System', 'xoops') : $module);
    }

    public function addError($text, $icon = 'xicon-report', $module = ''){
        return $this->shortcutAdd('error', $text, $icon, $module ? __('System', 'xoops') : $module);
    }

    /**
     * Get all messages
     *
     * @return array
     */
    public function get(){
        return $this->messages;
    }

    /**
     * Access the only instance of this class
     */
    static function getInstance()
    {
        static $instance;

        if (!isset($instance)) {
            $instance = new GuiAlerts();
        }
        return $instance;
    }
}