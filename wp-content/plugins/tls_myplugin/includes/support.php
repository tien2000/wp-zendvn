<?php

class TlsMpSupport{

	public static function showFunc($tag=false){
		global $wp_filter;
		if ($tag) {
			$hook[$tag]=$wp_filter[$tag];
			if (is_array($hook[$tag])) {
				trigger_error("Nothing found for '$tag' hook", E_USER_WARNING);
				return;
			}
		}
		else {
			$hook=$wp_filter;
			ksort($hook);
		}

		echo '<div style="color: black;font-family: Courier New;">';
		foreach($hook as $tag => $priority){
			echo "Hook Name: <strong>$tag</strong><br /><br />";
			ksort($priority);
			foreach($priority as $priority => $function){
				$comma_flag = 0;
				echo $priority.": ";
				foreach($function as $name => $properties){
					if($comma_flag > 0) {
						echo ", ";
					}
					echo "$name";
					$comma_flag++;
				}
				echo "<br />";
			}
		}
		echo '</div>';
		return;
	}
}