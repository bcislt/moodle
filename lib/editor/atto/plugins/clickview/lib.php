<?php

defined('MOODLE_INTERNAL') || die();

function atto_clickview_params_for_js($elementid, $options, $fpoptions) {
	$params = array(
		'onlineUrl' => '//online.clickview.co.uk',
		'consumerKey' => 'c7dhen89fdjn',
		'schoolId' => 'ef98bbc2-9492-48c1-8113-b0d1a3ebbd7d',
		'allowIframe' => false
	);
	
	if (!empty($options['legacy']) or !empty($options['noclean']) or !empty($options['trusted'])) {
            $params['allowIframe'] = true;
        }
	
	return $params;
}