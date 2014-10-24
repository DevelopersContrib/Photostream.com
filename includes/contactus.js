(function($) {
    $(document).ready(function () {
        $('#share').hide();
        $('#submit').click(function(){
            var name = $('#name').val();
            var email = $('#email').val();
            var contact = $('#contact').val();
            var service = $("#service_ option:selected").val();
            var msg = $('#msg').val();
            if(name==''){
                alert('Name is Required.');
                $('#name').focus();
                return false;
            }else if(email==''){
                alert('Email is Required.');
                $('#email').focus();
                return false;
            }else if(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(email)==false){
                alert('Please enter a valid email address.');
                $('#email').focus();
                return false;
            }else if(contact==''){
                alert('Contact is Required.');
                $('#contact').focus();
                return false;
            }else if(service==''){
                alert('Service Type is Required.');
                $('#service').focus();
                return false;
            }else if(msg==''){
                alert('Message is Required.');
                $('#msg').focus();
                return false;
            }
            var domain = $('#domain').val();
            jQuery.ajax({
                type: "post",url: "http://domaindirectory.com/servicepage/service_post.php",
                data: {'name':name,'email':email, 'contact': contact, 'service': service,'msg':msg,'domain':domain},
                success: function(html){
                    $('#frmservice').slideUp('slow');
                    $('#submit').hide();
                    $('#response').slideDown('normal',function(){
                        $('#res_msg').append('<h4>'+html+'</h4>');
                        if(email!=""){
                            $('#share').show();
                        }
                    });
                    $('#name').val('');
                    $('#email').val('');
                    $('#contact').val('');
                    $('#msg').val('');
                    //alert(html);
                }});
				
			//VNOC SERVICES
			$.post("http://manage.vnoc.com/subscribersubmit/add",
				{
					type:'SERVICES',
					domain:domain,
					name: name,
					email: email,
					message: msg,
					service_id:service
				}
				,function(data){}
			);
			
        });
    });
})(jQuery);