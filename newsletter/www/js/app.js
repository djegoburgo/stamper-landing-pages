$(document).ready(function() {
	function slideshow(){
		setTimeout(function(){
			$(".photo1").fadeOut(1000),
			$(".photo2").fadeIn(1000);
			$(".banner p").fadeOut(500, function () {
				$(this).text("gather the best moments spent in your place.");
				$(this).fadeIn(500);
			})
		},4500);
		setTimeout(function(){
			$(".photo2").fadeOut(1000),
			$(".photo3").fadeIn(1000);
			$(".banner p").fadeOut(500, function () {
				$(this).text("With Stamper, become the funkiest place in town!");
				$(this).fadeIn(500);
			})
		},10000);
		setTimeout(function(){
			$(".photo3").fadeOut(1000),
			$(".photo1").fadeIn(1000);
			$(".banner p").fadeOut(500, function () {
				$(this).text("The easiest app to...");
				$(this).fadeIn(500);
			})
		},15500);
	}
	slideshow();
		
	setInterval(slideshow, 15500);

        setTimeout(function(){
            var formSubmit = $(form).find('input[type=submit]');
            formSubmit.unbind();
        }, 3000);

        var form = $('#formulaire');
        
        var reemail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        $(form).submit(function(event) {
            event.preventDefault();
            var email = $('#email').val();
		    sendDatas(email);
        });


        function sendDatas (email) {
        	var test = reemail.test(email);
            if (test) {
                // Retrieve datas and send them to a php page.
                $.ajax({
				  type: "POST",
				  url: "http://www.stamperapp.com/mailer.php",
				  data: {"email" : email},
				  success: sucessFn()
				});
                
            }  
        }

        function sucessFn () {
		    $('#email').val('');
		    $( ".registrationConfirm" ).addClass( "bounceInLeft" ).css({'display':'block'});
        }
	//}
});