(function () {
	tinymce.create('tinymce.plugins.ClickViewEmbed', {

		init : function (ed, url) {
			ed.addCommand('mceClickviewEmbed', function () {
				ed.windowManager.open({
					file : ed.getParam("moodle_plugin_base") + 'clickviewembed/dialog.php',
					width : 800,
					height : 494,
					inline : 1,
					resizable : false,
				}, {
					plugin_url : url,
				});
			});

			if (tinymce.settings.valid_elements && tinymce.settings.valid_elements.indexOf("*[*]") > -1) {
			    ed.addButton('clickviewembed', {
			        title: 'clickviewembed.desc', //Moodle Substitution
			        cmd: 'mceClickviewEmbed',
			        image: url + '/img/icon.png'
			    });
			}
		},

		getInfo : function () {
			return {
				longname : 'ClickView Video Inserter',
				author : 'ClickView Pty Ltd.',
				authorurl : 'http://clickview.com.au',
				infourl : 'http://clickview.com.au',
				version : "1.2"
			};
		}
	});

	tinymce.PluginManager.add('clickviewembed', tinymce.plugins.ClickViewEmbed);
})();
