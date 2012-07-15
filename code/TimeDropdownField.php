<?php
require_once 'Zend/Date.php';

class TimeDropdownField extends TimeField {
	
	static $default_config = array(
		'interval' => Zend_Date::HOUR
	);
	
	function __construct($name, $title = null, $value = ""){
		parent::__construct($name, $title, $value);
		
		$this->config += self::$default_config;
	}
	
	/**
	 * @todo This should be generated by JavaScript, but we don't have the date libraries'
	 */
	function Field() {
		$this->addExtraClass('timedropdownfield');
		
		$html = parent::Field();
		
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		Requirements::javascript('timedropdownfield/thirdparty/jquery-entwine/jquery.entwine-dist.js');
		Requirements::javascript('timedropdownfield/javascript/TimeDropdownField.js');
		Requirements::css('timedropdownfield/javascript/TimeDropdownField.css');
		
		$iteratedTime = new Zend_Date('00:00:00', 'h:mm:ss');
		$options = array();
		for($i=0; $i<24; $i++) {
			$key = $iteratedTime->toString($this->getConfig('datavalueformat'));
			$options[$key] = $iteratedTime->toString($this->getConfig('timeformat'));
			$iteratedTime->add(1, $this->config['interval']);
		}
		$dropdownField = new DropdownField($this->Name() . '_dropdown', false, $options, $this->Value());
		$dropdownField->addExtraClass('presets');
		$dropdownField->setHasEmptyDefault(true);
		$dropdownField->setForm($this->getForm());
		$html .= $dropdownField->Field();
		
		$html .= '<a href="#" class="presets-trigger"></a>';
		
		return $html;
	}
	
}