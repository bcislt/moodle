(function () {
	var ClickviewEmbedDialog = {
		init : function () {
			var pluginFrame = document.getElementById('cv-plugin-frame')
			var eventsApi = new CVEventsApi(pluginFrame.contentWindow);
			eventsApi.on('cv-lms-addvideo', function (event, detail) {
				tinyMCEPopup.editor.execCommand("mceInsertRawHTML", false, detail.embedHtml);
				tinyMCEPopup.close();
			}, true);
		}
	};

	tinyMCEPopup.onInit.add(ClickviewEmbedDialog.init, ClickviewEmbedDialog);
})();
