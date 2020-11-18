search-urls-by-title
===================

YOURLS plugin to add additional commands to the YOURLS API.
- search_urls_by_title - a function to search all URLs using the title field as search parameter

The geturl function does not create a new short code if the URL does not exist, it's purely designed to verify if the URL has been set up. Currently this has not been tested on a site using duplicate URLs.

The update function lets a site update the long URL associated with a short code. There is no security checking on this, as long as the API key is valid it will update, so make sure your key is secure if you plan to use this plugin!

The change_keyword function takes three parameters. "url" is the current URL, "oldshortcode" is the current keyword you want to change, and "newshortcode" is the new keyword you'll change it to. The keyword cannot currently be used in YOURLS.

How to install this plugin
==========================
1. Create a new directory under the "user/plugins" directory
2. Save the "plugin.php" file into the directory you created in step 1
3. Activate the plugin using your YOURLS admin panel 

How to use this plugin
======================

# Action search_urls_by_title

## The search_urls_by_title search all URLs using the title field as search parameter with pagination. It accepts the following parameters:

- username | required | your username
- password | required | your password
- action | required | search_urls_by_title
- title | required | The title used in url creation
- format | optional | "jsonp", "json", "xml" or "simple" 
- page | optional | Numeric. Page number. (default = 1)
- rows | optional | Numeric. The numer of rows per page (default = 10)