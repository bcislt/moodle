<?php

	require_once('../../config.php');

	require_once('./cv-config.php');

	$id = required_param('id', PARAM_INT);    // Course Module ID

	global $CFG;
	global $CFG_CLICKVIEW;

	if (!$cm = get_coursemodule_from_id('clickview', $id)) {
		print_error('Course Module ID was incorrect');
	}
	if (!$course = $DB->get_record('course', array('id'=> $cm->course))) {
		print_error('Course is misconfigured');
	}
	if (!$cv_vid = $DB->get_record('clickview', array('id'=> $cm->instance))) {
		print_error('Course module is incorrect');
	}
	require_login($course, true, $cm);

	$PAGE->set_url('/mod/clickview/view.php', array('id' => $cm->id));

	$PAGE->set_title($cv_vid->name);
	$PAGE->set_heading(format_string($course->fullname));

	echo $OUTPUT->header();

	if(!(is_numeric($cv_vid->width) || is_numeric($cv_vid->height))) {
		print_error("This ClickView Resource has invalid fields in the moodle database.");
	}

	$autoplay = $cv_vid->autoplay === '1' ? 'true' : 'false';
	if(isset($cv_vid->embedhtml) && $cv_vid->embedhtml != '0'){
			$embed_box = '<div id="cv-player" data-test="true">'.$cv_vid->embedhtml.'</div>';
	} else {
			$embed_box = '<div id="cv-player" data-test="false"><iframe frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen src="'.$CFG_CLICKVIEW->onlineHost.'/Share/PlayEmbed?shareCode='.$cv_vid->shortcode.'&a='.$autoplay.'&consumerKey='.$CFG_CLICKVIEW->consumerKey.'" width="'.$cv_vid->width.'" height="'.$cv_vid->height.'" ></iframe></div>';
	}

	echo $OUTPUT->box($embed_box);

	echo $OUTPUT->footer($course);
