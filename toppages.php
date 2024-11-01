<?php
/*
Plugin Name: TopPages
Plugin URI: http://amplifiedprojects.com/projects/top-pages-wordpress-widget/
Description: A plugin to display the Top Pages in a list
Version: 1.0
Author: Amanda Chappell
Author URI: http://amplifiedprojects.com
*/

/*  Copyright 2009  Amanda Chappell  (email : amanda@amplifiedprojects.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



function widget_TopPagesPB($args) 
{
	extract($args);
	global $wp_query;
	$options = get_option("widget_toppages");
	$thePostID = $wp_query->post->ID;
	echo $before_widget;
	echo $before_title;
	echo $options['title'];
	echo $after_title;
?>
<ul>
<li> <a href="<?php echo get_option('home'); ?>" title="Home">Home</a></li>  
<?php
	
	wp_list_pages ('title_li=&depth=1');
?>
</ul>
<?php
	echo $after_widget;
}

function TopPages_control(){
	$options = get_option("widget_toppages");

	if(!is_array($options)){
		$options = array('title' => 'TopPages');
	}
	if($_POST['toppages-Submit']){
		$options['title'] = htmlspecialchars($_POST['toppages-WidgetTitle']);
		
		update_option("widget_toppages",$options);
	}

	echo '<p>
			<label for="toppages-WidgetTitle">Widget Title: </label>
			<input type="text" id="toppages-WidgetTitle" name="toppages-WidgetTitle" value="';
	echo $options['title'];
	echo '" />
			<input type="hidden" id="toppages-Submit" name="toppages-Submit" value="1" />
		</p>';
}

function topPagesPB_init()
{
  	register_sidebar_widget(__('TopPages Display'), 'widget_TopPagesPB');
	register_widget_control('TopPages Display','toppages_control');
}

add_action("plugins_loaded", "topPagesPB_init");

?>