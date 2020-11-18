Plugin for YOURLS: **Search URLs by Title**
===================

YOURLS plugin to add additional commands to the YOURLS API. 

- search_urls_by_title - a function to search all URLs using the title field as search parameter

How to install this plugin
==========================
1. Create a new directory under the "user/plugins" directory
2. Save the "plugin.php" file into the directory you created in step 1
3. Activate the plugin using your YOURLS admin panel 

How to use this plugin
======================

## Action: search_urls_by_title

The search_urls_by_title search all URLs using the title field as search parameter with pagination. It accepts the following parameters:

- username | required | your username
- password | required | your password
- action | required | search_urls_by_title
- title | required | The title used in url creation
- format | optional | "jsonp", "json", "xml" or "simple" 
- page | optional | Numeric. Page number. (default = 1)
- rows | optional | Numeric. The numer of rows per page (default = 10)

Example URL (HTTP METHOD: GET)

`
http://yourls.localhost/yourls-api.php?username=yourusername&password=yourpasswrod&action=search_urls_by_title&format=json&title=urltitle&page=1&rows=10

`

