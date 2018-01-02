$(document).ready(function(){
	$("#insertform").validate({
	      rules: {
		         "nom":{
		            "required": true,
		         },
		         "mail": {
		            "email": true,
		            "maxlength": 255
		         },
		         "telephone": {
		            "required": true
		         }
	      },
	      messages: {
	    	    "nom": "Veuillez saisir le nom",
	    	    "mail": {
	    	      "required": "We need your email address to contact you",
	    	      "email": "Your email address must be in the format of name@domain.com"
	    	    }
	    	  }
	
	  })
	
});

