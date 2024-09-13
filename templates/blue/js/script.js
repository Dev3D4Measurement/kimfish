var $j = jQuery.noConflict();
$j(document).ready(function(){
	$j('#contact-form').jqTransform();

	$j("button").click(function(){

		$j(".formError").hide();

	});

	var use_ajax=true;
	$j.validationEngine.settings={};

	$j("#contact-form").validationEngine({
		inlineValidation: false,
		promptPosition: "centerRight",
		success :  function(){use_ajax=true},
		failure : function(){use_ajax=false;}
	 })

	$j("#contact-form").submit(function(e){

			if(!$j('#subject').val().length)
			{
				$j.validationEngine.buildPrompt(".jqTransformSelectWrapper","* Tujuan bank harus di isi","error")
				return false;
			}
			
			if(use_ajax)
			{
				$j('#loading').css('visibility','visible');
				$j.post('config/proses_konfirmasi.php',$j(this).serialize()+'&ajax=1',
				
					function(data){
						if(parseInt(data)==-1)
							$j.validationEngine.buildPrompt("#captcha","* Anda salah masukan kode!","error");
							
						else
						{
							$j("#contact-form").hide('slow').after('<h1>Terima Kasih!<br/>Kami akan segera proses </h1>');
						}
						
						$j('#loading').css('visibility','hidden');
					}
				
				);
			}
			e.preventDefault();
	})

});


$j(document).ready(function(){
	$j('#hubungi').jqTransform();

	$j("button").click(function(){

		$j(".formError").hide();

	});

	var use_ajax=true;
	$j.validationEngine.settings={};

	$j("#hubungi").validationEngine({
		inlineValidation: false,
		promptPosition: "centerRight",
		success :  function(){use_ajax=true},
		failure : function(){use_ajax=false;}
	 })

	$j("#hubungi").submit(function(e){

			
			if(use_ajax)
			{
				$j('#loading').css('visibility','visible');
				$j.post('config/proses_email.php',$j(this).serialize()+'&ajax=1',
				
					function(data){
						if(parseInt(data)==-1)
							$j.validationEngine.buildPrompt("#captcha","* Anda salah masukan kode!","error");
							
						else
						{
							$j("#hubungi").hide('slow').after('<h1>Terima Kasih!<br/>Kami akan segera proses </h1>');
						}
						
						$j('#loading').css('visibility','hidden');
					}
				
				);
			}
			e.preventDefault();
	})

});

$j(document).ready(function(){
	$j('#testi').jqTransform();

	$j("button").click(function(){

		$j(".formError").hide();

	});

	var use_ajax=true;
	$j.validationEngine.settings={};

	$j("#testi").validationEngine({
		inlineValidation: false,
		promptPosition: "centerRight",
		success :  function(){use_ajax=true},
		failure : function(){use_ajax=false;}
	 })

	$j("#testi").submit(function(e){

			
			if(use_ajax)
			{
				$j('#loading').css('visibility','visible');
				$j.post('config/proses_testimonial.php',$j(this).serialize()+'&ajax=1',
				
					function(data){
						if(parseInt(data)==-1)
							$j.validationEngine.buildPrompt("#captcha","* Anda salah masukan kode!","error");
							
						else
						{
							$j("#testi").hide('slow').after('<h1>Terima Kasih!<br/>Telah mengisi testimoni </h1>');
						}
						
						$j('#loading').css('visibility','hidden');
					}
				
				);
			}
			e.preventDefault();
	})

});