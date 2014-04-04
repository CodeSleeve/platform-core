<?php namespace Codesleeve\Platform\Support;

use ArrayObject,  ArrayAccess, Countable, Iterator;

abstract class Collection implements ArrayAccess, Countable, Iterator
{
	/**
	 * Collection of items
	 *
	 * @var array
	 */
	protected $items;

	/**
	 * Create a new navigation object
	 *
	 */
	public function __construct($items = array())
	{
		$this->items = new ArrayObject;

		foreach ($items as $item)
		{
			$this->add($item);
		}
	}

	/**
	 * Get all the array items
	 *
	 * @return [type] [description]
	 */
	abstract public function all();

	/**
	 * Adds array items
	 *
	 * @param array $item [description]
	 */
	abstract public function add(array $item);

	/**
	 * Return the count of items for this navigator
	 *
	 * @return [type] [description]
	 */
	public function count()
	{
		return count($this->items);
	}

	/**
	 * [offsetExists description]
	 * @param  [type] $offset [description]
	 * @return [type]         [description]
	 */
	public function offsetExists($offset)
	{
		return isset($this->items[$offset]);
	}

	/**
	 * [offsetGet description]
	 * @param  [type] $offset [description]
	 * @return [type]         [description]
	 */
	public function offsetGet ($offset)
	{
		return isset($this->items[$offset]) ? $this->items[$offset] : null;
	}

	/**
	 * [offsetSet description]
	 * @param  [type] $offset [description]
	 * @param  [type] $value  [description]
	 * @return [type]         [description]
	 */
	public function offsetSet ($offset, $value)
	{
        if (is_null($offset))
        {
            $this->items[] = $value;
        }
        else
        {
            $this->items[$offset] = $value;
        }
	}

	/**
	 * [offsetUnset description]
	 * @param  [type] $offset [description]
	 * @return [type]         [description]
	 */
	public function offsetUnset($offset)
	{
		unset($this->items[$offset]);
	}

	/**
	 * [rewind description]
	 * @return [type] [description]
	 */
    public function rewind()
    {
        $this->cursor = 0;
    }

    /**
     * [current description]
     * @return [type] [description]
     */
    public function current()
    {
        return $this->items[$this->cursor];
    }

    /**
     * [key description]
     * @return [type] [description]
     */
    public function key()
    {
        return $this->cursor;
    }

    /**
     * [next description]
     * @return function [description]
     */
    public function next()
    {
        ++$this->cursor;
    }

    /**
     * [valid description]
     * @return [type] [description]
     */
    public function valid()
    {
        return isset($this->items[$this->cursor]);
    }

}