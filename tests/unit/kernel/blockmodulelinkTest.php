<?php
require_once(dirname(__FILE__).'/../init_new.php');

require_once(XOOPS_TU_ROOT_PATH . '/kernel/blockmodulelink.php');

/**
* PHPUnit special settings :
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class legacy_blockmodulelinkTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
    }

    public function test___construct()
    {
        $instance=new \XoopsBlockmodulelink();
        $this->assertInstanceOf('\Xoops\Core\Kernel\Handlers\XoopsBlockmodulelink', $instance);
    }
}
