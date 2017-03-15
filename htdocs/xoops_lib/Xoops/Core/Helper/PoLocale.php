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
 * Localization with MO files
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

        $locales = \Xoops\Locale::getUserLocales();

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

