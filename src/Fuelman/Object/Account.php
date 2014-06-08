<?php
namespace Fuelman\Object;

use Fuelman\Object\Model\ModelAbstract;
use Fuelman\Object\Model\ModelCollection;

class Account extends ModelAbstract
{
    /**
     * @var ModelCollection
     */
    protected $_persons;

    /**
     * @param null|array|\StdClass $params
     */
    public function __construct($params = null)
    {
        $this->setPersons(new ModelCollection());
        parent::__construct($params);
    }

    /**
     * @param ModelCollection $persons
     * @return Account
     */
    public function setPersons($persons)
    {
        $this->_persons = $persons;
        return $this;
    }

    /**
     * @return ModelCollection
     */
    public function getPersons()
    {
        return $this->_persons;
    }
    /**
     * @param array|\StdClass $data The data to populate this model class
     */
    public function populate($data)
    {
        if (is_array($data)) {
            $data = new \ArrayObject($data, \ArrayObject::ARRAY_AS_PROPS);
        }
        if (isset ($data->persons)) {
            foreach ($data->persons as $person) {
                $this->getPersons()->add(new Person($person));
            }
        }
    }

    /**
     * @return array Converting this model class into an array
     */
    public function toArray()
    {
        return array (
            'persons' => $this->getPersons()->current()->toArray(),
        );
    }

}