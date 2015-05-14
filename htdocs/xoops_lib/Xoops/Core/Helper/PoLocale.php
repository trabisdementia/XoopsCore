<?php
/**
 * Localization with PO files
 *
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
 * @package       core
 * @subpackage    helpers
 * @since         2.6
 * @author        bitcero <i.bitcero@gmail.com>
 */

namespace Xoops\Core\Helper;

/**
 * Allows to localize modules, plugins and themes using GetText
 * Class PoLocale
 * @package Xoops\Core\Helper
 */
class PoLocale
{
    /**
     * Current language code
     * @var string
     */
    static $locale = 'en_US';

    public $l10n = array();

    /**
     * Gets the current language
     * @return string
     */
    public function getLocale()
    {
        if ('' != $this::$locale) {
            return $this::$locale;
        }

        $xoops = \Xoops::getInstance();
        $this::$locale = $xoops->getConfig('locale');
        return $this::$locale;
    }

    /**
     * Load the language files content in a single object and order these files
     * by domain. The domain must be unique for each element. By example: Application
     * MyWords can have "mywords" as domain. Domains 'xoops' is reserved by Xoops and
     * must not be used by any other element
     *
     * @param string $domain Unique identifier for this file
     * @param string Local path to file
     * @return bool
     */
    function loadLocaleFile($domain, $file)
    {
        if (array_key_exists($domain, $this->l10n)){
            return true;
        }

        if (is_readable($file)){
            $cache = new CachedFileReader($file);
        } else {
            return false;
        }

        $gettext = new \gettext_reader($cache);

        if ( array_key_exists($domain, $this->l10n) ) {
            $this->l10n[$domain]->load_tables();
            $gettext->load_tables();
            $this->l10n[$domain]->cache_translations = array_merge($gettext->cache_translations, $this->l10n[$domain]->cache_translations);
        } else {
            $this->l10n[$domain] = $gettext;
        }

        unset($input, $gettext);
        return true;
    }

    /**
     * Load localization from a MO file
     * @param $path
     * @param $domain
     *
     * @return bool
     */
    public function loadLocale($path, $domain)
    {
        if ('' == $path || '' == $domain){
            return false;
        }

        $locales = \Xoops_Locale::getUserLocales();

        foreach ($locales as $locale){
            $file = $path."/{$locale}.mo";
            if (\XoopsLoad::fileExists($file)) {
                $this->loadLocaleFile($domain, $file);
                return true;
            }
        }

        return false;
    }

    /**
     * Translate a string
     *
     * @param string $text
     * @param string $domain
     *
     * @return mixed
     */
    function translateText($text, $domain = 'xoops')
    {
        if (!array_key_exists($domain, $this->l10n)) {
            return $text;
        } else {
            return $this->l10n[$domain]->translate($text);
        }
    }

    /**
     * Load the Xoops locale if exists
     * @return bool
     */
    public function loadXoopsLocale()
    {
        $xoops = \Xoops::getInstance();
        $path = $xoops->path('locale');
        return $this->loadLocale($path, 'xoops');
    }

    /**
     * Load the translations string for a given module
     * @param string $dirname Dirname where module resides
     * @return bool
     */
    public function loadModuleLocale($dirname)
    {
        $xoops = \Xoops::getInstance();
        $path = $xoops->path("modules/{$dirname}/locale");
        return $this->loadLocale($path, $dirname);
    }

    /**
     * Load the translations string for a given plugin dirname
     * @param string $dirname Dirname where plugins resides
     * @return bool
     */
    public function loadPluginLocale($dirname)
    {
        $xoops = \Xoops::getInstance();
        $path = $xoops->path("plugins/{$dirname}/locale");
        return $this->loadLocale($path, $dirname);
    }

    /**
     * Load the translations string for a given theme
     * @param string $dirname Dirname where theme resides
     * @return bool
     */
    public function loadThemeLocale($dirname, $cpanel = false)
    {
        $xoops = \Xoops::getInstance();
        if ( $cpanel ){
            $path = $xoops->path("modules/system/themes/{$dirname}/locale");
        } else {
            $path = $xoops->path("themes/{$dirname}/locale");
        }
        return $this->loadLocale($path, 'theme_'.$dirname);
    }

    /**
     * Access the only instance of this class
     */
    static function getInstance()
    {
        static $instance;

        if (!isset($instance)) {
            $instance = new PoLocale();
        }
        return $instance;
    }
}

