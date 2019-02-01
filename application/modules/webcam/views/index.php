 <script type="text/javascript" src="<?=base_url()?>resource/jpegcam/htdocs/webcam.js" ></script>
 
 <script type="text/javascript">
// rating_star
var pathArray = window.location.pathname.split('/');
var site_upload = pathArray[0] + "/mixedappseg/contoh_upload_webcam/upload";
console.log (site_upload);
var camera = $('#camera'),screen = $('#screen');
webcam.set_api_url(site_upload);
screen.html( webcam.get_html(screen.width(), screen.height()) );

var shootEnabled = false;
$(".takeWebcam").click(function(){
$(".webcam").show('blind');
return false;
});
$("#closeButton").click(function(){
$(".webcam").hide('blind');
return false;
});
$('#takeButton').click(function(){
webcam.snap();
$("#retakeButton").show();
$(this).hide();
return false;
});
$('#retakeButton').click(function(){
webcam.reset();
$("#takeButton").show();
$(this).hide();
return false;
});
$('#uploadAvatar').click(function(){
webcam.upload(site_upload, function(){});
webcam.set_hook( 'onComplete', my_callback_function() );
//togglePane()
webcam.reset();
return false;
});
webcam.set_hook('onLoad',function(){
shootEnabled = true;
});
webcam.set_hook('onError',function(e){
screen.html(e);
});	
	function my_callback_function(response) {
	//alert("Success! PHP returned: " + response);
	$(".avartar > img").attr("src","/mcinew/media/"+response.split("/")[2])
	//$("input[type='file'][name='userfile']").val("/mcinew/media/"+response.split("/")[2])
	}
	</script>
 
<style type="text/css">
  .webcam {
    display:none;
  }
  #retakeButton{
    display:none;
  }
  #screen {
    width:250px;
    height:250px;
    margin:5px 0px 20px 0px;
    border:2px #f5f5f5 solid;
    background:#000000;
    text-align: center;
    color:#666;
  }
  a {
    text-decoration: none;
  }
</style>

<div id="screen"></div>
<a id="takeButton" class="submit">Take Me</a>
<a id="retakeButton" class="submit">Retake</a>

