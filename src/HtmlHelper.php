<?php

namespace Helilabs\HeliMenuGenerator;

Class HtmlHelper{

    public static $instance = null;

    /**
	 * Html Options
	 * @var array
	 */
    public $options;

    /**
     * Get Instance of the called class
     * This function is the main code of Singeleton pattern implementation
     * @return calledClass $insance
     */
    public static function getInstance(){
    	$class = get_called_class();
    	if( !is_null( $class::$instance ) ){
    		return $class::$instance;
    	}

    	$class::$instance = new $class;
    	return $class::$instance;
    }

    /**
     * Generate Html options string as property=value
     * @return string    html options string
     */
	public function generateAttrs(){
		$attrsString = '';

		if(is_array($this->options)){
			foreach($this->options as $key=>$value){
				$attrsString .= ' '.$key.'="'.$value.'"';
			}
		}
		return $attrsString;
	}

	/**
	 * Set Html Options
	 * @param array $options Html options as property=>value
	 */
	public function setOptions( $options ){
		$this->options = $options;
		return $this;
	}

	/**
	 * $this will add a new item for options or extend an existing one
	 * using this function we can append to the
	 * @param  string $string Html Property
	 * @param  string $string value
	 * @return this         this
	 */
	public function pushOption( $property , $value ){
		if( isset( $this->options[ $property ] ) ){
			$this->options[$property] .=' '.$value;
			return $this;
		}

		$this->options[$property] = $value;
		return $this;
	}

	public function overrideOption( $property, $value ){
		$this->options[ $property ] = $value;
	}

	public function flush(){
		$class = get_called_class();
		return new $class;
	}

}