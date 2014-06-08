<?php
namespace Fuelman\Object;

use Faker\Factory;

class VehicleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Faker\Generator
     */
    protected $_faker;

    protected function setUp()
    {
        parent::setUp();
        $this->_faker = Factory::create();
        $this->_faker->seed(123);
    }
    protected function tearDown()
    {
        $this->_faker = null;
        parent::tearDown();
    }

    public function goodDataProvider()
    {
        $this->_faker = Factory::create();
        return array (
            array (
                array (
                    'brand' => 'Volkswagen',
                    'type' => 'Tiguan',
                    'engineType' => '2L TDi',
                    'fuel' => Vehicle::FUEL_DIESEL,
                    'entries' => array (
                        array (
                            'mileage' => $this->_faker->numberBetween(1, 999999),
                            'quantity' => $this->_faker->randomFloat(2, 0, 80),
                            'unitPrice' => $this->_faker->randomFloat(3, 0, 5),
                        ),
                        array (
                            'mileage' => $this->_faker->numberBetween(1, 999999),
                            'quantity' => $this->_faker->randomFloat(2, 0, 80),
                            'unitPrice' => $this->_faker->randomFloat(3, 0, 5),
                        ),
                    ),
                ),
            ),
            array (
                array (
                    'brand' => 'Peugeot',
                    'type' => '307',
                    'engineType' => '900',
                    'fuel' => Vehicle::FUEL_SUPER,
                    'entries' => array (
                        array (
                            'mileage' => $this->_faker->numberBetween(1, 999999),
                            'quantity' => $this->_faker->randomFloat(2, 0, 80),
                            'unitPrice' => $this->_faker->randomFloat(3, 0, 5),
                        ),
                    ),
                ),
            )
        );
    }

    public function testConfigureNewVehicle()
    {
        $data = array (
            'brand' => 'Volkswagen',
            'type' => 'Tiguan',
            'engineType' => '2L TDi',
            'fuel' => Vehicle::FUEL_DIESEL,
            'entries' => array (),
        );
        $vehicle = new Vehicle($data);
        $this->assertEquals($data, $vehicle->toArray());
    }

    /**
     * @dataProvider goodDataProvider
     * @depends testConfigureNewVehicle
     */
    public function testConfigureNewVehicleWithData($data)
    {
        $vehicle = new Vehicle($data);

        $this->assertEquals($data['brand'], $vehicle->getBrand(),
            'Brand data contains different data');
        $this->assertEquals($data['type'], $vehicle->getType(),
            'Type data contains different data');
        $this->assertEquals($data['engineType'], $vehicle->getEngineType(),
            'EngineType contains different data');
        $this->assertEquals($data['fuel'], $vehicle->getFuel(),
            'Fuel data contains different data');

        $this->assertSame($data, $vehicle->toArray(),
            'Something went wrong populating this class');
    }
}