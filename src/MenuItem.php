<?php

namespace Helilabs\HeliMenuGenerator;

Class MenuItem{

	/**
	 * Menu Item Key
	 * @var a unique id for the menu item
	 */
	public $key;
	

	/**
	 * Menu Item Text
	 * @var string
	 */
	public $text;

	/**
	 * Menu Item Url
	 * @var string
	 */
	public $url;

	/**
	 * Menu Icon
	 * @var string
	 */
	public $icon;

	/**
	 * a sub menu
	 * @var MenuContainer
	 */
	public $innerMenu;

	public function __construct( $key, $text, $url, $icon ){
		$this->key = $key;
		$this->text = $text;
		$this->url = $url;
		$this->icon = $icon;
	}

    /**
     * Gets the Menu Item Key.
     *
     * @return a unique id for the menu item
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets the Menu Item Key.
     *
     * @param a unique id for the menu item $key the key
     *
     * @return self
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Gets the Menu Item Text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the Menu Item Text.
     *
     * @param string $text the text
     *
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Gets the Menu Item Url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the Menu Item Url.
     *
     * @param string $url the url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Gets the Menu Icon.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the Menu Icon.
     *
     * @param string $icon the icon
     *
     * @return self
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Gets the a sub menu.
     *
     * @return MenuContainer
     */
    public function getInnerMenu()
    {
        return $this->innerMenu;
    }

    /**
     * Sets the a sub menu.
     *
     * @param MenuContainer $innerMenu the inner menu
     *
     * @return self
     */
    public function setSubMenu(MenuContainer $innerMenu)
    {
        $this->innerMenu = $innerMenu;

        return $this;
    }

    /**
     * @return boolean whether menu has Children or not
     */
    public function hasChildren(){
    	return $this->innerMenu && !$this->innerMenu->isEmpty();
    }

    /**
     * Excute inner Menu Generate Function
     */
    public function GenerateInnerMenu( $currentActiveItem ){
    	if( !$this->innerMenu ){
    		return;
    	}

    	return $this->innerMenu->setActiveMenuItem( $currentActiveItem )->generate( $this->key );
    }

    public function isActive( $currentActiveItem ){
    	$currentActiveItem = explode('.', $currentActiveItem);
    	if( count( $currentActiveItem ) == 2 && $this->hasChildren() || count( $currentActiveItem ) == 1 ){
    		return $currentActiveItem[0] == $this->key;
    	}

		return $currentActiveItem[1] == $this->key;
    }

    public function generate( $currentActiveMenu ){

    	return view('Helilabs\HeliMenuGenerator::menu-item',[
    		'isActive' => $this->isActive( $currentActiveMenu ),
    		'key' => $this->key,
    		'text' => $this->text,
    		'icon' => $this->icon,
    		'url' => $this->url,
    		'hasChildren' => $this->hasChildren(),
    		'innerMenu' => $this->GenerateInnerMenu( $currentActiveMenu )
    	])->render();
    }
}