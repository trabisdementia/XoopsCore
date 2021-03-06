<?php
namespace Xoops\Form;

require_once(dirname(__FILE__).'/../../../init_new.php');

/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-08-18 at 21:59:24.
 */

/**
 * PHPUnit special settings :
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */

class HiddenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Hidden
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Hidden('Caption', 'name');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Xoops\Form\Hidden::render
     */
    public function testRender()
    {
        $value = $this->object->render();
        $this->assertTrue(is_string($value));
        $this->assertTrue(false !== strpos($value, '<input'));
        $this->assertTrue(false !== strpos($value, 'type="hidden"'));
    }

    /**
     * @covers Xoops\Form\Hidden::__construct
     * @covers Xoops\Form\Hidden::render
     */
    public function test__construct()
    {
        $oldWay = new Hidden('myname', 'myvalue');
        $newWay = new Hidden(['name' => 'myname','value' => 'myvalue',]);
        $this->assertEquals($oldWay->render(), $newWay->render());
    }
}
