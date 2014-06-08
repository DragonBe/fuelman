<?php
namespace Fuelman\Object\Model;

abstract class ModelAbstract implements ModelInterface
{
    /**
     * @param null $params
     */
    public function __construct($params = null)
    {
        if (null !== $params) {
            $this->populate($params);
        }
    }

    /**
     * @param \ArrayObject $row The data array object you want to parse
     * @param string $label The label for this specific key
     * @param null|string $method The method to set the value into the object
     * @return $this
     * @throws \RuntimeException
     */
    protected function safeSet($row, $label, $method = null)
    {
        if (null === $method) {
            $method = 'set' . ucfirst($label);
        }
        if (!method_exists($this, $method)) {
            throw new \RuntimeException('Invalid method defined');
        }
        if (isset ($row->$label)) {
            $this->$method($row->$label);
        }
        return $this;
    }

    /**
     * Converts this object into a JSON object
     *
     * @return string
     */
    public function toJson()
    {
        $class = strtolower(substr(get_class($this), strrpos(get_class($this), '\\') + 1));
        return json_encode(
            array (
                $class => $this->toArray()
            )
        );
    }
}