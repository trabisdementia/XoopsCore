<?php
/**
 * Hydrogen Xoops Cpanel
 * Helper class for Hydrogen
 *
 * Copyright © 2015 The XOOPS project http://sf.net/projects/xoops/
 * -----------------------------------------------------------------
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * -----------------------------------------------------------------
 * @copyright     The XOOPS project http://sf.net/projects/xoops/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package       system
 * @subpackage    GUI
 * @since         2.6
 * @author        bitcero <i.bitcero@gmail.com>
 * @version       1
 */

class HydrogenHelper
{
    /**
     * Template to show Xoops icons
     * @var string
     */
    private $icon_tpl = '<span class="xo-icon-svg">%s</span>';

    /**
     * Stores all Hydrogen theme data to use with Smarty
     * @var array
     */
    private $data = array();

    /**
     * Creates a new entry in data array or replace existing one
     * @param string $var
     * @param mixed $value
     */
    public function add_data($var, $value)
    {
        $this->data[$var] = $value;
    }

    /**
     * Append a new item to an existing var
     * @param string $var
     * @param mixed $value
     */
    public function append_data($var, $value)
    {
        if ( array_key_exists($var, $this->data) ){
            $this->data[$var][] = $value;
        } else {
            $this->data[$var] = array();
            $this->data[$var][] = $value;
        }
    }

    public function render_data()
    {
        $xoops = Xoops::getInstance();
        $xoops->tpl()->assign( 'hydrogen', $this->data );
    }

    /**
     * Build the language strings and assign to Smarty
     */
    public function buildLanguage()
    {
        $this->data['lang'] = array(
            'hi_user'           => __('Hi %s!', 'hydrogen'),
            'system_module'     => __('System Menu', 'hydrogen'),
            'dashboard'         => __('Dashboard', 'hydrogen'),
            'modules'           => __('Modules', 'hydrogen'),
            'extensions'           => __('Extensions', 'hydrogen')
        );
    }

    /**
     * Creates the module slink URL
     *
     * @param $module
     *
     * @return string
     */
    public function makeModuleLink( &$module )
    {
        $xoops = \Xoops::getInstance();
        if ($module->modinfo['hasAdmin']){
            $link = $xoops->url('modules/' . $module->modinfo['dirname'] . '/' . $module->modinfo['adminindex']);
        } else {
            $link = $xoops->url('modules/' . $module->modinfo['dirname']);
        }
        return $link;
    }

    public function getIcon($icon, $module = '')
    {
        $xoops = \Xoops::getInstance();

        // Check if this is a Xoops SVG icon
        if ('xicon-' == substr($icon, 0, 6)){
            $file = $xoops->path("media/xoops/icons/".substr($icon, 6).".svg");
            if (! file_exists($file)){
                $file = $xoops->path("media/xoops/icons/guess-what.svg");
            }
            return sprintf($this->icon_tpl, file_get_contents($file));
        }

        // Relative or absolute url?
        $absolute = preg_match( "/^[http:\/\/|https:\/\/|ftp:\/\/|\/\/]/", $icon );
        $is_svg = substr($icon, -4) == '.svg';

        // Icon with absolute path
        if ($absolute){
            if ($is_svg){
                return sprintf($this->icon_tpl, file_get_contents($icon));
            } else {
                return sprintf($this->icon_tpl, '<img src="'. $icon . '">');
            }
        }

        // Icon with relative path
        $module_relative = preg_match( "/^[\/|\.\.\/]/", $icon ) ? false : true;

        if ('' == $module && $xoops->isModule()){
            $module = $xoops->module->dirname();
        }

        if ('' == $module && $module_relative){
            return null;
        }

        if ($is_svg){
            $file = $module_relative ? $xoops->path("modules/{$module}/{$icon}") : $xoops->path($icon);
            if(file_exists($file)){
                return sprintf($this->icon_tpl, file_get_contents($file));
            } else {
                return null;
            }
        } else {
            $file = $module_relative ? $xoops->url("modules/{$module}/{$icon}") : $xoops->url($icon);
            return sprintf($this->icon_tpl, '<img src="' . $file . '">');
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