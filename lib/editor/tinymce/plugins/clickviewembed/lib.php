<?php

defined('MOODLE_INTERNAL') || die();

class tinymce_clickviewembed extends editor_tinymce_plugin {
	/** @var array list of buttons defined by this plugin */
	protected $buttons = array('clickviewembed');

	protected function update_init_params(array &$params, context $context,
	array $options = null) {
		global $OUTPUT;

		$this->add_button_after($params, 3, 'clickviewembed', 'table');

		$this->add_js_plugin($params);
	}
}