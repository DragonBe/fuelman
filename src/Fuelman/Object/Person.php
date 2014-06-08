<?php
namespace Fuelman\Object;

use Fuelman\Object\Model\ModelAbstract;
use Fuelman\Object\Model\ModelCollection;

class Person extends ModelAbstract
{
    /**
     * @var string The person's first name
     */
    protected $_firstName;
    /**
     * @var string The person's last name
     */
    protected $_lastName;
    /**
     * @var string The person's email address
     */
    protected $_email;

    /**
     * @var ModelCollection
     */
    protected $_vehicles;

    public function __construct($params = null)
    {
        $this->setVehicles(new ModelCollection());
        parent::__construct($params);
    }

    /**
     * @param string $firstName
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @param string $lastName
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param string $email
     * @return Person
     */
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param ModelCollection $vehicles
     * @return Person
     */
    public function setVehicles($vehicles)
    {
        $this->_vehicles = $vehicles;
        return $this;
    }

    /**
     * @return ModelCollection
     */
    public function getVehicles()
    {
        return $this->_vehicles;
    }

    /**
     * @param array|\StdClass $data The data to populate this model class
     */
    public function populate($data)
    {
        if (is_array($data)) {
            $data = new \ArrayObject($data, \ArrayObject::ARRAY_AS_PROPS);
        }
        $this->safeSet($data, 'firstName')
            ->safeSet($data, 'lastName')
            ->safeSet($data, 'email');

        if (isset ($data->vehicles)) {
            foreach ($data->vehicles as $vehicle) {
                $this->getVehicles()->add(new Vehicle($vehicle));
            }
        }
    }

    /**
     * @return array Converting this model class into an array
     */
    public function toArray()
    {
        return array (
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' => $this->getEmail(),
            'vehicles' => $this->getVehicles()->toArray(),
        );
    }
} 