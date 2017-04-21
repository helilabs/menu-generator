<?php

namespace Helilabs\HeliMenuGenerator;

Class MenuContainer {
	/**
	 * This is a menu container that wrap menu items
	 * @var array
	 */
	public $menu;

	public $activeItem;

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

	public function isSubMenu( $isSub ){
		$this->isSub = $isSub;
		return $this;
	}

	public function getMenu( ){
		return $this->menu;
	}

	public function isEmpty(){
		return $this->menu->isEmpty();
	}

	public function generate( $id = null ){
		if( $this->menu->isEmpty() ){
    		return;
    	}

    	$menuItems = '';
    	foreach( $this->menu as $menuItem ){
    		$menuItems .= $menuItem->generate( $this->activeItem );
    	}

    	return view('Helilabs\HeliMenuGenerator::menu-container', [ 
    		'content' => $menuItems,
    		'id' => $id,
    		'isSub' => $this->isSub
    	])->render();
	}

}