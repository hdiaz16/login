$( document ).ready(function() {
    
	

		$("#formLogin").validate({
     
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
		    },
		    messages:
		    {
			    username: {
			     required: "Please Enter Username"
			    },
			    password:{
			     required: "Please Enter Password"
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
