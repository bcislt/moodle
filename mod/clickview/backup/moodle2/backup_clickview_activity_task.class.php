<?php

require_once($CFG->dirroot . '/mod/clickview/backup/moodle2/backup_clickview_stepslib.php');

class backup_clickview_activity_task extends backup_activity_task {
  protected function define_my_settings() { }

  protected function define_my_steps() {
    $this->add_step(new backup_clickview_activity_structure_step('clickview_structure', 'clickview.xml'));
  }

  static public function encode_content_links($content) {
      return $content;
  }
}