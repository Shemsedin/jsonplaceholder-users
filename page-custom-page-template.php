<?php
/**
 * Template Name: EndpointUsers
 */

get_header();
global $skeleton;
$skeleton->run();
?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<h1>Jsonplaceholder User's Data</h1>
			<?php
			echo $skeleton->displayUsers()
			?>
		</div>
	</div>
</div>
<?php
get_footer();
?>
