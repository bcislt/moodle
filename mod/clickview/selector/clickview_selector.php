<?php

global $CFG;

require_once($CFG->libdir.'/pear/HTML/QuickForm/element.php');

class MoodleQuickForm_clickview_selector extends HTML_QuickForm_element {

	private $_name;
	private $_values = array('width'=>null, 'height'=>null, 'autoplay'=>null, 'embedhtml'=>null, 'embedlink'=>null, 'thumbnailurl'=>null, 'title'=>null);

	function MoodleQuickForm_clickview_selector($elementName=null, $elementLabel=null, $attributes=null, $options=null) {
		parent::HTML_QuickForm_element($elementName, $elementLabel, $attributes);
	}

	function getFrozenHtml() {
		return '';
	}

	function setName($name) {
		$this->_name = $name;
	}

	function getName() {
		return $this->_name;
	}

	function setValue($values) {
		$values = (array)$values;
		foreach ($values as $name=>$value) {
			if (array_key_exists($name, $this->_values)) {
				$this->_values[$name] = $value;
			}
		}
	}

	function getValue() {
		return $this->_values;
	}

	function toHtml() {
		require_once(dirname(dirname(__FILE__)).'/cv-config.php');
		require_once(dirname(dirname(__FILE__)).'/schoolId.php');
		
		$elname = $this->getName();

		$param = '';

		if(! empty($SCHOOL_ID)) {
			$param = '&schoolId=' . $SCHOOL_ID->value;
		}
		
		$str = 	'<div style="max-height: 494px; overflow: hidden;">'.
			'<div '.
			'style="position: relative;'.
			' width: 100%;'.
			' height: 0px;'.
			' padding-bottom: 61.8%;'.
			' min-width: 500px;'.
			' max-width: 800px;">'.
					'<iframe id="cv-plugin-frame" frameborder="0" src="'.$CFG_CLICKVIEW->pluginFrameUrl.'&singleSelectMode=true'.$param.'"'.
						' style="position: absolute;'.
						' left: 0px;'.
						' top: 0px;'.
						' width: 100%;'.
						' height: 100%;'.
						' max-height: 494px;'.
						' min-width: 500px;'.
						' max-width: 800px;"></iframe>'.
			'</div></div>'.
			'<input name="'.$elname.'[width]"        id="cv-width" type="text" style="display: none;" />'.
			'<input name="'.$elname.'[height]"       id="cv-height" type="text" style="display: none;" />'.
			'<input name="'.$elname.'[embedhtml]"    id="cv-embedhtml" type="text" style="display: none;" />'.
			'<input name="'.$elname.'[embedlink]"    id="cv-embedlink" type="text" style="display: none;" />'.
			'<input name="'.$elname.'[thumbnailurl]" id="cv-thumbnailurl" type="text" style="display: none;" />'.
			'<input name="'.$elname.'[title]"        id="cv-title" type="text" style="display: none;" />'.
			'<input name="'.$elname.'[autoplay]"     id="cv-autoplay" type="text" style="display: none;" />'.
			'<input name="'.$elname.'[logging]"      id="cv-logging" type="text" style="display: none;" />'.
			'<input name="'.$elname.'[onlineurl]"    id="cv-logging-onlineurl" type="text" style="display: none;" />'.
			'<input name="'.$elname.'[eventname]"    id="cv-logging-eventname" type="text" style="display: none;" />';

		return $str;
	}
}
