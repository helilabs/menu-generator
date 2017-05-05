<?php

namespace Helilabs\HeliMenuGenerator;

Class MenuContainer extends HtmlHelper{
	/**
	 * This is a menu container that wrap menu items
	 * @var array
	 */
	public $menu;

	public $activeItem;

	/**
	 * Html Options
	 * @var array
	 */
	public $options = [
		'class' => 'nav'
	];

	/**
	 * is this menu Container a sub menu
	 * @var bool
	 */
	public $isSub = false ;

	public function __construct(){
		$this->menu = collect([]);
	}

	public function addItem( MenuItem $menuItem ){
		$this->menu->push( $menuItem );
		return $this;
	}

	public function setActiveMenuItem( $activeItem ){
		$this->activeItem = $activeItem;
		return $this;
	}

	/**
	 * is this menu is a submenu of main menu
	 * @param  boolean  $isSub set if is this menu is a submenu of main menu
	 * @return this;
	 */
	public function isSubMenu( $isSub ){
		$this->isSub = $isSub;
		return $this;
	}

	public function getMenu(){
		return $this->menu;
	}

	/**
	 * is this menu is Empty and has no menuItems
	 * @return boolean
	 */
	public function isEmpty(){
		return $this->menu->isEmpty();
	}

	/**
	 * Generate the menu
	 * @return View
	 */
	public function generate( ){
		if( $this->menu->isEmpty() ){
    		return;
    	}

    	$menuItems = '';
    	foreach( $this->menu as $menuItem ){
    		$menuItems .= $menuItem->generate( $this->activeItem );
    	}

    	if( $this->isSub ){
    		$this->pushOption('class', 'collapse');
    	}

    	return view('Helilabs\HeliMenuGenerator::menu-container', [ 
    		'content' => $menuItems,
    		'options' => $this->generateAttrs(),
    	])->render();
	}

}