$( document ).ready(function() {
    
	

		$("#validateForm").validate({
     
		    rules:
		    {
		    	username: {
			     required: true,
			    },
		    	password: {
			     required: true,
			     minlength: 8,
			     maxlength: 15
			    },
			    confirm_password: {
			     required: true,
			     equalTo: '#password'
			    },
		    },
		    messages:
		    {
			    username: {
			     required: "Please Enter Username",
			     minlength: "Your Name is Too Short"
			    },
			    password:{
			     required: "Please Enter Password",
			     minlength: "Password at least have 8 characters"
			     },
			    confirm_password:{
			     required: "Please Retype your Password",
			     equalTo: "Password Did not Match !"
		    }
		     },
		     errorPlacement : function(error, element) {
		     $(element).closest('.form-group').find('.help-block-c').html(error.html());
		     },
		     highlight : function(element) {
		     $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		     },
		     unhighlight: function(element, errorClass, validClass) {
		     $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		     $(element).closest('.form-group').find('.help-block-c').html('');
		     },

		    submitHandler: function(form) {
		        form.submit();
		    }
		     });
     



});
