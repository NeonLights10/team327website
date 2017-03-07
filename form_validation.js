function addEvent(node, type, callback) {
	  if(node.addEventListener) {
		node.addEventListener(type, function(e) {
		  callback(e, e.target);
		}, false);
	  }
	  else if(node.attachEvent) {
		node.attachEvent('on' + type, function(e) {
		  callback(e, e.srcElement);
		});
	  }
	}
	function shouldBeValidated(field) {
	  return (
		!(field.getAttribute('readonly') || field.readonly)
		&&
		!(field.getAttribute('disabled') || field.disabled)
		&&
		(field.getAttribute('pattern') || field.getAttribute('required'))
	  ); 
	}
	function instantValidation(field) {
	  if(shouldBeValidated(field))
	  {
		var invalid = 
		(
		  (field.getAttribute('required') && !field.value)
		  ||
		  (
			field.getAttribute('pattern') 
			&& 
			field.value 
			&& 
			!new RegExp(field.getAttribute('pattern')).test(field.value)
		  )
		);

		if(!invalid && field.getAttribute('aria-invalid'))
		{
		  field.removeAttribute('aria-invalid');
			if (field.name == "email") {
				document.getElementById("email_error").innerHTML = "";
			}
			if (field.name == "display_name") {
				document.getElementById("name_error").innerHTML = "";
			}
		}
		else if(invalid && !field.getAttribute('aria-invalid'))
		{
		  field.setAttribute('aria-invalid', 'true');
			if (field.name == "email") {
				document.getElementById("email_error").innerHTML = "<img src='img/red_x.png' alt ='Red X' height='16' width = '16' style='margin-bottom: 2px'> Doesn't look like a valid email";
			}
			if (field.name == "display_name") {
				document.getElementById("name_error").innerHTML = "<img src='img/red_x.png' alt ='Red X' height='16' width = '16' style='margin-bottom: 2px'> Doesn't look like a valid name. Make sure to capitalize it.";
			}
		}
	  }
	}
	addEvent(document, 'change', function(e, target) {
	  instantValidation(target);
	});