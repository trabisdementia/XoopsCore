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
 * Javascript Language Strings
 *
 * @copyright   XOOPS Project (http://xoops.org)
 * @license     GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author      Eduardo Cortes (AKA bitcero)
 * @package     system
 * @version     $Id$
 */

ob_start();
?>

<script>
    /*
    Language strings used for XOOPS
    */
    var xoLang = {
        confirmUpdate: '<?php _e('Do you really want to update selected module?', 'system'); ?>'
    };
</script>

<?php
$language = ob_get_clean();
$xoops->theme()->headContent(null, $language);