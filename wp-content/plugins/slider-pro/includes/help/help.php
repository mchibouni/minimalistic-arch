<div class="container slider-pro-help">

<section id="create">
	<div class="page-header">
	  <h1>Create the slider <small>Presentation of the slider's administration interface</small></h1>
	</div>
	
	<h3>1. Creating a new slider</h3>
    <div class="row">
		<div class="span3">			
        	<p>You can create a new slider by either going to Slider PRO -> New Slider or Slider PRO -> Sliders -> Create a New Slider. The administration interface of the newly created slider will look as in the image on the right.</p>
        	<p>The slider has 2 columns: one for containing the slide panels and one for containing options panels. Also, below the slide panels, there are a few controls for adding new slides and for manipulating the current slides. I will start by presenting the sidebar options panel, then I'll present the slide panel, and finally I will present the controls.</p>
		</div>
		
		<div class="span9">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slider_new.jpg">
		</div>
	</div>

	<hr />

	<h3>2. Sidebar options panels</h3>
    <div class="row">
		<div class="span4">			
        	<p>The slider provides over 150 options and for making it easier to find a certain option they are grouped in several categories. Each category of options has a separate panel. Most of these panels have their options initially hidden and they need to be displayed by selecting them from the dropdown menu and then click the 'Show' button. Inside the dropdown menu you can see the option's name, its default value, and if you hover over the name of the option a tooltip that describes the option will appear, as you can see in the first image on the right.</p>
        	<p>You will not be able to set an option directly from within the drop down menu, but as I mentioned, you will need to select the option you want to customize using the checkbox next to the option, and then click 'Show'. The selected options will appear below the dropdown menu and you will be able to customize them. After the option fields are displayed you can still hover the options name to read the option's description. Please see the second image on the right.</p>
        	<p>In case you wonder why the setting fields are not displayed by default and you need to take an extra step in order to have them displayed, there are several reasons why this workflow was implemented. First, there are currently 150 options and more will probably be added in the future. Having 150 or more options displayed by default would make the page load slower and the interface would be too cluttered and confusing. Second, it would be pretty difficult to arrange all those options so that they are nicely aligned and don't take too much space. Third, most of the times you only want to customize a few properties, so this interface will allow you to display only those options that you have customized.</p>
        	<p>Some of the sidebar panels are different from the majority. The first one is the 'General' panel. This one has all its options displayed by default. Since you will most likely want to customize several of these options, I considered that it's better to have all these options visible. Another different panel is the 'Slides Order' panel. This panel doesn't contain slider options, its purpose is to allow you to set the order of the slide panels. You can do this with a simple drag&drop as you can see in the third image on the right. Another different sidebar panel is 'Custom JavaScript & CSS'. This panel is used for adding custom JavaScript and/or CSS to your slider. However, in order to do this, you will first need to create the slider by clicking the top 'Create Slider' button. Once you do this, the setting fields of this panel will be visible. In a later chapter you will see how to use the controls provided by this panel.</p>
		</div>
		
		<div class="span8">
			<h5>Selecting the options you want to customize</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/options_drop_down.jpg">
			<br/>
			<br/>
			<br/>
			<h5>Customizing the selected options</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/options_selected.jpg">
			<br/>
			<br/>
			<br/>
			<h5>Slides order</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slides_order.jpg">
		</div>
	</div>
	
	<hr />

	<h3>3. Slide panels</h3>
    <div class="row">
		<div class="span4">			
        	<p>Inside the slide panels you will insert all the data related to the slide. Here you will add the slide's image, thumbnail, caption, inline HTML content, link or lightbox, and also individual settings.</p>
        	<p>The slide panels are draggable so you can reorder the slides simply by dragging the panels in the desired position. Please note that in some browsers, like IE, this functionality doesn't work well, so you will need to use the 'Slides Order' panel for arranging slides.</p>
        	<p>If you double click the panel's handler you will be able to edit the panel's title. This is a useful feature if you want to keep a better reference of your panels. To edit the title, first double click on the handler, then enter the title you want and then just hit the Enter key or click on the handler again.</p>
        	<p>Also, if you move the mouse over a slide panel you will notice 5 icons in the upper right corner.</p> 
        	<p>The first icon allows you to mark the slide. This is useful when you want to perform an action on multiple slide panels at once. </p>
        	<p>The second icon allows you to enable or disable the slide. A disabled slide will not appear in the published slider, so if you want to temporarily remove a slide from the slider you don't have to delete it and then re-create; you will simply disable the slide.</p> 
        	<p>The third icon allows you to duplicate a slide. Duplicating a slide will create a new slide panel that has all the data of the original panel.</p>
        	<p>The fourth icon allows you to permanently delete a slide, and the fifth icon simply allows you to show or collapse the panel.</p>
		</div>
		
		<div class="span8">
			<h5>Drag&Drop slide panels</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slides_drag.jpg">
			<br/>
			<br/>
			<br/>
			<h5>Slide panel interface</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_panel.jpg">
		</div>
	</div>

	<hr />

	<h3>4. Slide panel - Image</h3>
    <div class="row">
		<div class="span4">			
        	<p>It's not necessary to specify a main image; maybe you'll want to use only HTML content on a slide, without a background image. If you do specify an image, you can simply write its path in the 'Path' field or you can click on the 'Add Image' button, which will open the slider's built-in Media Loader. The Media Loader will display all images you uploaded to your WordPress Media Library, and from there you can select which image to insert in the slide. If you need to upload images first, you can use the default WordPress Media uploader. Please note that you can also use external images from Flickr or other image hosting websites. If the path is correct, and TimThumb functions properly, a thumbnail of the image will appear in the left box. If you click on the thumbnail, the full image will be displayed in a modal box. You can also specify some text for the 'alt' and 'title' attributes.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_image.jpg">
		</div>
	</div>

	<hr />

	<h3>5. Slide panel - Thumbnail</h3>
    <div class="row">
		<div class="span4">			
        	<p>The slider also gives you the possibility of displaying thumbnail images. Whether a thumbnail image will be displayed or not depends on the 'Thumbnail Type' setting. If 'tooltip', 'scroller' or 'tooltipAndScroller' is set for this setting, the thumbnail will be displayed; if 'none' is set, the thumbnail will not be displayed. It's not necessary to specify the thumbnail image because the slider will automatically create a thumbnail image based on the main image, by resizing and cropping it. However, if you didn't specify a main image or if you want a custom thumbnail image, you'll need to specify it in the 'Path' field. Just like with the slide image, you can chose an image from the Media Library or you can manually insert its path. You also have the option to specify some text for the 'alt' and 'title' attribute. The specified 'alt' text will be used as a thumbnail caption and the 'title' text will be displayed in a tooltip.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_thumbnail.jpg">
		</div>
	</div>

	<div class="alert alert-info"> <strong>Heads Up!</strong> If the image boxes show 'Image Not Found', that's an indication that TimThumb is not allowed to run properly. For troubleshooting this problem please refer to the 'Troubleshooting' chapter.</div>

	<div class="alert alert-info"> <strong>Heads Up!</strong> The default TimThumb settings will not allow you to load external images. In order to enable this functionality, you will need to open the 'timthumb-config.php' file (/wp-content/plugins/slider-pro/includes/timthumb/timthumb-config.php) and set the 'ALLOW_EXTERNAL' and 'ALLOW_ALL_EXTERNAL_SITES' variables to 'TRUE'.</div>

	<hr />

	<h3>6. Slide panel - Caption</h3>
    <div class="row">
		<div class="span4">
        	<p>You can specify a caption for each slide. For this you are provided with a rich text editor. You can insert any type of HTML content inside the caption. Although you can style the text using the provided visual editor, it's good practice to use external CSS for styling the elements. In order to inert raw HTML code in the caption, click on the HTML button (top-right) and add the code in the modal window.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_caption.jpg">
		</div>
	</div>

	<hr />

	<h3>7. Slide panel - Inline HTML</h3>
    <div class="row">
		<div class="span12">
        	<p>This area offers you a visual editor just like the 'Caption' area but for complex HTML content I recommend adding the code as raw HTML code and then style it using external CSS. You can add any type of content, including videos from YouTube, Vimeo, HTML5 videos or flash movies. In a later chapter you will learn how to add videos and set the slider to automatically handle them.</p>
		</div>
	</div>

	<hr />

	<h3>8. Slide panel - Links</h3>
    <div class="row">
		<div class="span4">
        	<p>The 'Links' area allows you to specify a link or lightbox for both the slide image and the thumbnail image. All you have to do it specify the URL of the link in the 'Path' field. If you want the link to be a lightbox, you will need to check the 'Lightbox' option.</p> 
        	<p>If you want the links to be opened in a lightbox, please note that you can load images, YouTube and Vimeo videos, web pages, or inline HTML content. When you open a Vimeo or YouTube video all you have to do is specify the URL of the youtube/vimeo page, and if you want to set a certain size for the video you can do this by passing a width and a height to the URL of the video: http://www.youtube.com/watch?v=JVuUwvUUPro?width=700&height=400. When you open a web page you need to pass 'iframe=true' to the URL of the page and you can also pass a width and a height: http://yahoo.com?iframe=true&width=700&height=400. For loading inline HTML content all you have to do is specify the ID attribute of the content in the 'Path' field.</p>
        	<p>If you set a lightbox for the slide, the image's 'alt' text will be used as a title for the lightbox window and the link's 'title' text as a description.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_links.jpg">
		</div>
	</div>

	<hr />

	<h3>9. Slide panel - Settings</h3>
    <div class="row">
		<div class="span4">
        	<p>Each slide has a set of options which you can use to override the global options, set in the right sidebar panels. You work with these options the same way you work with the global options. First, you select them from the drop down menu, click 'Show', and once the options fields appear below the drop down you can start editing their value.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_settings.jpg">
		</div>
	</div>

	<hr />

	<h3>10. Slide panel - Slide Type</h3>
    <div class="row">
		<div class="span4">
        	<p>A slide can be static or dynamic. A dynamic slide will automatically fetch data from your WordPress site. There are 2 types of dynamic slide types: 'Posts Content' and 'Gallery Images'. A 'Posts Content' slide will fetch data from your posts, pages, custom post types based on the criteria you select. A 'Gallery Images' slide will fetch a gallery of images added to a certain post. In a later chapter you will learn more about how to create dynamic slides.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_types.jpg">
		</div>
	</div>

	<hr />

	<h3>11. Adding new slides</h3>
    <div class="row">
		<div class="span4">
        	<p>Below the slide panels there are 2 buttons for adding new slides. You can add empty slides or image slides. When you add empty slide you can chose how many slides will be added and when you add image slides you can select the images directly from the Media Loader.</p> 
        	<p>You can select multiple images inside the Media Loader by simply clicking on the image's row. After you select all the images that you want to load, click the top 'Insert' button, not the ones from the image's row because the individual 'Insert' buttons are disabled when you add multiple images at once. Also, you will notice that when an image is selected by clicking on the image's row, that row will have a darker color.</p>
        	<p>When you click the 'Insert' button, the slide panels will automatically be created, one for each selected image, and the images will be loaded inside the panels.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/image_slides_library.jpg">
		</div>
	</div>

	<hr />

	<h3>12. Manipulating slides</h3>
    <div class="row">
		<div class="span4">
        	<p>Below the slides, in the right side you will notice a dropdown menu, which provides several options/actions. Those actions can be applied to all the marked/selected slides. For example, you can delete multiple slides at once, or disable them at once. You can also mark all slides or unmark all slides. After you select the action that you want to perform, click on the 'Apply' button.</p>
		</div>
		
		<div class="span8">
			<img src=<?php echo plugins_url('/slider-pro/includes/help/'); ?>"assets/img/slides_actions.jpg">
		</div>
	</div>

	<hr />

	<h3>13. Create the slider</h3>
    <div class="row">
		<div class="span4">
        	<p>When you're done creating all the slides and adjusting the settings all you have to do is click the 'Create Slider' button.</p>
			<p>After the slider is create the 'Preview Slider' button will become enabled and, also, the 'Delete Slider' option will become available.</p>
			<p>As you can guess, after creating a slider, you can preview it before publishing. The slider will appear in a modal box.</p>
			<p>All the sliders will be displayed on the 'Sliders' page, as you can see in the image on the right. For each slider it is displayed the ID of the slider, its name, the data when it was created, the data when it was modified last time and you also have 5 links: edit, preview, delete, duplicate and export the slider. You will use the ID to publish the slider, as you will see in the next chapter.</p>
		</div>
		
		<div class="span8">
			<h5>Before the slider is created</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/new_slider_create.jpg">
			<br />
			<br />
			<br />
			<h5>After the slider is created</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/new_slider_created.jpg">
			<br />
			<br />
			<br />
			<h5>All Sliders</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/sliders_all.jpg">
		</div>
	</div>

	<h3>14. Export and import sliders</h3>
    <div class="row">
		<div class="span4">
        	<p>You can move sliders between Slider PRO installations by exporting and importing them. Any slider can be exported by clicking on the 'Export' link. The exported file will be an XML file containing all the data about the slider.</p>
			<p>To import a slider all you have to do is click on the 'Import a Slider' button. The upload form will appear in a modal box.</p>
			<p>All you have to do is browse to the slider XML file and then click 'Import Slider'. After that the imported slider will appear in the list of sliders.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/import_slider.jpg">
		</div>
	</div>
