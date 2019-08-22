<?php

	unset($CFG_CLICKVIEW);

	$CFG_CLICKVIEW = new stdClass();
	$CFG_CLICKVIEW->onlineHost = "//online.clickview.co.uk";
	$CFG_CLICKVIEW->consumerKey = "c7dhen89fdjn";
	$CFG_CLICKVIEW->pluginFrameUrl = $CFG_CLICKVIEW->onlineHost."/v3/plugins/base?consumerKey=".$CFG_CLICKVIEW->consumerKey;