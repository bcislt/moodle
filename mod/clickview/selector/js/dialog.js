(function () {
	var displayTitle = document.getElementById('id_name'),
		pluginFrame = document.getElementById('cv-plugin-frame'),
		eventsApi = new CVEventsApi(pluginFrame.contentWindow),
		userSetTitle = false;
		
	if(displayTitle) {
		displayTitle.onkeyup = function (e) {
			if(e.target.value) {
				userSetTitle = true;
				return;
			}
			
			userSetTitle = false;
		};
	}
		
	eventsApi.on('cv-lms-addvideo', function (event, detail) {
		document.getElementById('cv-width').value = detail.embed.width;
		document.getElementById('cv-height').value = detail.embed.height;
		document.getElementById('cv-autoplay').value = (detail.embed.autoplay ? '1' : '0');
		document.getElementById('cv-embedhtml').value = detail.embedHtml;
		document.getElementById('cv-embedlink').value = detail.embedLink;
		document.getElementById('cv-thumbnailurl').value = detail.thumbnailUrl;
		document.getElementById('cv-title').value = detail.title;
		
		 if(displayTitle && !userSetTitle) {
			 displayTitle.value = detail.title;
		 }
	}, true);
	
	eventsApi.on('cv-delegate-logging', function (event, data) {
		document.getElementById('cv-logging').value = data.JSON;
		document.getElementById('cv-logging-onlineurl').value = data.onlineUrl;
		document.getElementById('cv-logging-eventname').value = data.eventName;
	}, true);
})();
