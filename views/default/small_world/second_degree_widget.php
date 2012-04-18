<?php 
	global $CONFIG;
	global $small_world_shared_friends;
	$max_visible_connections = 5;
	
	echo "<div>";
		echo "<div class='collapsable_box'>";
			echo "<div class='collapsable_box_header'>";
				echo "<h1>" . elgg_echo('small_world:second_degree_widget:title') . "</h1>";
			echo "</div>";
			echo "<div class='collapsable_box_content'>";
				echo "<div class='contentWrapper'><center>";
				echo "<b>" . elgg_echo('small_world:second_degree_widget:you') . "</b><br />";
				echo "<img src='" . $CONFIG->wwwroot . "mod/small_world/_graphics/arrowdown.gif'><br />";
				$i = 0;
				foreach($small_world_shared_friends as $friend){
					if($i < $max_visible_connections){
						echo "<a href='" . $friend->getURL() . "'>" . $friend->name . "</a><br />";
					} else {
						$more .= "<a href='" . $friend->getURL() . "'>" . $friend->name . "</a><br />";
					}
					$i++;
				}
				if($more){
					echo "<span id='second_degree_more_connections_link'>";
					echo "<a href=\\\"javascript:$('#second_degree_more_connections_link').hide();$('#second_degree_more_connections').show();void(0);\\\">more (" . ($i - $max_visible_connections) . ")</a><br />";
					echo "</span>";
					echo "<span id='second_degree_more_connections' style='display:none;'>";
					echo $more;
					echo "</span>";
				}
				
				echo "<img src='" . $CONFIG->wwwroot . "mod/small_world/_graphics/arrowdown.gif'><br />";
				echo page_owner_entity()->name . "<br />";
				echo "</center></div>";			
			echo "</div>";
		echo "</div>";
	echo "</div>";
?>