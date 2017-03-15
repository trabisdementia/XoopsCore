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
 * A lot of utilities ported from Common Utilities
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

class Utilities
{
    /**
     * Merge attributes in a single array by comparing default
     * values with new ones
     * @param array $attributes Default attributes values
     * @param array $default New attributes values
     * @return array New array with intersected values
     */
    static public function mergeAttributes($attributes, $default)
    {

        $attributes = (array)$attributes;

        foreach ($default as $name => $value) {
            if (!array_key_exists($name, $attributes)) {
                // New value
                $attributes[$name] = $value;
            }
        }
        return $attributes;
    }
}