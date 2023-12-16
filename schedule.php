<script type="text/javascript">
  ////////////// Get shows schedule - start //////////////

	function getIsraelTime(theTime) {
		if (theTime === undefined) {
			return new Date(new Date().toLocaleString("en-US", { timeZone: 'Asia/Jerusalem' }));
		} else {
			return new Date(new Date(theTime).toLocaleString("en-US", { timeZone: 'Asia/Jerusalem' }));
		}
	}

	function decodeHtmlspecialChars(text) {
		var map = {
			'&amp;': '&',
			'&#038;': "&",
			'&lt;': '<',
			'&gt;': '>',
			'&quot;': '"',
			'&#039;': "'",
			'&#8217;': "’",
			'&#8216;': "‘",
			'&#8211;': "–",
			'&#8212;': "—",
			'&#8230;': "…",
			'&#8221;': '”'
		};

		return text.replace(/\&[\w\d\#]{2,5}\;/g, function(m) { return map[m]; });
	};

	function makeShow(realtimeTag, djTag, showTag, imageTag) {
		var startTime = getIsraelTime();
		var endTime = getIsraelTime(startTime);
		var realtime = jQuery("#" + realtimeTag).attr("realtime");
		if (realtime && realtime.length > 0) {
			realtime = realtime.split(' ').map(parseFloat);
			startTime.setDate(realtime[0] - startTime.getDay() + startTime.getDate());
			endTime.setDate(startTime.getDate());
			startTime.setHours(Math.floor(realtime[1]), Math.floor((realtime[1] % 1) * 60));
			endTime.setHours(Math.floor(realtime[2]), Math.floor((realtime[2] % 1) * 60));
		} else {
			startTime.setMinutes(0);
			endTime.setMinutes(60);
		}
		return {
			startTime: startTime,
			endTime: endTime,
			start: startTime.toTimeString().substr(0, 5),
			end: endTime.toTimeString().substr(0, 5),
			dj: jQuery("#" + djTag).text(),
			show: jQuery("#" + showTag).text(),
			image: jQuery("#" + imageTag).attr("src")
		};
	}

	function changeActiveShowOnSchedule() {
		var d = getIsraelTime();
		var h = d.getHours() + d.getMinutes() / 60 + d.getSeconds() / 3600;
		var elements = document.getElementsByClassName("show-box") || [];
		for (var ind in elements) {
			if (!elements.hasOwnProperty(ind)) continue;
			var e = elements[ind];
			var tm = (e.getAttribute('realtime') || '').split(' ').map(parseFloat);
			var act = (tm.length == 3 && tm[0] == d.getDay() && tm[1] <= h && h <= tm[2]);
			e.className = e.className.replace(" active", "") + (act ? " active" : "");
		}
	}

	function setSchedulehtmlFromJson(json) {
		function nameFromCode(x) {
			var y = x.substr(x.indexOf(`id="show-name-curr" class="show-name">`)+38, 40);
			return y.substr(0, y.indexOf(`</`)).trim();
		}

		var schedulehtmlstr = JSON.parse(json);
		window.schedulehtml = schedulehtmlstr.map(x => {
			var h = decodeHtmlspecialChars(x[1]);
			return {a: nameFromCode(h), date: getIsraelTime(x[0]), html: h };
		});
	}

	function updateCurrShow() {
		if (typeof player_update_live_show !== 'undefined') {
			player_update_live_show(makeShow("show-link-curr", "show-dj-curr", "show-name-curr", "show-image-curr"));
		}
		if (typeof changeActiveShowOnSchedule !== 'undefined') {
			changeActiveShowOnSchedule();
		}
	}

	function initCurrShowUpdates() {
		console.log("*-*-* initCurrShowUpdates() *-*-*");
		setSchedulehtmlFromJson(<?php echo "`" . get_twoday_shows_json() . "`"; ?>);
		
		var firstcurrTime = getIsraelTime();
		var showshow = window.schedulehtml[Math.max(0, window.schedulehtml.findIndex(x => x.date.getTime() > firstcurrTime.getTime())-1)];
		jQuery('#shows-curr-and-next').replaceWith(showshow.html);
		console.log("*-*-* initial updateCurrShow() " + showshow.a + " " + firstcurrTime);
		
		updateCurrShow();

		window.scheduleLastTime = getIsraelTime();
		window.scheduleLastReadTime = getIsraelTime();
		if (window.scheduleInterval) clearInterval(window.scheduleInterval);
		window.scheduleInterval = setInterval(() => {
			var currTime = getIsraelTime();
			try {
				
				// reload schedule every day and a half
				if (currTime.getTime() - window.scheduleLastReadTime.getTime() > 18*60*60*1000) {
					jQuery.ajax({
						url: "<?php echo admin_url('admin-ajax.php?html_twoday_shows_json=true'); ?>",
						type: "POST",
						cache: false,
						data: 'action=html_twoday_shows_json',
						success: (data) => {
							console.log("*-*-* initCurrShowUpdates() : updated " + getIsraelTime());					
							setSchedulehtmlFromJson(data.substr(0, data.length - 1));
							window.scheduleLastReadTime = getIsraelTime();
						}
					});
				}
				
				// find next show
				if (!window.nextShowOnSchedule) {
					window.nextShowOnSchedule = window.schedulehtml.find(x => x.date.getTime() > currTime.getTime());
					console.log("*-* first time update next show " + window.nextShowOnSchedule.a);
				}
				
				// update curr show if needed
				if (window.nextShowOnSchedule.date.getTime() <= currTime.getTime()) {
					jQuery('#shows-curr-and-next').replaceWith(nextShowOnSchedule.html);
					console.log("*-*-* updateCurrShow() " + nextShowOnSchedule.a + " " + currTime);
					setTimeout(() => {
						updateCurrShow();
						window.nextShowOnSchedule = window.schedulehtml.find(x => x.date.getTime() > currTime.getTime());
						console.log("*-* update next show " + window.nextShowOnSchedule.a);
					}, 1);
				}
				
			} catch (e) {
				console.log("error: " + e);
				console.log("at " + getIsraelTime());
			}
			window.scheduleLastTime = currTime;
		}, 10000);
	}
	
  ////////////// Get shows schedule - end //////////////
</script>

<?php
// var_dump($im_on_home_page);
// if(!isset($im_on_home_page) || !$im_on_home_page) {
echo '<div style="display: none" id="not_on_home_page">';
get_curr_shows();
echo '</div>';
// }
?>