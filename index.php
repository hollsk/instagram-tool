<?php 
	include('_config.php');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
  	<title>Instagram Tool</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  	<!-- Twitter Bootstrap -->
  	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  	<link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">

  	<link rel="stylesheet" media="screen" href="/css/screen.css"/>
</head>

<body>
	<?php if($flash['error'] != ''){ ?>
    <div class="alert">
   		<?php echo $flash['error']; ?>
    </div>
    <?php } ?>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">Instagram Tool</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="/">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="mailto:hollsk@gmail.com">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="active"><a href="http://instagram.com/developer/endpoints/" target="_blank">Full API documentation (ext&rarr;)</a></li>
              <li class="nav-header">User</li>
              <li><a href="/webservice.php?what=getInfoForUser&who=<?php echo urlencode($config['target_user']) ?>">Get a user's basic info (by name)</a></li>
              <li><a href="/webservice.php?what=getRecentMediaForUser&who=<?php echo urlencode($config['target_user']) ?>&count=2&max_timestamp=&min_timestamp=&min_id=&max_id=10">Get recent media for a username</a></li>
              <li class="nav-header">Media</li>
              <li><a href="/webservice.php?what=searchForMedia&lat=51.5070026&lng=-0.0964562&min_timestamp=&max_timestamp=&distance=1000">Search for media by lat / long</a></li>
              <li><a href="/webservice.php?what=getPopularMedia">Get popular media</a></li>
              <li class="nav-header">Tags</li>
              <li><a href="/webservice.php?what=searchForTags&query=kittens">Search for tags by name</a></li>
              <li><a href="/webservice.php?what=recentlyTagged&query=kittens">Media recently tagged as...</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <p>So you want Instagram integration? This tool will help you. </p>
            <p>Instagram is a <b>closed service</b> with no public feeds, so you can't anonymously extract a user's image stream like you can with, say, Twitter.</p>
            <p>This tool handles all the oAuth stuff for you so you can get a stream for a given user to use in your own project without having to set up a new application yourself.</p>
            <p>You can mash the button below to retrieve something from the webservice!</p>
            <p><a class="btn btn-primary btn-large" href="/getRecentPicsForUser.php?who=<?php echo urlencode($config['target_user']) ?>&count=2">Gimme dem sweet Instagram tings &raquo;</a></p>
          </div>
          <div id="about">
	          <h2>How do I use this?</h2>
	          <p>Choose the thing that you want from the sidebar above - each is a link with various parameters. By switching out your details with the example details, you can build your own custom URL. If you CURL the url or do an AJAX request from your own project, you'll get some JSONP back. It's pretty simple.</p>
	          <h2>What do I do with the JSONP?</h2>
	          <p>Collect it into a callback called "instagram" and manipulate it from there. Here is an example:</p>
	          <pre>
$(document).ready(function(){
	// request the JSONP via your own webservice - remember to add the &callback=instagram parameter
	$.ajax({
		url: 'http://your-webservice-url/webservice.php?what=getRecentMediaForUser&who=Pancentric%2520Digital&count=2&callback=instagram',
		dataType: "jsonp"
	});
});
					
// do whatever you want with the callback here
function instagram(response){
	var instagramArr = [];
	for(var i=0; i&lt;response.data.length; i++){
		// push everything into an array to use later
		instagramArr.push({'image': response.data[i].images.thumbnail.url, 'caption' : response.data[i].caption.text});
	}
	
	// get all target divs and iterate through them, fading out the loading message and appending a value from each array key into each
	var instagramBoxes = $('.theme-instagram');
	instagramBoxes.each(function(k,v){
		$(this).find('.loading').fadeOut(750, function() {
			$(this).parent('.inner').html('').append('&lt;img src="'+instagramArr[k].image+'" alt="Follow Pancentric on Instagram"/&gt;&lt;p&gt;'+instagramArr[k].caption+'&lt;/p&gt;').hide().fadeIn(750);
		});
	});	
}	          	
	          </pre>
	          <h2>How does it work?</h2>
	          <p>The Instagram API, like the Facebook API, needs human interaction from an Instagram user before it will grant authorisation to retrieve the contents of a stream. The Instagram developers decided to implement non-expiring auth tokens for this, so what you're doing is setting up an auth token and using the normal API methods through an interstitial interface. It's designed to work as a webservice rather than an application, so you don't need to set up a new app every time you want to put a feed on a website.</p>
	          <h2>Is this a complete service?</h2>
	          <p>No, write your own Instagram app if it suits you or if this one doesn't do what you want or is too slow. This is really just a convenient way to retrieve basic streams. It doesn't have any capacity for you to retrieve detailed information about yourself, for instance, so wouldn't be suitable for an Instagram mashup application. There are other cases where rolling your own makes more sense.</p>
	          <h2>Is the returned stream 'live'?</h2>
	          <p>Yep! You request the appropriate url from this webservice, and this webservice requests the latest JSON directly from Instagram and returns it to you.</p>
          </div>          
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Pancentric 2013</p>
      </footer>

    </div><!--/.fluid-container-->

  <script type="text/javascript" src="http://cdn.pancentric.com/cdn/libs/jquery/1.9.0/jquery-1.9.0.min.js"></script>
  <script type="text/javascript" src="http://cdn.pancentric.com/cdn/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
  <script src="/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		
  	});
  </script>
</body>
</html>
