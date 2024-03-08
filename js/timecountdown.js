 // clock
	jQuery(function ($) {
		var spd = 100;
		var spdVal = 10;
		var cntDown = 10 * 60 * spdVal;
		setInterval(function () {
		var mn, sc, ms;
		cntDown--;
		if (cntDown < 0) {
			return false;
		}
		mn = Math.floor(cntDown / spdVal / 60);
		mn = mn < 10 ? "0" + mn : mn;
		sc = Math.floor((cntDown / spdVal) % 60);
		sc = sc < 10 ? "0" + sc : sc;
		ms = Math.floor(cntDown % spdVal);
		ms = ms < 10 ? "0" + ms : ms;
		var result = mn + ":" + sc;
		if (document.getElementById("time")) {
			document.getElementById("time").innerHTML = result;
		}
		}, spd);
	});
  // end clock