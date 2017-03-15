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
 * Breadcrumbs handler
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

namespace Xoops\Core\Helper;

class Breadcrumb
{
    /**
     * Crumbs container
     * @var array
     */
    private $crumbs = array();
    /**
     * Breadcrumb identifier
     * @var string
     */
    private $id = '';

    /**
     * Class constructor
     * @param string $id ID for HTML element
     */
    public function __construct($id = '')
    {
        if ('' == $id){
            $id = 'xo-breadcrumb';
        }
        $this->id = $id;
    }

    /**
     * Add a new element to breadcrumb
     *
     * Accepted parameters:
     *
     * <ul>
     * <li><strong>icon</strong>. An icon (SVG preferable or xicon) to show in breadcrumb.</li>
     * <li><strong>class</strong>. A string for css class to apply to this element.</li>
     * <li><strong>id</strong>. A string for HTML identifier for this element.</li>
     * <li><strong>HTML attribute</strong>. Any other valid HTML attribute.</li>
     * </ul>
     *
     * <p><em>The HTMl attributes passed as paremeters will be added to anchor (&lt;a&gt;) element.</em></p>
     *
     *
     * <strong>Example:</strong>
     *
     * <pre>
     *  $breadCrumb = \Xoops\Core\Helper\Breadcrumb::getInstance();
     *  $breadCrumb->addCrumb(
     *      'Item title',
     *      'http://www.xoops.org',
     *      array(
     *          'class' => 'special-bc',
     *          'icon'  => ',
     *          'rel'   => 'external',
     *          'role'  => 'button'
     *      )
     *  );
     * </pre>
     *
     * Note that the render of all this information depends from the theme.
     *
     * @param string $title     Title (caption) for element
     * @param string $link      URL for link
     * @param array  $params    Parameters for crumb
     * @return bool
     */
    public function addCrumb($title, $link = '', $params = array())
    {
        // Crumb must have a title and a link
        if ('' == $title){
            return false;
        }

        $this->crumbs[] = array(
            'caption'   => $title,
            'link'      => $link,
            'params'    => $params
        );

        return true;
    }

    /**
     * Render the breadcrumb HTML
     * @return string
     * @throws \Exception
     * @throws \SmartyException
     */
    public function render()
    {
        $xoops = \Xoops::getInstance();
        $xoops->tpl()->assign('xo_breadcrumb', $this->crumbs);
        $xoops->tpl()->assign('xo_breadcrumb_id', $this->id);
        return $xoops->tpl()->fetch("admin:system/admin_breadcrumb.tpl");
    }

    /**
     * Access the only instance of this class
     */
    static function getInstance()
    {
        static $instance;

        if (!isset($instance)) {
            $instance = new Breadcrumb();
        }
        return $instance;
    }
}
