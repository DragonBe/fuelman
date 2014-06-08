<?php
namespace Fuelman\Object;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    public function goodDataProvider()
    {
        return array (
            array (
                array (
                    'firstName' => 'Matthew',
                    'lastName' => 'Weier O\'Phinney',
                    'email' => 'matthew@zend.com',
                    'vehicles' => array (
                        array (
                            'brand' => 'Toyota',
                            'type' => 'Corola',
                            'engineType' => 'Hybrid',
                            'fuel' => Vehicle::FUEL_SUPER,
                            'entries' => array (),
                        ),
                    ),
                ),
            ),
            array (
                array (
                    'firstName' => 'Keith',
                    'lastName' => 'Casey, JR.',
                    'email' => 'keith@caseysoftware.com',
                    'vehicles' => array (),
                ),
            ),
        );
    }

    /**
     * @dataProvider goodDataProvider
     */
    public function testPersonCanBePopulated($data)
    {
        $person = new Person($data);
        $this->assertEquals($data['firstName'], $person->getFirstName());
        $this->assertEquals($data['lastName'], $person->getLastName());
        $this->assertEquals($data['email'], $person->getEmail());

        $this->assertSame($data, $person->toArray());
        $this->assertCount(count($data['vehicles']), $person->getVehicles());
    }
}