</section>


<hr />


<section id="publish">
	<div class="page-header">
	  <h1>Publish the slider</h1>
	</div>
	
	<p>There are multiple ways to insert the slider in your site, depending on where you want the slider to appear. The slider can be inserted in a regular post/page, inside the widgets area or inside you template's PHP code.</p>

	<h3>1. Insert the slider in regular post/page</h3>
    <div class="row">
		<div class="span6">			
        	<p>For this, you can use the slider's shortcode: [slider_pro id="n"], where 'n' is the ID of the slider. You can also generate the needed shortcode using the slider's visual editor button, as you can see in the image on the right. </p>
		</div>
		
		<div class="span6">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/shortcode_generator.jpg">
		</div>
	</div>

	<hr />

	<h3>2. Insert the slider in the widgets area</h3>
    <div class="row">
		<div class="span6">
        	<p>Slider PRO provides you with an easy-to-use, custom widget that allows you to insert any slider into the widgets are. Please see the image on the right.</p>
		</div>
		
		<div class="span6">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slider_widget.jpg">
		</div>
	</div>

	<hr />

	<h3>3. Insert the slider using PHP code</h3>
    <div class="row">
		<div class="span12">
			<p>If you want to add a slider instance from within the theme's template you can use the slider_pro(index, attributes) function like this:</p>		
