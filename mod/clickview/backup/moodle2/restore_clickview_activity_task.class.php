<?php

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot . '/mod/clickview/backup/moodle2/restore_clickview_stepslib.php'); // Because it exists (must)

class restore_clickview_activity_task extends restore_activity_task {
    protected function define_my_settings() { }
    
    protected function define_my_steps() {
        $this->add_step(new restore_clickview_activity_structure_step('clickview_structure', 'clickview.xml'));
    }

    static public function define_decode_contents() {
        $contents = array();
        return $contents;
    }

    static public function define_decode_rules() {
        $rules = array();
        $rules[] = new restore_decode_rule('CLICKVIEWVIEWBYID', '/mod/clickview/view.php?id=$1', 'course_module');
        $rules[] = new restore_decode_rule('CLICKVIEWINDEX', '/mod/clickview/index.php?id=$1', 'course');
        return $rules;
    }

    static public function define_restore_log_rules() { }

    static public function define_restore_log_rules_for_course() { }
}