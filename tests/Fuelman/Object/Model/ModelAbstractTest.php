<?php
namespace Fuelman\Object\Model;

use Faker\Factory;
use Fuelman\Object\Entry;

class ModelAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Invalid method defined
     */
    public function testExceptionThrownForNonexistingLabelInSafeSetMethod()
    {
        $safeSet = new \ReflectionMethod('\Fuelman\Object\Model\ModelAbstract', 'Safeset');
        $safeSet->setAccessible(true);
        $safeSet->invokeArgs(new Stub(), array(array ('foo' => 'bar'), 'foo'));
    }

    public function testObjectCanBeConvertedIntoJson()
    {
        $faker = Factory::create();
        $data = array (
            'mileage' => $faker->numberBetween(1, 999999),
            'quantity' => $faker->randomFloat(2, 0, 80),
            'unitPrice' => $faker->randomFloat(3, 0, 5),
        );
        $entry = new Entry($data);
        $expected = json_encode(array ('entry' => $data));

        $this->assertEquals($expected, $entry->toJson());
    }
}

class Stub extends ModelAbstract
{
    /**
     * @param array|\StdClass $data The data to populate this model class
     */
    public function populate($data)
    {
        // TODO: Implement populate() method.
    }

    /**
     * @return array Converting this model class into an array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

}