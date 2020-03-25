<?php

class backup_clickview_activity_structure_step extends backup_activity_structure_step {
    protected function define_structure() {
      
      $clickview = new backup_nested_element('clickview', array('id'), array(          
        'course', 'name', 'height', 'width', 'autoplay', 'embedhtml', 'embedlink', 'thumbnailurl', 'title', 'shortcode'));

      $clickview->set_source_table('clickview', array('id' => backup::VAR_ACTIVITYID));

      return $this->prepare_activity_structure($clickview);
    }
}