<pre class="prettyprint linenums">
&lt;?php echo slider_pro(2, array(&quot;width&quot;=>700, &quot;height&quot;=>150, &quot;effect_type&quot;=>&quot;simpleSlide&quot;)); ?&gt;
</pre>
     		<p>The first parameter of the function is the ID of the slider and the second parameter is an array of settings which will override those defined in the Admin area. The second parameter is optional.</p>
		</div>
	</div>

	<div class="alert alert-info"> <strong>Heads Up!</strong>  When you add a slider using PHP code or in the widgets area, it's necessary to set the slider's 'Include Skin' option from the 'General' panel, to true.</div>

	<hr />

	<h3>4. Advanced shortcode use</h3>
    <div class="row">
		<div class="span4">
			<p>Slider PRO gives you the possibility to modify an existing slider by overriding some of the global settings, modifying existing slides' settings or content, adding new slides, or even create complete sliders from scratch, using only shortcodes.</p>
		    <p>When you roll over a setting's name you can see the setting's complete name in the tooltip. You will use that setting name inside the shortcode.</p>
		    <p>This feature is very useful because if you need several similar sliders with minor differences, you can create a single slider in the Admin area and then override the settings that you need to be different. Please see the first example on the right.</p>
		    
		    <p>You can also override the settings or the content of the slides as you can see in the second example.</p>
		    
		    <p> You also have the option to override a slide's content, like the main image, the caption, the html content etc. In the third example on the right you can see how this is done.</p>
		    
		    <p>As you can see, all the content that you add in to a slide in the admin area can be overridden in the shortcode. As I previously mentioned, you can not only override existing settings or content but also add new content. For example, if you don't specify an index for the slide, that slide will be added to the slider at the end of the other slides, as you see in the fourth code example on the right.</p>		     
		     
		    <p>You can even create a slider from scratch if you don't specify an id. For example, the last code example on the right represents a slider with three slides, everything created just with shortcodes.</p>
		</div>

		<div class="span8">
<h5>Override global settings</h5>
<pre class="prettyprint linenums">
[slider_pro id="1" effect_type="swipe" thumbnail_width="200"]
</pre>


<h5>Override slide settings</h5>
<pre class="prettyprint linenums">
[slider_pro id="1" effect_type="slice"]
    [slide index="2" horizontal_slices="4" caption_background_color="#FF0000"]
[/slider_pro]
</pre>


<h5>Override slide content</h5>
<pre class="prettyprint linenums">
[slider_pro id="1" effect_type="slice"]
    [slide index="2" horizontal_slices="4" caption_background_color="#FF0000"]
        [slide_element type="image"]path/to/image.jpg[/slide_element]
        [slide_element type="alt"]second image[/slide_element]
        [slide_element type="link"]http://bqworks.com[/slide_element]
        [slide_element type="thumbnail_image"]path/to/thumb.jpg[/slide_element]
        [slide_element type="thumbnail_title"]just a thumb image[/slide_element]          
        [slide_element type="thumbnail_alt"]Title 2[/slide_element]
        [slide_element type="caption"]main caption content[/slide_element]
        [slide_element type="html"]some inline html content[/slide_element]
    [/slide]  
[/slider_pro]
</pre>


<h5>Add new slides</h5>
<pre class="prettyprint linenums">
[slider_pro id="1" effect_type="slide"]
    [slide]
        [slide_element type="image"]path/to/image1.jpg[/slide_element]
        [slide_element type="caption"]main caption content[/slide_element]
    [/slide]
    [slide]
        [slide_element type="image"]path/to/image2.jpg[/slide_element]
        [slide_element type="caption"]main caption content[/slide_element]
    [/slide]    
[/slider_pro]
</pre>


