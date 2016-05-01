# mframe
A flexible CSS and JS modular framework.
## PHP
The framework uses a little PHP to maximise page performance. It combines and caches the CSS and JS to maximise performance. There are also a few basic classes and includes to provide utilities such as image compression.
This would be done using the following image code :
    <img src="<?php $u->data_uri('img/mick.png'); ?>" />
Efforts have been made to avoid developers from being tied into the framework. Developrs can grab code from the web and use them within the framework.
## jQuery
The framework uses jQuery. It may be best to load this from a CDN during development and then a local version on launch.
## Structure
*   classes : A directory for holding PHP classes. You can add any classes you download from the web in there.
*   img : A directory form images.
*   includes : A directory for PHP includes, speeding up the development process, but without the constraints of a CMS.
*   modules :  The main area of mframe. Modules such as 'grid' and 'nav' are held here. Each module is basically a CSS file or a CSS and JS combination. You should be able to delete modules you don't want to use in order to speed your site up. You should also be able to easily create your own modules without need to understand the framework. You can even replace the modules with CSS and JS you've found from other sites. It's pretty safe.
*   combine.php : Combines the CSS and JS into minimised streams for fast output.
*   css-cache.php : Caches the CSS.
*   custom.css : For adding your own CSS beyond the modules.
*   custom.js : For adding your own JS beyond the modules.
*   index.php : The homepage and the basis for additional pages on your website. Uncomment the top and bottom include references when you're ready to go live.
*   js-cache.php : Caches the JS.