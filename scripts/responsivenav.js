function respnav() {
		var x = document.getElementById("respnav");
		if (x.className === "nav navbar-nav") {
			x.className += " responsive";
		}
		else {
			x.className = "nav navbar-nav";
		}
	}