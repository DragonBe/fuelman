<?php
namespace Fuelman\Object\Model;

interface ModelInterface
{
    /**
     * @param null|array|StdClass $params The data you want to use in this model class
     */
    public function __construct($params = null);

    /**
     * @param array|\StdClass $data The data to populate this model class
     */
    public function populate($data);

    /**
     * @return array Converting this model class into an array
     */
    public function toArray();

    /**
     * @return string Converting this model class into a JSON object
     */
    public function toJson();
}