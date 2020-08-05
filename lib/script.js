

$(document).ready(function() {
	$("#submit").click(function(event){
		event.preventDefault();
		var name = $("#name").val();	
        $(document).on({
			ajaxStart: function(){
				$('#spinner').css('display','block');
				$('#result').css("visibility","hidden");
				$('#copy').css('visibility','hidden');
			},
			ajaxStop: function(){ 
				$('#spinner').css('display','none');
				$('#result').css("visibility","visible");
				$('#copy').css('visibility','visible');
			}    
		});

		$("#result").load('process.php', {'name':name} );

	});
});



$(document).ready(function(){

	const video = document.getElementById('demo');
	video.addEventListener('click',function openvideo(){
		$('#video_container').children('iframe').attr('src', "https://www.youtube.com/embed/9_iKkec6GSE?autoplay=1");
		$('#video-open').fadeIn("slow",function(){
			const videoout = document.getElementById('close_icon');
			videoout.addEventListener('click',function closevideo(){
				$('#video-open').fadeOut("slow");
				$('#video_container').children('iframe').attr('src', '');
			})
		});

	})
});

$(document).ready(function(){
	var tooltipp = document.getElementById('copy');
	tooltipp.addEventListener('click',function copy(){
		$('.tooltipp').css('visibility','visible');
		var range = document.createRange();
		range.selectNode(document.getElementById("result"));
window.getSelection().removeAllRanges(); // clear current selection
window.getSelection().addRange(range); // to select text
document.execCommand("copy");
window.getSelection().removeAllRanges();// to deselect



});
	tooltipp.addEventListener('mouseout',function mouseout(){
		$('.tooltipp').css('visibility','hidden');
	}); 
});


(function() {
	'use strict';
	window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
    	form.addEventListener('submit', function(event) {
    		if (form.checkValidity() === false) {
    			event.preventDefault();
    			event.stopPropagation();
    		}
    		form.classList.add('was-validated');
    	}, false);
    });
}, false);
})();