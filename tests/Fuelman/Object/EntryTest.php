<?php
namespace Fuelman\Object;

class EntryTest extends \PHPUnit_Framework_TestCase
{
    protected $_faker;

    protected function setUp()
    {
        parent::setUp();
        $this->_faker = \Faker\Factory::create();
    }

    protected function tearDown()
    {
        $this->_faker = null;
        parent::tearDown();
    }
    public function testCanAddEntry()
    {
        $entry = array (
            'mileage' => $this->_faker->numberBetween(1, 999999),
            'quantity' => $this->_faker->randomFloat(2, 0, 80),
            'unitPrice' => $this->_faker->randomFloat(3, 0, 5),
        );
        $vehicle = new Vehicle();
        $vehicle->getEntries()->add(new Entry($entry));

        $this->assertEquals($entry, $vehicle->getEntries()->current()->toArray());
    }
}