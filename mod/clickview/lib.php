<?php

	defined('MOODLE_INTERNAL') || die();
	
	
	function log_embed($params)
	{
		$data = new stdClass();
		$data->e = $params->eventname;
		$data->d = $params->logging;
		
		foreach ($data as $key => &$val) {
		if (is_array($val)) $val = implode(',', $val);
			$post_params[] = $key.'='.urlencode($val);
		}
		$post_string = implode('&', $post_params);
	
		$parts=parse_url($params->onlineurl);
		
		$fp = fsockopen($parts['host'],
			isset($parts['port'])?$parts['port']:80,
			$errno, $errstr, 30);
	
		$out = "GET ".$parts['path']." HTTP/1.1\r\n";
		$out.= "Host: ".$parts['host']."\r\n";
		$out.= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out.= "Content-Length: ".strlen($post_string)."\r\n";
		$out.= "Connection: Close\r\n\r\n";
		if (isset($post_string)) $out.= $post_string;
	
		fwrite($fp, $out);
		fclose($fp);
	}

	function clickview_add_instance($clickview)
	{
		global $DB;

		$clickview->width = $clickview->clickview['width'];
		$clickview->height = $clickview->clickview['height'];
		$clickview->autoplay = $clickview->clickview['autoplay'];
		$clickview->embedlink = $clickview->clickview['embedlink'];
		$clickview->embedhtml = $clickview->clickview['embedhtml'];
		$clickview->thumbnailurl = $clickview->clickview['thumbnailurl'];
		$clickview->title = $clickview->clickview['title'];
		$clickview->logging = $clickview->clickview['logging'];
		$clickview->onlineurl = $clickview->clickview['onlineurl'];
		$clickview->eventname = $clickview->clickview['eventname'];
		
		$clickview->timemodified = time();
		
		$result = $DB->insert_record('clickview', $clickview);
		
		try
		{
			log_embed($clickview);
		}
		catch(Exception $e)
		{
		}
		
		return $result;
	}

	function clickview_update_instance($clickview)
	{
		global $DB;
		
		$clickview->width = $clickview->clickview['width'];
		$clickview->height = $clickview->clickview['height'];
		$clickview->autoplay = $clickview->clickview['autoplay'];
		$clickview->embedlink = $clickview->clickview['embedlink'];
		$clickview->embedhtml = $clickview->clickview['embedhtml'];
		$clickview->thumbnailurl = $clickview->clickview['thumbnailurl'];
		$clickview->title = $clickview->clickview['title'];
		
		$clickview->timemodified = time();
		
		$clickview->id = $clickview->instance;

		return $DB->update_record('clickview', $clickview);
	}

	function clickview_delete_instance($id)
	{
		global $DB;

		if (! $clickview = $DB->get_record("clickview", array("id"=>$id))) {
			return false;
		}

		$result = true;

		if (! $DB->delete_records("clickview", array("id"=>$clickview->id))) {
			$result = false;
		}

		return $result;
	}

	function clickview_supports($feature) {
		switch($feature) {
			case FEATURE_MOD_ARCHETYPE: return MOD_ARCHETYPE_RESOURCE;
			case FEATURE_MOD_INTRO: return false;
			case FEATURE_BACKUP_MOODLE2: return true;
			default: return null;
		}
	}