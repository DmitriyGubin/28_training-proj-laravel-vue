$('.phone').mask("+7(999) 999-9999");

$('#submit_main_form').on('click', () => Send_Form($('#mail_form'), '/contact-form' ,event));

$('#register_butt').on('click', () => Send_Form($('#registr_form'), '/registration' ,event));

$('#go_out').on('click', function(event){

	event.preventDefault();

	$.ajax({
		type: "POST",
		url: "/go_out",
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(data){
			location.reload();
		}
	});

});

$('#auth_butt').on('click', () => Send_Form($('#auth_form'), '/auth_form' ,event));

// $('.slider').slick({
// 	dots: true,
// 	infinite: true,
// 	slidesToScroll: 1,
// 	slidesToShow: 1
// });

function Validate($form_ref)
{
	var err= 0;
	var pattern_passw = /(?=^.{6,}$)(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[^A-Za-z0-9]).*/;//для пароля
	
	$form_ref.find('.required').each(function() {

		var $this = $(this);
		var inp_val = $this.val();

		var bool;
		if($this.hasClass('login'))
		{
			bool = (inp_val.length < 5);
		}
		else if($this.hasClass('phone'))
		{
			bool = (inp_val.length != 16);
		}
		else if($this.hasClass('password'))
		{
			bool = !pattern_passw.test(inp_val);
		}
		else
		{
			bool = (inp_val == '');
		}

        if (bool)
        {
            err++;
            $this.addClass("error");
        } 
        else 
        {
            $this.removeClass("error");
        }
	});

    return err;
}

function Send_Form($form_ref, urll , event)
{
	event.preventDefault();
	var err = Validate($form_ref);
	var formData = new FormData($form_ref[0]);
	var id_form = $form_ref.attr('id');

	if(err == 0)
	{
		$.ajax({
			type: "POST",
			url: urll,
			contentType: false,
			processData: false,
			data: formData,
			dataType: "json",
			success: function(data){
				//$form_ref[0].reset();
				if(id_form == 'registr_form')
				{
					if(!data.chek_user)
					{
						$('#registr_form .error_text').removeClass('hide');
					}
					else
					{
						window.location.replace("/adminka/");
					}
				}
				if(id_form == 'auth_form')
				{
					if(data.chek_user)
					{
						window.location.replace("/adminka/");
					}
					else
					{
						$('#auth_form .error_text').removeClass('hide');
						$form_ref.find('input').addClass('error');
					}
				}
				if(id_form == 'mail_form')
				{
					$.fancybox.open({
						src: '#sucsess_popup'
					});
				}
			}
		});
	}
}


