<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script> 
<script type="text/javascript"> 
 
$(document).ready(function(){

//Larger thumbnail preview 

$("ul.thumb li").hover(function() {
	$(this).css({'z-index' : '10'});
	$(this).find('img').addClass("hover").stop()
		.animate({
			marginTop: '-110px', 
			marginLeft: '-110px', 
			top: '50%', 
			left: '50%', 
			width: '174px', 
			height: '174px',
			padding: '20px' 
		}, 200);
	
	} , function() {
	$(this).css({'z-index' : '0'});
	$(this).find('img').removeClass("hover").stop()
		.animate({
			marginTop: '0', 
			marginLeft: '0',
			top: '0', 
			left: '0', 
			width: '100px', 
			height: '100px', 
			padding: '5px'
		}, 400);
});

//Swap Image on Click
	$("ul.thumb li a").click(function() {
		
		var mainImage = $(this).attr("href"); //Find Image Name
		$("#main_view img").attr({ src: mainImage });
		return false;		
	});
 
});

</script> 
</head>

<body>
<div class="fluid_grid_layout"> 

    <div class="six_column section" id="header">
            <div class="one column">
                <div class="column_content">
                    <div id="logo"></div>
                </div>
             </div>   
        
        	<div class="four column">
                <div class="column_content">
                    <ul id="main" class="nav">
                    <li><a href="dev.html">Home</a></li>
                    <li>Studio</li>
                    <li>Portfolio</li>
                    <li>Inspiration</li>
                    <li>Contact</li>
                    </ul> 
                 </div>
            </div>   
        
            <div class="one column">
                <div class="column_content">
                <ul class="social">
                <li>
                <a href="https://www.facebook.com/pages/Bryte-Design/141074065983839" target="_blank" title="Facebook" id="facebook"><span>facebook</span></a></li>
                <li>
                <a href="https://twitter.com/#!/BryteDesign" target="_blank" title="Twitter" id="twitter"><span>twitter</span></a></li>
                <li>
                <a href="mailto:info@brytedesign.com" target="_blank" title="Email" id="mail"><span>email</span></a></li>
                </ul>
                </div>
            </div>
<body>
</body>
</html>
