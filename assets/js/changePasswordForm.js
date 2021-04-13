$( document ).ready(function() {
    
	

		$("#changePasswordForm").validate({
     
		    rules:
		    {
		    	new_password: {
			     required: true
			    },
		    	confirm_password: {
			     required: true
			    },
		    },
		    messages:
		    {
			    new_password: {
			     required: "Please Enter New Password"
			    },
			    confirm_password:{
			     required: "Please Confirm Password"
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
