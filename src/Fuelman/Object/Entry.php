<?php
namespace Fuelman\Object;

use Fuelman\Object\Model\ModelAbstract;

class Entry extends ModelAbstract
{
    /**
     * @var int The current mileage
     */
    protected $_mileage;
    /**
     * @var float The quantity of fuel
     */
    protected $_quantity;
    /**
     * @var float The unit price of fuel
     */
    protected $_unitPrice;

    /**
     * @param int $mileage
     * @return Entry
     */
    public function setMileage($mileage)
    {
        $this->_mileage = $mileage;
        return $this;
    }

    /**
     * @return int
     */
    public function getMileage()
    {
        return $this->_mileage;
    }

    /**
     * @param float $quantity
     * @return Entry
     */
    public function setQuantity($quantity)
    {
        $this->_quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->_quantity;
    }

    /**
     * @param float $unitPrice
     * @return Entry
     */
    public function setUnitPrice($unitPrice)
    {
        $this->_unitPrice = $unitPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->_unitPrice;
    }

    /**
     * @param array|\StdClass $data The data to populate this model class
     */
    public function populate($data)
    {
        if (is_array($data)) {
            $data = new \ArrayObject($data, \ArrayObject::ARRAY_AS_PROPS);
        }
        $this->safeSet($data, 'mileage')
            ->safeSet($data, 'quantity')
            ->safeSet($data, 'unitPrice');
    }

    /**
     * @return array Converting this model class into an array
     */
    public function toArray()
    {
        return array (
            'mileage' => $this->getMileage(),
            'quantity' => $this->getQuantity(),
            'unitPrice' => $this->getUnitPrice(),
        );
    }

}