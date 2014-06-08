<?php
namespace Fuelman\Object\Model;

class ModelCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Requiring an array to be provided
     */
    public function testCannotSetCollectionWithoutAnArray()
    {
        $collection = new ModelCollection();
        $collection->set('foo');
    }

    public function testCanSetCollectionWithArray()
    {
        $collection = new ModelCollection();
        $collection->set(array ('foo','bar'));
        $this->assertCount(2, $collection);
        $this->assertEquals('foo', $collection->current());
        $this->assertEquals(0, $collection->key());
    }

    public function testCanMoveForwardInCollection()
    {
        $collection = new ModelCollection();
        $collection->set(array ('foo', 'bar'));
        $collection->rewind();
        $collection->next();
        $this->assertEquals('bar', $collection->current());
    }

    public function testValidationOfPositionInCollection()
    {
        $collection = new ModelCollection();
        $collection->set(array ('foo', 'bar'));
        $collection->seek(1);
        $this->assertTrue($collection->valid());
        $this->assertEquals('bar', $collection->current());
        $collection->seek(2);
        $this->assertFalse($collection->valid());
    }
} 