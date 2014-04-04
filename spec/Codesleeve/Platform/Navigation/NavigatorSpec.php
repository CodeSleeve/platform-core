<?php

namespace spec\Codesleeve\Platform\Navigation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NavigatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Platform\Navigation\Navigator');
    }

    function it_can_add_navigation_items()
    {
		$this->all()->shouldHaveCount(0);

		$this->add([ 'title' => 'Dashboard', 'icon' => 'fa-dashboard', 'url' => 'http://www.google.com', 'shown' => true, 'active' => 'dashboard', 'priority' => 0 ]);

		$this->all()->shouldHaveCount(1);
    }

    function it_cannot_add_a_navigation_item_without_a_title()
    {
    	$this->shouldThrow('InvalidArgumentException')->duringAdd([ 'icon' => 'fa-dashboard', 'url' => 'http://www.google.com', 'shown' => true, 'active' => 'dashboard', 'priority' => 0 ]);
    }

    function it_cannot_add_a_navigation_item_without_an_icon()
    {
    	$this->shouldThrow('InvalidArgumentException')->duringAdd([ 'title' => 'Dashboard', 'url' => 'http://www.google.com', 'shown' => true, 'active' => 'dashboard', 'priority' => 0 ]);
    }

    function it_cannot_add_a_navigation_item_without_a_url()
    {
    	$this->shouldThrow('InvalidArgumentException')->duringAdd([ 'title' => 'Dashboard', 'icon' => 'fa-dashboard', 'shown' => true, 'active' => 'dashboard', 'priority' => 0 ]);
    }

    function it_cannot_add_a_navigation_item_without_a_shown_flag()
    {
    	$this->shouldThrow('InvalidArgumentException')->duringAdd([ 'title' => 'Dashboard', 'icon' => 'fa-dashboard', 'url' => 'http://www.google.com', 'active' => 'dashboard', 'priority' => 0 ]);
    }

    function it_cannot_add_a_navigation_item_without_an_active_flag()
    {
    	$this->shouldThrow('InvalidArgumentException')->duringAdd([ 'title' => 'Dashboard', 'icon' => 'fa-dashboard', 'url' => 'http://www.google.com', 'shown' => true, 'priority' => 0 ]);
    }

    function it_can_list_navigation_items_in_alphabetical_order()
    {
		$this->add([ 'title' => 'Users', 'icon' => 'fa-users', 'url' => 'users.index', 'shown' => true, 'active' => 'users' ]);
		$this->add([ 'title' => 'Dashboard', 'icon' => 'fa-dashboard', 'url' => 'dashboard', 'shown' => true, 'active' => 'dashboard']);
		$this->add([ 'title' => 'Roles', 'icon' => 'fa-eye', 'url' => 'roles.index', 'shown' => true, 'active' => 'roles' ]);

		$items = $this->sort()->all();

		$items[0]->title->shouldBe('Dashboard');
		$items[1]->title->shouldBe('Roles');
		$items[2]->title->shouldBe('Users');
    }

    function it_can_prioritize_navigation_items_while_sorting()
    {
		$this->add([ 'title' => 'Users', 'icon' => 'fa-users', 'url' => 'users.index', 'shown' => true, 'active' => 'users' ]);
		$this->add([ 'title' => 'Dashboard', 'icon' => 'fa-dashboard', 'url' => 'dashboard', 'shown' => true, 'active' => 'dashboard']);
		$this->add([ 'title' => 'Roles', 'icon' => 'fa-eye', 'url' => 'roles.index', 'shown' => true, 'active' => 'roles', 'priority' => 99 ]);

		$items = $this->sort()->all();

		$items[0]->title->shouldBe('Roles');
		$items[1]->title->shouldBe('Dashboard');
		$items[2]->title->shouldBe('Users');
    }

}
