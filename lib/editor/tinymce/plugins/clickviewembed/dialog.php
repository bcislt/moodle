<?php

	define('NO_MOODLE_COOKIES', true); // Session not used here.

	require(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/config.php');
	require('./cv-config.php');

	$PAGE->set_context(context_system::instance());
	$PAGE->set_url('/lib/editor/tinymce/plugins/clickviewembed/dialog.php');

	$editor = get_texteditor('tinymce');
	$plugin = $editor->get_plugin('clickviewembed');
	$htmllang = get_html_lang();

	header('Content-Type: text/html; charset=utf-8');
	header('X-UA-Compatible: IE=edge');
?>
<!DOCTYPE html>
<html <?php echo $htmllang ?> >
	<head>
		<title><?php print_string('clickviewembed:desc', 'tinymce_clickviewembed'); ?></title>
		<script type="text/javascript" src="<?php echo $editor->get_tinymce_base_url(); ?>/tiny_mce_popup.js"></script>
		<script type="text/javascript" src="//az523909.vo.msecnd.net/cv-events-api/1.0.0/cv-events-api.min.js"></script>
		<script type="text/javascript" src="<?php echo $plugin->get_tinymce_file_url('js/dialog.js'); ?>" ></script>
	</head>
	<body>
		<iframe frameborder="0" id="cv-plugin-frame" src="<?php echo $CFG_CLICKVIEW->pluginFrameUrl; ?>" width="100%" height="474" ><iframe>
	</body>
</html>
