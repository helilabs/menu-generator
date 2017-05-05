<?php

namespace Helilabs\HeliMenuGenerator;

/**
 * Menu Parser
 */
Class Menu extends HtmlHelper{

    /**
     * The active item of the menu
     * @var string
     */
    public $activeMenuItem;

    /**
     * Top Menu Options
     * @var array
     */
    public $options = [
        'class' => 'nav'
    ];


    /**
     * MenuItemCommonOption
     * @var  array
     */
    public $menuItemOptions;

    public function setActiveMenuItem( $activeMenuItem ){
        $this->activeMenuItem = $activeMenuItem;
        return $this;
    }

    public function setMenuItemOptions( $menuItemOptions ){
        $this->menuItemOptions = $menuItemOptions;
        return $this;
    }

    public function parse( $menu ){
        return $this->generateMenu( $menu )->generate();
    }

    public function generateMenu( $menu ,$isSubMenu = false){
        $menuContainer = (new MenuContainer())
                            ->setOptions( $this->options )
                            ->setActiveMenuItem($this->activeMenuItem)
                            ->isSubMenu( $isSubMenu );

        foreach( $menu as $key => $item ){
            $menuItem = $this->generateMenuItem( $key, $item );
            $menuContainer->addItem( $menuItem );
        }

        return $menuContainer;
    }

    public function generateMenuItem($key, $menuItemMeta){
        $menuItem = new MenuItem($key, $menuItemMeta['text'], $menuItemMeta['url'], '<i class="'.$menuItemMeta['icon'].'"></i>');
        $menuItem->setOptions( $this->menuItemOptions );

        if( isset( $menuItemMeta['children'] ) ){
            $menu = $this->generateMenu( $menuItemMeta['children'] , true);
            $menuItem->setSubMenu( $menu );
        }

        return $menuItem;
    }
	
}