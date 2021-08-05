==========================
 Simple PHP Photo Gallery
==========================

Copyright John Caruso 2005-2008
https://sourceforge.net/projects/simplephpgal/


A) Embedded Gallery or Standalone
==================================
You can embed the gallery into existing pages or use it as a standalone page.

To use it as a Standalone page, just follow the instructions in steps (B) and (C).

To use it as an embedded Gallery in an existing page:
1) Copy the the code from the embeddedGallery.php file (or just use an include("embeddedGallery.php") statement in your existing php file).
2) Follow step (B) with the following modifications
	* B.1) The gallery title will not be taken from the folder name, but rather the config file. Make sure to uncomment the $galleryTitle = "title"; line and place your desired title in the quotes.
	* B.2) Do not include index.php when copying the files from the .zip file
	* C.2) Do not include index.php if you want to create your own index page. Just include the embeddedGallery.php file in your own script

B) Steps to setup your photogallery.
====================================

1) Create a new folder with the name that you would like your gallery title to be.
	* use the underscore "_" for spaces (eg. My_Vacation)
	* you can only use characters that are allowable for folder names
2) Put all the files contained in this .zip file into the folder you just created
3) If they do not already exist, create two folders named 'phpGallery_thumbs' and 'phpGallery_images' inside your folder. You will need WRITE permissions on the phpGallery_thumbs directory.
4) Put all of the photos that you want displayed in your gallery into the phpGallery_images folder
	* by default they will be displayed in alphabetical order. This can be modified in the phpGalleryConfig.php file by setting the $sortMode variable at the bottom of the file
5) Upload your directory to your website.
	* The first time you view the gallery it will take some time to load because thumbnails are being generated (If the page times out and nothing is shown on the screen, refresh the page. You may need to do this several times if you have a lot of images)


C) For Multiple Photo Galleries
================================
If you want to create multiple photo galleries:

1) Create a folder with the name that you would like your gallery listing to have.
	* use the underscore "_" for spaces (eg. My_Galleries)
	* you can only use characters that are allowable for folder names
2) Place the index.php, embeddedGallery.php and phpGalleryConfig.php files from this .zip file into the folder
3) Do the steps in (A) for as many galleries as you want to display, and place them into the folder you created in the previous step



D) Modifying the Style
=======================
Every element in the gallery script is attached to a CSS class.

If you are using the gallery as an embedded gallery, copy and paste the CSS classes/elements from the phpGalleryStyle.css file and paste them into your current stylesheet. I have tried to make the names as unique as possible.

If you are using the gallery as a standalone page, you can make your modifications directly to the phpGalleryStyle.css file.





NOTE:

i) Your webserver must have PHP version 3.0 or higher, and GD 2.0 or higher installed in order for the gallery software to work.
	To check this, create a php file with the line <?php phpinfo(); ?> and run it to see what modules are installed.

ii) Should work for JPG, JPEG, PNG and GIF files (for both upper and lowercase file extensions)

iii) Feel free to remove the copyright information (I agree it is quite ugly), under the condition that you aren't going to try to break what the copyright is intended to protect :)

iv) Have fun and enjoy!

Oh and if you don't mind, drop me a line at simplephpgallery@gmail.com with the URL to your website that you are using the gallery script on. I enjoy seeing how something I've done has helped out someone else!