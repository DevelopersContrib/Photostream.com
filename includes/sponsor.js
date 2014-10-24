(function($) {
    $(document).ready(function () {
       
        $('#submit').click(function(){
            var fname = $('#firstname').val();
            var lname = $('#lastname').val();
            var company = $('#company').val();
            var phone = $('#phone').val();
            var email = $('#email2').val();
            var pass1= $('#pass1').val();
            var pass2 = $("#pass2").val();
			
            if(fname==''){
                alert('First Name is Required.');
                $('#firstname').focus();
                return false;
            }else if(lname==''){
                alert('Last Name is Required.');
                $('#lastname').focus();
                return false;
				}else if(phone==''){
                alert('Phone Number is Required.');
                $('#phone').focus();
                return false;
				}else if(email==''){
                alert('Email is Required.');
                $('#email').focus();
                return false;
            }else if(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(email)==false){
                alert('Please enter a valid email address.');
                $('#email2').focus();
                return false;
            }else if(pass1==''){
                alert('Password is Required.');
                $('#pass1').focus();
                return false;
            }else if(pass2==''){
                alert('Confirm Password is Required.');
                $('#pass2').focus();
                return false;
            }else if(pass1!=pass2){
                alert('Password did not Match.');
                $('#pass1').focus();
                return false;
            }
			
          
        });
    });
})(jQuery);