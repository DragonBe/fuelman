<?php
namespace Fuelman\Object;

use Fuelman\Object\Model\ModelAbstract;
use Fuelman\Object\Model\ModelCollection;

class Vehicle extends ModelAbstract
{
    const FUEL_SUPER = 'Super';
    const FUEL_DIESEL = 'Diesel';
    const FUEL_GAS = 'Gas';

    /**
     * @var string The brand of vehicle
     */
    protected $_brand;
    /**
     * @var string The type of vehicle
     */
    protected $_type;
    /**
     * @var string The engine type and size
     */
    protected $_engineType;
    /**
     * @var string The type of fuel
     */
    protected $_fuel;
    /**
     * @var ModelCollection
     */
    protected $_entries;

    /**
     * @param null|array|\StdClass $params
     */
    public function __construct($params = null)
    {
        $this->setEntries(new ModelCollection());
        parent::__construct($params);
    }

    /**
     * @param string $brand
     * @return Vehicle
     */
    public function setBrand($brand)
    {
        $this->_brand = $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->_brand;
    }

    /**
     * @param string $type
     * @return Vehicle
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param string $engineType
     * @return Vehicle
     */
    public function setEngineType($engineType)
    {
        $this->_engineType = $engineType;
        return $this;
    }

    /**
     * @return string
     */
    public function getEngineType()
    {
        return $this->_engineType;
    }

    /**
     * @param string $fuel
     * @return Vehicle
     */
    public function setFuel($fuel)
    {
        $this->_fuel = $fuel;
        return $this;
    }

    /**
     * @return string
     */
    public function getFuel()
    {
        return $this->_fuel;
    }

    /**
     * @param \Fuelman\Object\Model\ModelCollection $entries
     */
    public function setEntries($entries)
    {
        $this->_entries = $entries;
    }

    /**
     * @return \Fuelman\Object\Model\ModelCollection
     */
    public function getEntries()
    {
        return $this->_entries;
    }


    public function populate($data)
    {
        if (is_array ($data)) {
            $data = new \ArrayObject($data, \ArrayObject::ARRAY_AS_PROPS);
        }
        $this->safeSet($data, 'brand')
            ->safeSet($data, 'type')
            ->safeSet($data, 'engineType')
            ->safeSet($data, 'fuel');

        if (isset ($data->entries)) {
            foreach ($data->entries as $entry) {
                $this->getEntries()->add(new Entry($entry));
            }
        }
    }
    public function toArray()
    {
        return array (
            'brand' => $this->getBrand(),
            'type' => $this->getType(),
            'engineType' => $this->getEngineType(),
            'fuel' => $this->getFuel(),
            'entries' => $this->getEntries()->toArray(),
        );
    }
}