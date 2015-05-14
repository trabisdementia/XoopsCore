<?php
/**
 * @todo: Make this functions global for all elements
 */

/**
 * Translate a text and print it
 * @param string Text to translate
 * @param string Domain name. Here you must specify the app name (eg. system), or plugin name (eg. rss) or theme Name.
 * The teme name must be specified with prefix "theme_". eg. "theme_exm" or "theme_simplex"
 * @return print string
 */
function _e($text, $domain='xoops'){
    echo \Xoops\Core\Helper\PoLocale::getInstance()->translateText($text, $domain);
}

/**
 * Translate a text and print it
 * @param string Text to translate
 * @param string Domain name. Here you must specify the app name (eg. system), or plugin name (eg. rss) or theme Name.
 * The teme name must be specified with prefix "theme_". eg. "theme_exm" or "theme_simplex"
 * @return string
 */
function __($text, $domain='xoops'){
    return \Xoops\Core\Helper\PoLocale::getInstance()->translateText($text, $domain);
}