<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xoops\Core\Kernel\Criteria;
use Xoops\Core\Kernel\CriteriaCompo;
use Xoops\Core\Kernel\Handlers\XoopsModule;

/**
 * Preference Form Class
 *
 * @category  Modules/system/class/form
 * @package   SystemPreferencesForm
 * @author    Andricq Nicolas (AKA MusS)
 * @author    trabis <lusopoemas@gmail.com>
 * @copyright 2000-2014 XOOPS Project (http://xoops.org)
 * @license   GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link      http://xoops.org
 * @since     2.0
 */
class SystemPreferencesForm extends Xoops\Form\SimpleForm
{
    /**
     * __construct
     *
     * @param null $obj unused object
     */
    public function __construct($obj = null)
    {
    }

    /**
     * getForm
     *
     * @param array       &$dbConfigs array of config objects stored in database
     * @param XoopsModule $mod module
     *
     * @return void
     */
    public function getForm(XoopsModule $mod)
    {
        $xoops = Xoops::getInstance();
        parent::__construct('', 'settingsForm', 'settings.php', 'post', true);

        $dbConfigs = $xoops->getModuleConfigs($mod->getVar('dirname'));

        if ($mod->getVar('dirname') !== 'system') {
            $xoops->loadLanguage('modinfo', $mod->getVar('dirname'));
        }

        $xoops->loadLocale($mod->getVar('dirname'));

        // Gettext Locale
        Xoops\Core\Helper\PoLocale::getInstance()->loadModuleLocale($mod->getVar('dirname'));

        /**
         * Configs stored in xoops_version file
         * We need to translate the original array to a new
         * array with IDs as keys
         */
        $tmpConfigs = $mod->getInfo('config');
        $fileConfigs = [];

        foreach (array_keys($tmpConfigs) as $i) {
            $fileConfigs[$tmpConfigs[$i]['name']] = (object) $tmpConfigs[$i];
        }
        unset($tmpConfigs);

        /**
         * Now load the categories (if any) to organize the options
         * If there are not categories declared, then we'll create a
         * 'default' category
         */
        $categories = $mod->getInfo('configcat');
        if(empty($categories)){
            $categories = [
                'default' => [
                    'caption'    => __('Other settings', 'system'),
                    'icon' => 'xicon-gear',
                    'description' => ''
                ]
            ];
        }

        /**
         * All items without a category will be assigned to default category
         */
        if (!in_array('default', array_keys($categories))) {
            $categories['default'] = array(
                'name'        => __('Other settings', 'system'),
                'icon' => 'xicon-gear',
                'description' => ''
            );
        }

        $xoops->preload()->triggerEvent('onSystemPreferencesForm', array($mod));

        /**
         * Iterate over config options stored in database
         */

        foreach($fileConfigs as $option){

            $field = (object) [
                'caption' => $title = \Xoops\Locale::translate($option->title, $mod->getVar('dirname')),
                'description' => ($option->description != '') ? \Xoops\Locale::translate($option->description, $mod->getVar('dirname')) : '',
                'formtype' => $option->formtype,
                'value' => isset($dbConfigs[$option->name]) ? $dbConfigs[$option->name] : $option->default,
                'type' => $option->valuetype,
                'options' => isset($option->options) ? $option->options : null,
                'category' => isset($option->category) ? $option->category : 'default'
            ];

            if(!isset($categories[$option->category])){
                $option->category = 'default';
            }

            $categories[$option->category]['fields'][$option->name] = $field;

        }

        if (!empty($_REQUEST["redirect"])) {
            $myts = \Xoops\Core\Text\Sanitizer::getInstance();
            $field = (object) [
                'formtype' => 'hidden',
                'value' => $myts->htmlSpecialChars($_REQUEST["redirect"])
            ];
        } elseif ($mod->getInfo('adminindex')) {
            $field = (object) [
                'formtype' => 'hidden',
                'value' => \XoopsBaseConfig::get('url') . '/modules/' . $mod->getVar('dirname') . '/' . $mod->getInfo('adminindex')
            ];
        }

        $categories['general']['fields']['redirect'] = $field;

        return $categories;

    }
    
