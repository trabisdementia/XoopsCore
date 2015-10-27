<?php
namespace Xoops\Core\Lists;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-10-17 at 19:29:10.
 */

require_once __DIR__ . '/../../../../init_new.php';

/**
 * PHPUnit special settings :
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $className = '\Xoops\Core\Lists\File';

    /**
     * @var File
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new File;
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
        $this->assertInstanceOf('\Xoops\Core\Lists\File', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Lists\ListAbstract', $this->object);
    }

    /**
     * @covers Xoops\Core\Lists\File::getList
     * @todo   Implement testGetList().
     */
    public function testGetList()
    {
        $reflection = new \ReflectionClass($this->className);
        $method = $reflection->getMethod('getList');
        $this->assertTrue($method->isStatic());
    }
}
