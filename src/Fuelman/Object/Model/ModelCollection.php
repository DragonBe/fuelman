<?php
namespace Fuelman\Object\Model;

class ModelCollection implements \Countable, \SeekableIterator
{
    protected $_stack = array ();
    protected $_position = 0;
    protected $_count = 0;

    /**
     * Adds an entity to the collection
     *
     * @param mixed $entity
     */
    public function add($entity)
    {
        $this->_stack[] = $entity;
        $this->_count++;
    }

    /**
     * Set an existing array as collection object
     *
     * @param array $entities
     * @throws \InvalidArgumentException
     */
    public function set($entities)
    {
        if (!is_array($entities)) {
            throw new \InvalidArgumentException('Requiring an array to be provided');
        }
        foreach ($entities as $entity) {
            $this->add($entity);
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->_stack[$this->_position];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->_position++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->_position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset ($this->_stack[$this->_position]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->_position = 0;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return $this->_count;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Seeks to a position
     * @link http://php.net/manual/en/seekableiterator.seek.php
     * @param int $position <p>
     * The position to seek to.
     * </p>
     * @return void
     */
    public function seek($position)
    {
        $this->_position = $position;
    }

    /**
     * @return array The arrayification of the collection entities
     */
    public function toArray()
    {
        $array = array ();
        foreach ($this->_stack as $entity) {
            if (is_object($entity) && method_exists($entity, 'toArray')) {
                $array[] = $entity->toArray();
            }
        }
        return $array;
    }
}