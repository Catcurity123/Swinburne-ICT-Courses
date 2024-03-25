<?php
	
	//this file is used to manage page number of 2 list: Friend List and Add Friends

	echo "<div class=\"pageStyle\">";
	echo "<ul>";
	// Previous Page button
	if (array_key_exists(($page - 1), $allPages)) {
		$previous = $page - 1;
		echo "
            <li class=\"page\" id=\"previous\">
            	<a class=\"displayed\" href=\"?page={$previous}\">← Previous</a>
            </li>
        ";
	}

	//Next Page button
	if (array_key_exists(($page + 1), $allPages)) {
		$next = $page + 1;
		echo "
            <li class=\"page\" id=\"next\">
            	<a class=\"displayed\" href=\"?page={$next}\">Next →</a>
            </li>
        ";
	}
	echo "</ul>";
	echo "</div>";
?>