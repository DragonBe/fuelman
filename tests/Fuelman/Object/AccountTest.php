<?php
namespace Fuelman\Object;

class AccountTest extends \PHPUnit_Framework_TestCase
{
    public function testAccountCanStorePersonWithVehicles()
    {
        $vehicleData = array (
            'brand' => 'Maserati',
            'type' => 'Ghibli',
            'engineType' => 'Twin turbo v6 3.0L',
            'fuel' => Vehicle::FUEL_SUPER,
            'entries' => array (),
        );
        $personData = array (
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'vehicles' => array ($vehicleData),
        );
        $account = new Account(
            array (
                'persons' => array ($personData)
            )
        );

        $this->assertCount(1, $account->getPersons());
        $this->assertCount(1, $account->getPersons()->current()->getVehicles());
        $this->assertEquals(array($personData), $account->getPersons()->toArray());
        $this->assertEquals(array('persons' => $personData), $account->toArray());
    }
}