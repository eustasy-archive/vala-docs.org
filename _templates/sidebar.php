<ul>
	<?php
		foreach($page["sidebar"] as $sub) {
			echo "<ul>";

			foreach($sub as $item) {
				echo $item;
			}

			echo "</ul>";
		}
	?>
</ul>
