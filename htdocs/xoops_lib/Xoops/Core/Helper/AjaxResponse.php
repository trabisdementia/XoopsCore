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
 * Copyright © 2015 The XOOPS project http://xoops.org
 * -----------------------------------------------------------------
 * @copyright    2015 The XOOPS project http://xoops.org
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package      Helpers
 * @link         http://xoops.org
 * @since        2.6
 * @author       Eduardo Cortés <i.bitcero@gmail.com>
 */

class AjaxResponse
{
    /**
     * Prepare system for ajax responses
     */
    public static function prepareResponse()
    {
        $xoops = \Xoops::getInstance();
        $xoops->logger()->quiet();
        \DebugbarLogger::getInstance()->disable();
        \DebugbarLogger::getInstance()->quiet();
    }

    /**
     * Sends a JSON response to client. You must provide at least three basic values with data:
     * 'title', 'content' and 'type'.
     *
     * <p>Other supported values are:</p>
     *
     * <ul><li><strong>'goto'</strong>: redirects client browser to a specified location</li>
     * <li><strong>'action'</strong>: run some javascript function in client</li>
     * <li><strong>'close'</strong>: Stablish the close button when a dialog will be open in client</li>
     * <li><strong>'reload'</strong>: Refresh the current client page</li>
     * <li><strong>'closeModal'</strong>: Close a modal box. Must contain the modal box ID</li></ul>
     *
     * @param array $data
     * @param bool $token Send a new security token?
     */
    public static function response(array $data, $token = true)
    {
        global $xoopsSecurity;

        // Default values for data
        $default = array(
            'type' => 'success',
            'message' => '',
            'title' => ''
        );

        $data = Utilities::mergeAttributes($data, $default);

        if ($token) {
            $data['token'] = $xoopsSecurity->createToken();
        }

        echo json_encode($data);
        exit();
    }

}