    public function getFieldByType($option, $directory, $cssClass = 'form-control'){

        $xoops = Xoops::getInstance();

        switch ($option->formtype) {

            case 'textarea':
                $myts = \Xoops\Core\Text\Sanitizer::getInstance();
                if ($option->type === 'array') {
                    // this is exceptional.. only when value type is arrayneed a smarter way for this
                    $ele = ($option->value != '')
                        ? new Xoops\Form\TextArea([
                                'name' => $option->name,
                                'value' => $option->value,
                                'rows' => 5
                            ]
                        )
                        : new Xoops\Form\TextArea([
                            'name' => $option->name,
                            'value' => '',
                            'rows' => 5
                        ]);
                } else {
                    $ele = new Xoops\Form\TextArea([
                            'name' => $option->name,
                            'value' => $option->name,
                            'rows' => 5
                        ]
                    );
                }
                $ele->add('class', $cssClass);
                break;

            case 'select':
                $ele = new Xoops\Form\Select(
                    '',
                    $option->name,
                    $option->value
                );
                $ele->add('class', $cssClass);
                $options = $option->options;
                $opcount = count($options);
                foreach($option->options as $optName => $optVal){
                    $optval = \Xoops\Locale::translate($optVal, $directory);
                    $optkey = \Xoops\Locale::translate($optName, $directory);
                    $ele->addOption($optval, $optkey);
                }
                break;

            case 'select_editor':
                $ele = new Xoops\Form\Select(
                    '',
                    $option->name,
                    $option->value
                );
                \Xoops\Core\Lists\Editor::setOptionsArray($ele);
                $ele->add('class', $cssClass);
                break;

            case 'select_multi':
                $ele = new Xoops\Form\Select('', $option->name, $option->value, 5, true);

                foreach ($option->options as $optName => $optValue) {
                    $optval = \Xoops\Locale::translate($optValue, $directory);
                    $optkey = \Xoops\Locale::translate($optName, $directory);
                    $ele->addOption($optval, $optkey);
                }
                $ele->add('class', $cssClass);

                unset($optName, $optValue, $optval, $optkey);
                break;

            case 'yesno':
                $ele = new Xoops\Form\RadioYesNo('', $option->name, $option->value);
                break;

            case 'theme':
            case 'theme_multi':
                $ele = ($option->formtype !== 'theme_multi') ? new Xoops\Form\Select('', $option->name, $option->value) : new Xoops\Form\Select('', $option->name, $option->value, 5, true);
                $dirlist = XoopsLists::getThemesList();
                if (!empty($dirlist)) {
                    asort($dirlist);
                    $ele->addOptionArray($dirlist);
                }
                $ele->add('class', $cssClass);
                break;
            case 'tplset':
                $ele = new Xoops\Form\Select('', $option->name, $option->value);
                $tplset_handler = $xoops->getHandlerTplSet();
                $tplsetlist = $tplset_handler->getNameList();
                asort($tplsetlist);
                foreach ($tplsetlist as $key => $name) {
                    $ele->addOption($key, $name);
                }
                $ele->add('class', $cssClass);
                break;

            case 'cpanel':
                $ele = new Xoops\Form\Hidden($option->name, $option->value);
                /*
                $ele = new Xoops\Form\Select($title, $config[$i]->getVar('conf_name'), $config[$i]->getConfValueForOutput());
                XoopsLoad::load("cpanel", "system");
                $list = XoopsSystemCpanel::getGuis();
                $ele->addOptionArray($list);  */
                break;

            case 'timezone':
                $ele = new Xoops\Form\SelectTimeZone('', $option->name, $option->value);
                $ele->add('class', $cssClass);
                break;

            case 'language':
                $ele = new Xoops\Form\SelectLanguage('', $option->name, $option->value);
                $ele->add('class', $cssClass);
                break;

            case 'locale':
                $ele = new Xoops\Form\SelectLocale('', $option->name, $option->value);
                $ele->add('class', $cssClass);
                break;

            case 'startpage':
                $ele = new Xoops\Form\Select('', $option->name, $option->value);

                $module_handler = $xoops->getHandlerModule();
                $criteria = new CriteriaCompo(new Criteria('hasmain', 1));
                $criteria->add(new Criteria('isactive', 1));
                $moduleslist = $module_handler->getNameList($criteria, true);
                $moduleslist['--'] = XoopsLocale::NONE;
                $ele->addOptionArray($moduleslist);
                $ele->add('class', $cssClass);
                break;

            case 'group':
                $ele = new Xoops\Form\SelectGroup('', $option->name, false, $option->value, 1, false);
                $ele->add('class', $cssClass);
                break;

            case 'group_multi':
                $ele = new Xoops\Form\SelectGroup('', $option->name, false, $option->value, 5, true);
                $ele->add('class', $cssClass);
                break;

            // RMV-NOTIFY: added 'user' and 'user_multi'
            case 'user':
                $ele = new Xoops\Form\SelectUser('', $option->name, false, $option->value, 1, false);
                $ele->add('class', $cssClass);
                break;

            case 'user_multi':
                $ele = new Xoops\Form\SelectUser('', $option->name, false, $option->value, 5, true);
                $ele->add('class', $cssClass);
                break;
            case 'module_cache':
                $module_handler = $xoops->getHandlerModule();
                $modules = $module_handler->getObjectsArray(new Criteria('hasmain', 1), true);
                $currrent_val = $option->value;
                $cache_options = array(
                    '0'       => XoopsLocale::NO_CACHE,
                    '30'      => sprintf(XoopsLocale::F_SECONDS, 30),
                    '60'      => XoopsLocale::ONE_MINUTE,
                    '300'     => sprintf(XoopsLocale::F_MINUTES, 5),
                    '1800'    => sprintf(XoopsLocale::F_MINUTES, 30),
                    '3600'    => XoopsLocale::ONE_HOUR,
                    '18000'   => sprintf(XoopsLocale::F_HOURS, 5),
                    '86400'   => XoopsLocale::ONE_DAY,
                    '259200'  => sprintf(XoopsLocale::F_DAYS, 3),
                    '604800'  => XoopsLocale::ONE_WEEK,
                    '2592000' => XoopsLocale::ONE_MONTH
                );
                if (count($modules) > 0) {
                    $ele = new Xoops\Form\ElementTray('', '<br />');
                    foreach (array_keys($modules) as $mid) {
                        $c_val = isset($currrent_val[$mid]) ? (int)($currrent_val[$mid]) : null;
                        $selform = new Xoops\Form\Select($modules[$mid]->getVar('name'), $option->name . "[$mid]", $c_val);
                        $selform->addOptionArray($cache_options);
                        $ele->addElement($selform);
                        unset($selform);
                    }
                } else {
                    $ele = new Xoops\Form\Label('', SystemLocale::NO_MODULE_TO_CACHE);
                }
                $ele->add('class', $cssClass);
                break;

            case 'site_cache':
                $ele = new Xoops\Form\Select('', $option->name, $option->value);
                $ele->addOptionArray(array(
                    '0'       => XoopsLocale::NO_CACHE,
                    '30'      => sprintf(XoopsLocale::F_SECONDS, 30),
                    '60'      => XoopsLocale::ONE_MINUTE,
                    '300'     => sprintf(XoopsLocale::F_MINUTES, 5),
                    '1800'    => sprintf(XoopsLocale::F_MINUTES, 30),
                    '3600'    => XoopsLocale::ONE_HOUR,
                    '18000'   => sprintf(XoopsLocale::F_HOURS, 5),
                    '86400'   => XoopsLocale::ONE_DAY,
                    '259200'  => sprintf(XoopsLocale::F_DAYS, 3),
                    '604800'  => XoopsLocale::ONE_WEEK,
                    '2592000' => XoopsLocale::ONE_MONTH
                ));
                $ele->add('class', $cssClass);
                break;

            case 'password':
                $myts = \Xoops\Core\Text\Sanitizer::getInstance();
                $ele = new Xoops\Form\Password('', $option->name, 32, 255, $myts->htmlSpecialChars($option->value));
                $ele->add('class', $cssClass);
                break;

            case 'color':
                $myts = \Xoops\Core\Text\Sanitizer::getInstance();
                $ele = new Xoops\Form\ColorPicker('', $option->name, $myts->htmlSpecialChars($option->value));
                break;

            case 'hidden':
                $myts = \Xoops\Core\Text\Sanitizer::getInstance();
                $ele = new Xoops\Form\Hidden($option->name, $myts->htmlSpecialChars($option->value));
                break;

            case 'textbox':
            default:
                $myts = \Xoops\Core\Text\Sanitizer::getInstance();
                $ele = new Xoops\Form\Text('', $option->name, 5, 255, $myts->htmlSpecialChars($option->value));
                $ele->add('class', $cssClass);
                break;
        }

        $ele = $xoops->preload()->triggerEventWithReturn('system.field.by.type', $ele, $option, $directory, $cssClass);

        return $ele;
        
    }
}