<h5>Create slider from scratch</h5>
<pre class="prettyprint linenums">
[slider_pro width="700" height="400" thumbnail_type="scroller" skin="pixel" lightbox="true"]
    [slide effect_type="fade" caption_size="40" slide_link_lightbox="true"]
        [slide_element type="image"]path/to/image1.jpg[/slide_element]
		[slide_element type="link"]http://sliderpro.net?iframe=true&width=900&height=500[/slide_element]
        [slide_element type="caption"]main caption content[/slide_element]
    [/slide]
    [slide effect_type="slice" caption_position="top"]
        [slide_element type="image"]path/to/image2.jpg[/slide_element]
        [slide_element type="link"]http://yahoo.com[/slide_element]
    [/slide]
    [slide effect_type="slide" slide_easing="easeInOutExpo]
        [slide_element type="image"]path/to/image3.jpg[/slide_element]
        [slide_element type="html"]some HTML content[/slide_element]
    [/slide]
[/slider_pro]
</pre>
		</div>
	</div>

</section>


<hr />


<section id="skin">
	<div class="page-header">
		<h1>Skin the slider</h1>
	</div>
	
	<h3>1. Introduction</h3>
	<div class="row">
		<div class="span3">			
			<p>The slider offers you several main skins to choose from and also a few skins just for the scrollbar. If you want to edit these skins you can do so from within the Slider PRO -> Skin Editor page. Inside this page you can access each skin and see its CSS code and some information about the skin, like the author and description of the skin.</p> 
		
			<p>The CSS files are commented and the selectors are also suggestive so it should be pretty easy to customize the skin. Also you are being provided with the layered PSD (or PNG in some cases) files, so that you're able to modify the size and color of the graphic elements. These files are in 'skins_src'.</p>
		</div>
		
		<div class="span9"> 
       		<h4>Skin editor page</h4>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/skin_editor.jpg">
		</div>
	</div>
	
	<hr />
	
	<h3>2. Creating custom skins</h3>
	<div class="row">
		<div class="span6">
			<p>Some of the visual aspects of the slider can be customized only by editing the slider's CSS. However, if you need to do CSS edits, it's recommended to create your own custom skin instead of modifying one of the default skins. You can duplicate one of the existing skins and then add your edits to the custom skin.</p>
     
	 		<p>To create an exact copy of a skin, click the 'Replicate Skin' button and insert some information for the new skin. This will create an exact copy of the original skin but it will modify the header information and the class selectors, according to the values provided by you. At this point, the two skins will apply the same styling, so let's start making some modifications. For example let's change the border color to red and the background color to black.</p>

	 		<p>You will be able to select this custom skin when you create or edit a slider.</p>
		</div>
		
		<div class="span6">
			
<pre class="prettyprint linenums">
/*
    Skin Name: My Custom Skin
    Class: my-custom-skin
    Description: Custom skin for Advanced Slider jQuery plugin
    Author: David
*/


/* MAIN SLIDE */

.my-custom-skin .slide-wrapper
{
    background-color: #000;
    border: 8px solid #FFF;
    -moz-box-shadow: 0px 0px 10px #000;
    -webkit-box-shadow: 0px 0px 10px #000;
    box-shadow: 0px 0px 10px #000;
}
</pre>

		</div>
	</div>
	
	<hr />

	<h3>3. Adding custom CSS to sliders</h3>
	<div class="row">
		<div class="span6">			
			<p>Sometimes you only want to make some minor edits to a specific slider an you don't want to create a new custom skin for that, or modify one of the existing skin. Slider PRO offers you this possibility too. Inside the 'Custom JavaScript & CSS' sidebar panel you can click on the 'Edit custom CSS' link and a modal window will be opened where you can add your custom code. You will also need to check the 'Enable custom CSS' option in order to have the custom code applied to the slider. When you want to remove the code you can simply uncheck this option, without having to delete the code. Another important aspect of this feature is the 'Custom Class' field where you need to specify a unique identifier for the slider. You will use this identifier to reference the slider in your custom CSS code. In the images on the right you can see how the 'Custom JavaScript & CSS' panel and the modal window for editing the code look like.</p>
			<p>When you add custom CSS code to a slider, a css file containing that code will be created in /plugins/slider-pro/custom/slider-pro-ID/slider-pro-ID-css.css, where ID is the actual ID of the slider.</p>
		</div>
		
		<div class="span6"> 
       		<h5>Custom CSS panel</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/custom_css_panel.jpg">
			<br />
			<br />
			<h5>Custom CSS code window</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/custom_css_window.jpg">
		</div>
	</div>

</section>


<hr />


<section id="dynamic">
	<div class="page-header">
		<h1>Dynamic slides</h1>
	</div>
	
	<p>One of the most important features of Slider PRO is its ability to automatically fetch data from your posts. This allows you to create dynamic slides which update every time you insert a certain type of data. There are 2 types of dynamic slides: slides that are created by fetching data from your posts based on certain taxonomies and parameters, and slides that are creating using a post's gallery of images as a source. For either type of dynamic slide you will first need to use the provided options to select where the content will be fetched from and then you will have to use the slider's dynamic tags to specify where the fetched data should appear. The following sub-chapters will explain each step. Whether you're trying to create a Posts Content slide or a Gallery Images slide, please read both sub-chapters because the steps for creating each of these slides are similar.</p>
	
	<h3>1. Posts Content slides</h3>
	<div class="row">
		<div class="span5">
			<p>To use this type of slides you need to set the 'Slide Type' option to 'Posts Content'. As soon as you do that, some controls will appear. You will use those controls to select from which posts will the data be fetched.</p>
			
			<p>From the 'Post Types' dropdown you can select which posts to fetch data from. Here you will see the default post types: Posts and Pages but also custom post types.</p>
			
			<p>Based on the selected post types, the taxonomies associated with those posts will appear in the 'Post Taxonomies' menu. Please note that the post types and taxonomies will appear only if they are attached to at least one post.</p>
			
			<p>The 'Relation' option will allow you to specify whether the posts need to have all the selected taxonomies or at least one of the selected taxonomies.</p>
			
			<p>The 'Order By' option allows you to sort the slides based on the selected criteria and the 'Order' option will allow you to sort the slide in ascending or descending order.</p>
			<p>You can use the 'Maximum' option to indicate how many posts will the data be fetched from and the 'Offset' option to indicate the index/position from where the fetching will start.</p>
			
			<p>The 'Featured' option will allow you to fetch data only from certain posts, posts for which the 'Feature this post' option was checked in the slider's metabox that appears on all posts. The metabox looks like in the image on the right. Please note that it's not necessary to check this option in the metabox in order to have a post fetched. This metabox will only allow you to filter the posts even more.</p>
			
			<p>Setting the above options is the first step in creating the dynamic slide. The second step is to specify where the fetched content will be displayed. For example, you might want to have the featured image displayed as a main slide image, or you might want to display it somewhere in the Inline HTML section. Also, you might want the title of the post to be used as an 'alt' attribute for the image or as a 'title' attribute.</p> 
			
			<p>The slider gives you the flexibility to choose where the fetched content will be displayed by providing you with several tags, which you will simply insert in the slide's fields. For example if you want the slide image to appear as the main slide, you will insert [sp_image] in Image -> Path or if you want the image to appear in the HTML section you will enter [sp_image] somewhere in the HTML editor.</p>

		</div>
		
		<div class="span7">
			<h5>Posts Content</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_posts_content.jpg">
			<br />
			<br />
			<h5>Slider metabox in all posts</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slider_metabox.jpg">
		</div>
	</div>


	<h4>Dynamic tags presentation</h4>

	<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="230">Tag</th>
						<th>Description</th>
					</tr>
				</thead>
				
				<tbody>
		        	<tr>
						<td>[sp_image]</td>
						<td>Returns the URL of the featured image, if it exists for the post, or of the first image from the post. It also has a 'size' argument which can take the following values: full, large, medium, small. You can use the 'size' argument to load the full image version as the main slide image and the small image as a thumbnail. Example: [sp_image size="small"]</td>
		            </tr>
					
					<tr>
						<td>[sp_image_alt]</td>
						<td>Returns the alt text of the image.</td>
		            </tr>
		            
					<tr>
						<td>[sp_image_title]</td>
						<td>Returns the title of the image.</td>
		            </tr>
		            
					<tr>
						<td>[sp_image_caption]</td>
						<td>Returns the specified caption for the image.</td>
		            </tr>
		            
					<tr>
						<td>[sp_image_description]</td>
						<td>Returns the specified description for the image.</td>
		            </tr>
		            
		            <tr>
						<td>[sp_title]</td>
						<td>Returns the title of the post.</td>
		            </tr>

		            <tr>
						<td>[sp_link]</td>
						<td>Returns the URL of the post.</td>
		            </tr>

		            <tr>
						<td>[sp_date]</td>
						<td>Retursn the data of the post in the format specified in Settings -> General -> Date Format.</td>
		            </tr>

		            <tr>
						<td>[sp_content]</td>
						<td>Returns the content of the post. If the quicktag &lt;!--more--&gt; is used in a post to designate the "cut-off" point for the post to be excerpted, the_content() tag will only show the excerpt up to the &lt;!--more--&gt; quicktag point. You can use the 'more_text' argument to set a certain text to be displayed instead of the default 'continue reading' text. Example [sp_content more_text="Read More..."]</td>
		            </tr>

		            <tr>
						<td>[sp_excerpt]</td>
						<td>Returns the excerpt of the post. You can use the 'limit' argument to set a limit for the number of characters that will be displayed. Example [sp_excerpt limit="140"]</td>
		            </tr>

		            <tr>
						<td>[sp_author_name]</td>
						<td>Returns the name of the post's author.</td>
		            </tr>
					
					<tr>
						<td>[sp_author_posts]</td>
						<td>Returns the URL to the author's posts.</td>
		            </tr>

					<tr>
						<td>[sp_comments_number]</td>
						<td>Returns the number of comments that a post has. Be default, if there is no comment it will return 'No Comment', if there's a single comment it will return '1 Comment' and if there are more than one comment, it will return '% Comments'. However, you can specify your own custom text by using the 'zero', 'one' and 'more' arguments. Example: [sp_comments_number zero="No comments yet" one="Just a single comment" more="Plenty of comments"]</td>
		            </tr>
					
					<tr>
						<td>[sp_comments_link]</td>
						<td>Return the URL to the post's comments.</td>
		            </tr>		            

		            <tr>
						<td>[sp_custom name="property_name"]</td>
						<td>Return the value of a custom property added in the post's custom fields. Example [sp_custom name="product_price"]</td>
		            </tr>
				</tbody>
	</table>

	<h4>Dynamic tags examples:</h4>

	<p>Load the feature image as a main image for the slide and set the 'alt' and 'title' attributes for the image.</p>
	<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/dynamic_slide_image.jpg">
	<br />
	<br />
	<p>Insert the post title, the date of the post and the excerpt of the post in the slide's caption.</p>
	<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/dynamic_slide_caption.jpg">
	<br />
	<br />
	<p>Set the link of the main slide image to be the link of the post and set the link's title to the title of the post.</p>
	<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/dynamic_slide_links.jpg">

	<p>Please note that these are just a few variations. You can use the dynamic tags in any of the slide's fields and in any combination.</p>

	<hr />

	<h3>2. Gallery Images slides</h3>
	<div class="row">
		<div class="span5">
			<p>This type of dynamic slide also provides a few controls. The 'Post' option allows you to specify the ID of the post from where images will be fetched. If you leave this option to -1, the images will be fetched from the post where the slider is inserted. This would probably be the most common use but for flexibility you can also fetch images from a different post. The 'Maximum' option sets the maximum number of images that will be loaded and the 'Offset' sets the index/position from where the fetching will start.</p>
			<p>As with 'Posts Content' slides, selecting where data should be fetched from is only the first step. Next you will need to use the slider's dynamic tags to specify where the fetched data should be displayed. Please see the previous sub-chapter for a presentation of these dynamic tags and how they should be used.</p>
			<p>The dynamic tags available for the 'Gallery Images' slides are: [sp_image], [sp_image_alt], [sp_image_title], [sp_image_caption] and [sp_image_description].</p>
		</div>
		
		<div class="span7">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_gallery_images.jpg">
		</div>
	</div>

</section>


<hr />


<section id="miscellaneous">
	<div class="page-header">
		<h1>Miscellaneous topics</h1>
	</div>
	
	<p>This chapter will cover several topics like how to use the preview window, how to have the videos automatically handled, how to translate the plugin to a different language, and more.</p>

	<h3>1. Preview window</h3>
	<div class="row">
		<div class="span6">
			<p>The preview window is a very useful feature of the slider. First, it shows you how the slide will look without having to publish it first and second, it helps you to set the size of the slide image itself to the desired values.</p>
			<p>In the image on the right you notice that in the bottom left corner you have the size for the slider and below it, the size for the slide. If you try to edit the height of the slide, the height of the slider will automatically adjust, so if you want to have a slide image with the height of 400px, you just specify this value in the size of the slide and you will immediately see the height that the slider itself needs to have. Once you have the desired size for your slider, you can simply click on the 'Copy Values' button and the values of the width and height from the preview window will be copied in the 'General' panel. You can also preview the slider at the different sizes by clicking the 'Preview Size' button.</p>
		</div>
		
		<div class="span6">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slider_preview_window.jpg">
		</div>
	</div>

	<hr />

	<h3>2. Automatic video handling</h3>
	<div class="row">
    	<div class="span3">
			<p>Not only you can insert videos inside the slides but Slider PRO has built-in support for automatic handling of those videos. For example, the slider will pause or stop a video when you navigate away from the slide, or it will pause or stop the automatic slideshow when a video starts playing. Without this automatic handling you would have to manually pause/stop the video or pause/stop the slideshow, which isn't very convenient.</p>
			<p>The slider has built-in support for YouTube videos, Vimeo videos, simple HTML5 videos, and HTML5 videos enhanced with VideoJS. VideoJS is a 3rd party library that will enhance the look of the HTML5 video and will provide a Flash fallback for browsers that don't support the HTML5 video element, like IE8 and below.</p>
			<p>The HTML code for the videos must be inserted in the slide's 'Inline HTML' section. In the example code on the right you can see how to insert each type of videos. Please note that in order to have the videos automatically handled you also need go to the 'Videos' sidebar panel and enable the controllers for the videos that you will load.</p>
		</div>
		
		<div class="span9">
			<h5>YouTube videos</h5>
			<p>First, you need to get the embed code from the YouTube page. The code will be an iframe, to which you will need to add the "video" class. Also, to the URL of the video you will need to append the following parameters: "enablejsapi=1" and "wmode=transparent". The first parameter is necessary in order to enable the automatic handling and the second parameter is necessary if the video loads in the flash player.</p>
<pre class="prettyprint linenums">
&lt;iframe class=&quot;video&quot; src=&quot;http://www.youtube.com/embed/msIjWthwWwI?rel=0&enablejsapi=1&wmode=transparent&quot; width=&quot;580&quot; height=&quot;380&quot; frameborder=&quot;0&quot;&gt;&lt;/iframe&gt;
</pre>

			<h5>Vimeo videos</h5>
			<p>For Vimeo videos you need to get the embed code from Vimeo and add the "video" class to the iframe, just like with YouTube videos. Then, append "api=1" to the URL of the video.</p>
<pre class="prettyprint linenums">
&lt;iframe class=&quot;video&quot; src=&quot;http://player.vimeo.com/video/3116167?api=1&quot; width=&quot;580&quot; height=&quot;380&quot; frameborder=&quot;0&quot;&gt;&lt;/iframe&gt;
</pre>

			<h5>HTML5 videos</h5>
			<p>When you insert simple HTML5 videos, you just need to add the "video" class to the &lt;video&gt; tag.</p>
<pre class="prettyprint linenums">
&lt;video class=&quot;video&quot; controls preload=&quot;none&quot; width=&quot;580&quot; height=&quot;380&quot;
	   poster=&quot;http://bqworks.com/products/assets/videos/bbb/bbb-poster.jpg&quot;&gt;
  &lt;source src=&quot;http://bqworks.com/products/assets/videos/bbb/bbb-trailer.mp4&quot; type=&quot;video/mp4&quot;/&gt;
  &lt;source src=&quot;http://bqworks.com/products/assets/videos/bbb/bbb-trailer.ogg&quot; type=&quot;video/ogg&quot;/&gt;
&lt;/video&gt;
</pre>

			<h5>VideoJS videos</h5>
			<p>Loading VideoJS enhanced HTML5 videos is similar to loading simple HTML5 videos but in addition to adding the "video" class you need to add some VideoJS specific classes. Also, you will need to give the video a unique ID and add the "data-video" attribute.</p>
<pre class="prettyprint linenums">
&lt;video id=&quot;video-1&quot; class=&quot;video video-js vjs-default-skin&quot; controls=&quot;controls&quot; preload=&quot;none&quot; width=&quot;580&quot; height=&quot;380&quot;
	   poster=&quot;http://bqworks.com/products/assets/videos/sintel/sintel-poster.jpg&quot; data-video=&quot;{}&quot;&gt;
  &lt;source src=&quot;http://bqworks.com/products/assets/videos/sintel/sintel-trailer.mp4&quot; type=&quot;video/mp4&quot;/&gt;
  &lt;source src=&quot;http://bqworks.com/products/assets/videos/sintel/sintel-trailer.ogv&quot; type=&quot;video/ogg&quot;/&gt;
&lt;/video&gt;
</pre>
		</div>
	</div>

	<hr />

	<h3>3. Responsive slider</h3>
	<div class="row">
		<div class="span12">
			<p>In order to make a slider responsive, you will need to set its Width and Height options to percentage values, for example 100%. When you set the Width and Height to 100%, it will make the slider adjust to fill its container entirely. Please note that sometimes the container has a height of 0px so when you set the slider to be a certain percentage from 0px, the height will become 0px. So, in order to properly create a responsive slider, there are several solutions:</p>

			<p>1. Set the 'Scale' option to 'Proportional'.</p>

			<p>2. You can also set a minimum and/or maximum size for the slider. In order to do this, please go to the 'Custom JavaScript & CSS' sidebar panel, set a custom class for the slider like 'my-slider' (without quotes), check the 'Enable custom CSS' option, and then click on the 'Edit custom CSS' link. Inside the modal window add the following code:</p>

<pre class="prettyprint linenums">
.my-slider {
    max-width: 500px;
    max-height: 500px;
    min-height: 100px;
    min-width: 100px;
}
</pre>

			<p>3. If you want the height of the images to be automatically set based on the width, you can also add some custom JavaScript code, just like you added the CSS code. The JavaScript code that you need to add is this:</p>

<pre class="prettyprint linenums">
jQuery(document).ready(function($){                                
    // set the initial height of the slider to 50% from the width
    $('.my-slider').css('height', $('.my-slider').width() * 0.50);
    $('.my-slider').advancedSlider().doSliderLayout();

    // as the window resizes, maintain the slider's height at 50% from the width
    $(window).resize(function() {
        $('.my-slider').css('height', $('.my-slider').width() * 0.50);
    });                     
});
</pre>

			<p>The above code will maintain the height of the slider at 50% from the width.</p>
		</div>
	</div>

	<hr />

	<h3>4. CSS3 transitions</h3>
	<div class="row">
		<div class="span12">
			<p>The slider gives you the possibility to use CSS3 transitions by simply setting the 'CSS3 Transitions', from the 'Transition Effects' sidebar panel, to true. Please note that this feature requires a recent version of the jQuery library, preferably jQuery 1.7+. If you enable the feature but use an older jQuery version, the transition effects will not work.</p>
		</div>
	</div>

	<hr />

	<h3>5. Translating the plugin</h3>
	<div class="row">
		<div class="span6">
			<p>There are several tools for translating but I will show you how to do this using <a href="http://www.poedit.net/">Poedit</a>. First, download and install the software.Open Poedit and go to File -> Open and browse to slider-pro/languages/slider_pro.po. Then go to File -> Save As and save the file using a name that corresponds to the language in which you're translating the plugin. For example, if you translate the plugin to German, save the file as "slider_pro-de_DE"; if you're translating it to French, save the file as "slider_pro-fr_FR". After saving the file, you're ready to begin translating the plugin. All you have to do is click on the string that you want to translate, and write the translation for it in the second box, below the English version.</p>
		</div>
		
		<div class="span6">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/translation.jpg">
		</div>
	</div>

	<hr />

	<h3>6. Custom JavaScript code</h3>
	<div class="row">
		<div class="span12">
			<p>You saw in a preview chapter how to use custom CSS code. There are many times when you'll use custom CSS but not so many when you need to use custom JavaScript. However, if you need this, the slider allows you to easily add the necessary code. Just like adding custom CSS, you will need to specify a unique identifier in the 'Custom Class' field, check the 'Enable custom JS' option and then insert the code by clicking on the 'Edit custom JS' link. A js file containing that code will be created in /plugins/slider-pro/custom/slider-pro-ID/slider-pro-ID-js.js, where ID is the actual ID of the slider.</p>
			<p>When you want to use custom JavaScript code, you also need to know a few things about the slider's JavaScript API. Slider PRO is built in top of Advanced Slider, a jQuery slider plugin and Advanced Slides provides you several methods/functions and callback function/events that allow you to manipulate the slider.</p>

			<h5>Public Methods</h5>
			
			<p>The public methods will allow you to manipulate the slider using external controls. This is a very useful capability if you want to integrate the slider with other applications or elements from the page.</p>

			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Method Name</th>
						<th>Description</th>
					</tr>
				</thead>
				
				<tbody>
		        	<tr>
						<td>nextSlide()</td>
						<td>Opens the next slide.</td>
		            </tr>
					
					<tr>
						<td>previousSlide()</td>
						<td>Opens the previous slide.</td>
		            </tr>
		            
					<tr>
						<td>gotoSlide(index)</td>
						<td>Opens the slide at the specified index.</td>
		            </tr>
		            
					<tr>
						<td>startSlideshow()</td>
						<td>Starts the slideshow mode.</td>
		            </tr>
		            
					<tr>
						<td>stopSlideshow()</td>
						<td>Stops the slideshow mode.</td>
		            </tr>
		            
					<tr>
						<td>pauseSlideshow()</td>
						<td>Pauses the slideshow.</td>
		            </tr>
		            
					<tr>
						<td>resumeSlideshow()</td>
						<td>Resumes the slideshow.</td>
		            </tr>
					
					<tr>
						<td>scrollToThumbnailPage()</td>
						<td>Moves the thumbnail scroller to the specified page.</td>
		            </tr>	
				
					<tr>
						<td>scrollToNextThumbnailPage()</td>
						<td>Moves the thumbnail scroller to the next page.</td>
		            </tr>
				
					<tr>
						<td>scrollToPreviousThumbnailPage()</td>
						<td>Moves the thumbnail scroller to the previous page.</td>
		            </tr>
				
					<tr>
						<td>startThumbnailMouseScroll()</td>
						<td>Starts the mouse scrolling functionality.</td>
		            </tr>
				
					<tr>
						<td>stopThumbnailMouseScroll()</td>
						<td>Stops the mouse scrolling functionality.</td>
		            </tr>
				
					<tr>
						<td>startThumbnailMouseWheel()</td>
						<td>Starts the mouse wheel functionality.</td>
		            </tr>
				
					<tr>
						<td>stopThumbnailMouseWheel()</td>
						<td>Stops the mouse wheel functionality.</td>
		            </tr>
				
					<tr>
						<td>doSliderLayout()</td>
						<td>Forces the slider to re-position all elements. The position of the elements depends on the specified width, height, scaleType and alignType.</td>
		            </tr>
				
					<tr>
						<td>getSlideshowState()</td>
						<td>Gets the current slideshow state. Returns 'playing', 'paused' or 'stopped'.</td>
		            </tr>
		            
					<tr>
						<td>getCurrentIndex()</td>
						<td>Gets the index of the current slide.</td>
		            </tr>
		            
					<tr>
						<td>getSlideAt(index)</td>
						<td>Gets all the data of the slide at the specified index. Returns an object that contains all the data specified for that slide.</td>
		            </tr>
		            
					<tr>
						<td>getTriggerType()</td>
						<td>Returns a string that indicates what triggered the slider to navigate to a different slide. Possible values are: 'none', 'previousButton', 'nextButton', 'button', 'slideshow' and 'thumbnail'.</td>
		            </tr>
					<tr>
						<td>isTransition()</td>
						<td>Checks if the slider is in the transition phase. Returns true or false.</td>
		            </tr>
		            
					<tr>
						<td>getTotalSlides()</td>
						<td>Returns the total number of slides.</td>
		            </tr>
		            
					<tr>
						<td>getSize()</td>
						<td>Returns an object that contains the width and height of both the slider and the slide. The returned object has the following properties: sliderWidth, sliderHeight, slideWidth and slideHeight.</td>
		            </tr>
					
					<tr>
						<td>destroy()</td>
						<td>Stops all running actions. It's recommended to call this method before removing the slider from the DOM.</td>
		            </tr>
				</tbody>
				
			</table>


			<p>When you want to call one of these action you need to use the unique identifier you set in the custom class field. Example: $('.my-slider').advancedSlider().nextSlide();</p>
			
			<h5>Callbacks</h5>
	
		  	<p>The callbacks, or events, are useful for detecting when certain actions take place. For example we can detect when a transition is complete or when a slide was clicked. Below is a list of all the available callbacks.</p>
			
			
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Callback Name</th>
						<th>Description</th>
					</tr>
				</thead>
				
				<tbody>
		        	<tr>
						<td>transitionStart</td>
						<td>Triggered when a transition starts.</td>
		            </tr>
					
					<tr>
						<td>transitionComplete</td>
						<td>Triggered when a transition is complete.</td>
		            </tr>
		            
					<tr>
						<td>slideRequest</td>
						<td>Triggered when a slide is requested/called.</td>
		            </tr>
		            
					<tr>
						<td>slideClick</td>
						<td>Triggered when a slide is clicked.</td>
		            </tr>
		            
					<tr>
						<td>slideMouseOver</td>
						<td>Triggered when the mouse is rolled over a slide.</td>
		            </tr>
		            
					<tr>
						<td>slideMouseOut</td>
						<td>Triggered when the mouse is rolled out of a slide.</td>
		            </tr>
					
					<tr>
						<td>thumbnailClick</td>
						<td>Triggered when a thumbnail is clicked.</td>
		            </tr>
					
					<tr>
						<td>thumbnailMouseOver</td>
						<td>Triggered when the mouse is rolled over a thumbnail.</td>
		            </tr>
					
					<tr>
						<td>thumbnailMouseOut</td>
						<td>Triggered when the mouse is rolled out of a thumbnail.</td>
		            </tr>
					
					<tr>
						<td>xmlLoaded</td>
						<td>Triggered when the XML file is completely loaded.</td>
		            </tr>
					
					<tr>
						<td>doSliderLayout</td>
						<td>Triggered when the layout is modified.</td>
		            </tr>
				</tbody>
			</table>
					
		         
		 	<p>Most of these callback functions will return an object that contain certain information. The slide related callbacks, for example, will contain information about the slide that triggered the event. The information contained is the index of the slide(0, 2, 5 etc.), the type of event(slideClick, transitionComplete etc.) and a 'data' object that contains all the slide's information that was specified for that slide. You can use a callback function as you see in the example below:</p>

<pre class="prettyprint linenums">
jQuery(document).ready(function($) {
    $('.my-slider').advancedSlider().settings.transitionComplete = function(obj) {
        console.log('You are viewing slide ' + obj.index);
        console.log(obj.type, obj.data);
    };


    $('.my-slider').advancedSlider().settings.doSliderLayout = function(obj) {
        console.log($('.my-slider').advancedSlider().getSize());
    };
});
</pre>


			<p>The cases when you'll need to use the slider's JavaScript API are very rare because Slider PRO already offers you easier ways to achieve a lot of functionality. However, just in case you need to use the slider in a different way, not covered by the slider's easy to use features, you have access to the above API which will allow you to achieve almost any kind of functionality.</p>

		</div>
	</div>



</section>


<hr />


<section id="troubleshooting">
	<div class="page-header">
		<h1>Troubleshooting <small>Answers to some of the common problems</small></h1>
	</div>
	
	<p>If something doesn't work as expected, the first thing you need is a little patience :) and the assurance that you have my free assistance for resolving the problem. Please see if the indications below help, and if they don't please kindly email me and I'll gladly help you.</p>
	
	<h4 id="troubleshooting1">1. The slider doesn't appear on the page</h4>
	
	<p>First please make sure that your theme has the wp_head() and wp_footer() calls. These calls are used by many plugins, including this slider, to insert the necessary scrips in the page.</p>
	
	<p>The wp_head() call should be in the theme's header.php call just above &lt;/head&gt; :</p>

<pre class="prettyprint linenums">
&lt;?php wp_head(); ?&gt;
&lt;/head&gt;
</pre>

	<p>The wp_footer() call should be in the theme's footer.php call just above &lt;/body&gt; :</p>

<pre class="prettyprint linenums">
&lt;?php wp_footer(); ?&gt;
&lt;/body&gt;
</pre>
	
	<p>If the slider still doesn't work it's possible that it conflicts with another plugin or theme that doesn't follow WordPress development best practices. Although, it's not the slider's fault, I can help you sort out these kind of problem. Just email me (my email address is at the top of this help file) some WordPress and FTP credentials.</p>
    
	<hr />
	
	<h4 id="troubleshooting2">2. The slider loads but doesn't respond to input</h4>
    
    <p>It can happen when you're loading an older jQuery library in the page and use CSS3 transitions at the same time. In order for the CSS3 transitions to work, you need a recent release of the jQuery library, preferably version 1.7+. If you can't use a newer jQuery library, you will need to disable the CSS3 Transitions. This option can be found inside the Transition Effects sidebar panel.</p>
    
	<hr />

    <h4 id="troubleshooting3">3. The images are not loading</h4>
    
    <p>This is most likely a TimThumb related problem. TimThumb is a popular 3rd party script used for automatically resizing images and will work out of the box on most servers but on others it requires some 'special attention'. By default, the slider uses TimThumb only for creating the thumbnail images but it's not dependent on this script, so you can disable it from within the Slider PRO -> Plugin Options page. If TimThumb is disabled and you need thumbnail images, you will need to manually create them.</p>
	
	<p>There can be various reasons why a server won't allow TimThumb to run properly. First, please make sure that the 'cache' folder (/wp-content/plugins/slider-pro/includes/timthumb/cache) has the permission set to '755' or '777' (on some servers 777 is necessary). If you're using HostGator as your hosting provider, you will need to contact them and request 'mod_security whitelisting'. Please read this: http://support.hostgator.com/articles/specialized-help/technical/timthumb-basics</p>
	
	<p>If the above solutions don't work please email me (my email address is at the top of this help file) some WordPress and FTP credentials and I'll take a closer look.</p>
    
	<hr />
	
    <h4 id="troubleshooting4">4. External images don't load, only uploaded images</h4>

    <p>The default TimThumb settings will not allow you to load external images. In order to enable this functionality, you will need to open the 'timthumb-config.php' file (/wp-content/plugins/slider-pro/includes/timthumb/timthumb-config.php) and set the 'ALLOW_EXTERNAL' and 'ALLOW_ALL_EXTERNAL_SITES' variables to 'TRUE'.</p>
	
	<hr />

	<h4 id="troubleshooting5">5. The self-hosted, HTML5 videos don't play</h4>

    <p>It can happen if the server is not configured to deliver the types of videos you're trying to play. In order to make this possible, open the .htaccess file from your site's root folder, or create it if it doesn't exist, and add the following lines:

<pre>
AddType video/ogg .ogm
AddType video/ogg .ogv
AddType video/ogg .ogg
AddType video/webm .webm
AddType audio/webm .weba
AddType video/mp4 .mp4
AddType video/x-m4v .m4v
</pre>

	<p>If the videos still don't play, it could happen because the server is set to not read the .htaccess file. In this case, you might need to contact the hosting provider and ask them to add the above mime types for you.</p>
	
	<hr />
	
    <h4 id="troubleshooting6">6. When I use the slider widget or the slider_pro(index) function in the template's PHP code, the slider appears broken.</h4>
    
    <p>Most likely you will have to set the 'Include Skin' property from the 'General' panel to true. Normally, when the slider is added to a post or page, the skin's CSS file is automatically detected and included in the header only on the slider's page, but when using the slider outside the post/page, the WordPress API doesn't give you the possibility to efficiently detect the slider instance added to a page in order to add the necessary CSS file to the header, so you need specify that you want the CSS file included by checking the 'Include Skin' option.</p>
    
	<hr />
	
    <h4 id="troubleshooting7">7. I get an error when I create or update the slider</h4>

    <p>Please make sure that the 'xml' folder (/wp-content/plugins/slider-pro/xml) has the permission set to '755' or '777' (on some servers 777 is necessary). If you still get an error after this edit, please contact your hosting provider and aks them if the XML-DOM library is installed. This library is used by the plugin to save each slider in an XML format, which allows you to export and import sliders. You can disable this feature if you want from within the Slider PRO -> Plugin Options page.</p>
	
	<hr />
	
    <h4 id="troubleshooting8">8. Sidebar panels disappear after I update the slider.</h4>

    <p>This can only happen if you create many slides for your slider, and it happens because some server variables are set to low values. To prevent this type of problems, you will need the 'post_max_size' variable to be set to a higher value, like 64M. That variable can be found in the php.ini file, in case you have access to it. If not, please contact your hosting provider and ask them to increase the value for you. Also, if the server has 'suhosin' installed, please request that the suhosin.request.max_vars and suhosin.post.max_vars variables be set to something like 3000 or higher. After these edits are done it's necessary to recreate the affected sliders. </p>
	
	</section>

</div>