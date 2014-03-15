<?php namespace Codesleeve\Platform\Navigation;

use Config, ArrayObject, StdClass, InvalidArgumentException;

class Navigator extends ArrayObject
{
	/**
	 * Create a new navigation object
	 *
	 */
	public function __construct($items = array())
	{
		foreach ($items as $item)
		{
			$this->add($item);
		}
	}

	/**
	 * Return all the navigation items
	 *
	 * @return $this
	 */
	public function all()
	{
		return $this;
	}

	/**
	 * Add a new item to the navigation stack
	 *
	 * @param array $item
	 */
	public function add($item)
	{
		$this->validate($item);

		$obj = new StdClass;

		foreach ($item as $attr => $value)
		{
			$obj->$attr = $value;
		}

		$this[] = $obj;
	}

	/**
	 * Ensure that all these elements are in the $item
	 *
	 * @param  array $item
	 * @return void
	 */
	private function validate($item)
	{
		$required = array('title', 'icon', 'url', 'shown', 'active');

		foreach ($required as $attribute)
		{
			if (!array_key_exists($attribute, $item))
			{
				$title = isset($item['title']) ? $item['title'] : 'Unknown';
				throw new InvalidArgumentException("The required attribute $attribute was not found for navigation item $title!");
			}
		}
	}
}