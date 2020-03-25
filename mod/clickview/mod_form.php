<?php

	defined('MOODLE_INTERNAL') || die;

	require_once ($CFG->dirroot.'/course/moodleform_mod.php');

	class mod_clickview_mod_form extends moodleform_mod {

		// Validate that a clickview video has indeed been selected.
		function validate($values) {
			return isset($values['width']) && isset($values['height']) && isset($values['embedhtml']) && isset($values['autoplay']);
		}

		function definition() {
			global $CFG;
		
			// Add the ClickView Selector to the registered types in the Moodle Quick Form wrapper.
			MoodleQuickForm::registerElementType('clickview_selector', $CFG->dirroot."/mod/clickview/selector/clickview_selector.php", 'MoodleQuickForm_clickview_selector');

			$mform = $this->_form;
			
			$mform->addElement('html', '<script type="text/javascript" src="//az523909.vo.msecnd.net/cv-events-api/1.0.0/cv-events-api.min.js"></script>');
			$mform->addElement('html', '<script type="text/javascript" src="'.$CFG->wwwroot.'/mod/clickview/selector/js/dialog.js'.'" defer></script>');

			$mform->addElement('header', 'generalhdr', 'General');
			$mform->addElement('text', 'name', get_string('editor:title', 'clickview'), array('size' => 55));
			$mform->addRule('name', get_string('editor:required', 'clickview'), 'required');
			$mform->setType('name', PARAM_TEXT);

			$mform->addElement('clickview_selector', 'clickview', get_string('editor:selector', 'clickview'));
			$mform->addRule('clickview', get_string('editor:selectorerror', 'clickview'), 'required');
			$mform->addRule('clickview', get_string('editor:required', 'clickview'), 'callback', 'validate');

			$this->standard_coursemodule_elements();

			$this->add_action_buttons(true, false, null);
		}

	}
