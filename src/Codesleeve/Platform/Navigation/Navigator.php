<?php namespace Codesleeve\Platform\Navigation;

use ArrayObject, StdClass, InvalidArgumentException;
use Codesleeve\Platform\Support\Collection;

class Navigator extends Collection
{
	/**
	 * List of required fields
	 *
	 * @var array
	 */
	protected $required = array('title', 'icon', 'url', 'shown', 'active');

	/**
	 * Return all the navigation items
	 *
	 * @return $this
	 */
	public function all()
	{
		$this->sort();

		return $this->items;
	}

	/**
	 * Add a new item to the navigation stack
	 *
	 * @param array $item
	 */
	public function add(array $item)
	{
		$this->validate($item);

		$obj = new StdClass;

		foreach ($item as $attr => $value)
		{
			$obj->$attr = $value;
		}

		$this->items[] = $obj;
	}

	/**
	 * Make Navigation Items Sortable
	 *
	 * @param  string $order [description]
	 * @return [type]        [description]
	 */
	public function sort()
	{
    	$this->items->uasort(function($obj1, $obj2)
    	{
    		$title1 = $obj1->title;
    		$title2 = $obj2->title;

    		$priority1 = isset($obj1->priority) ? $obj1->priority : 0;
    		$priority2 = isset($obj2->priority) ? $obj2->priority : 0;

    		if ($priority1 < $priority2)
    		{
    			return 1;
    		}

    		if ($priority1 > $priority2)
    		{
    			return -1;
    		}

			if ($title1 === $title2)
			{
        		return 0;
    		}

    		if ($title1 < $title2)
    		{
    			return -1;
    		}

    		// ($title1 > $title2)
    		return 1;
    	});

    	// since we want to update the indexes (0, 1, 2) then
    	// we need to loop through and append to a new ArrayObject

    	$sorted = new ArrayObject();

    	foreach ($this->items as $item)
    	{
    		$sorted[] = $item;
    	}

    	$this->items = $sorted;

		return $this;
	}

	/**
	 * Ensure that all these elements are in the $item
	 *
	 * @param  array $item
	 * @return void
	 */
	private function validate($item)
	{
		$titleSelector = count($this->required) > 0 ? $this->required[0] : null;

		foreach ($this->required as $attribute)
		{
			if (!array_key_exists($attribute, $item))
			{
				$title = isset($item[$titleSelector]) ? $item[$titleSelector] : 'Unknown';

				throw new InvalidArgumentException("The required attribute $attribute was not found for navigation item $title!");
			}
		}
	}


}