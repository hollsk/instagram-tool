instagram-tool
===========

A php webservice that retrieves a JSONP stream from Instagram for you to use for your own nefarious purposes. 
Either use the sample javascript to display the pics, or just get the plain JSONP stream back for you to do whatever you want with.

It sounds completely useless but means you won't need to waste your own precious time setting up an Instagram app every time you need to display a feed on some website. 

# Project Setup

Set up a new application for your webservice on Instagram here: http://instagram.com/developer/ 

Upload the files to a server. Edit _config.php to add your API client ID and secret key from Instagram, and change the redirect_uri to match what you told Instagram was your webservice's URL. 

Follow the instructions in index.php on your server. That's it! 