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
            'extensions'        => __('Extensions', 'hydrogen'),
            'alerts'            => __('Alerts', 'hydrogen')
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

    /**
     * Returns de icon formated between $this->icon_tpl content.
     * This method uses Xoops::getIcon() method
     *
     * @param string $icon
     * @param string $module
     * @param string $alt
     *
     * @return string
     */
    public function getIcon($icon, $module = '', $alt = '')
    {
        $xoops = \Xoops::getInstance();
        $file = $xoops->getIcon( $icon, $module );

        if ('<svg' == substr($file, 0, 4)){
            return sprintf($this->icon_tpl, $file);
        } else {
            $img = '<img src="' . $file . '" alt="' . $alt . '">';
            return sprintf($this->icon_tpl, $img);
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