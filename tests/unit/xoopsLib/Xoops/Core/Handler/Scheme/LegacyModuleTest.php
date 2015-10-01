<?php
namespace Xoops\Core\Handler\Scheme;

use Xoops\Core\Handler\Factory;
use Xoops\Core\Handler\Scheme\SchemeInterface;

require_once __DIR__ . '/../../../../../init_new.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-09-22 at 18:11:45.
 */
class LegacyModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LegacyModule
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new LegacyModule;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testContracts()
    {
        $this->assertInstanceOf('\Xoops\Core\Handler\Scheme\SchemeInterface', $this->object);
    }

    /**
     * @covers Xoops\Core\Handler\Scheme\LegacyModule::build
     */
    public function testBuild()
    {
        $spec = Factory::getInstance()->newSpec()->scheme('legacy')->name('avatar')->dirname('avatars');
        $this->assertInstanceOf('\AvatarsAvatarHandler', $this->object->build($spec));
    }

    /**
     * @expectedException \Xoops\Core\Exception\NoHandlerException
     * @covers Xoops\Core\Handler\Scheme\LegacyModule::build
     */
    public function testBuild_exception()
    {
        $handler = Factory::getInstance()->newSpec()->scheme('legacy')->name('nosuchhandler')->dirname('avatars')->build();
    }

    /**
     * @covers Xoops\Core\Handler\Scheme\LegacyModule::build
     */
    public function testBuild_optional()
    {
        $handler = Factory::getInstance()->newSpec()
            ->scheme('legacy')
            ->name('nosuchhandler')
            ->dirname('avatars')
            ->optional(true)
            ->build();
        $this->assertNull($handler);
        $handler = Factory::getInstance()->newSpec()
            ->scheme('legacy')
            ->name('avatar')
            ->dirname('avatars')
            ->optional(true)
            ->build();
        $this->assertInstanceOf('\AvatarsAvatarHandler', $handler);
    }
}
