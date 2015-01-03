<?php

		$servername = "localhost";
		$username = "root";
		$password = "google60";
		$db_name = "postbox";

		$conn = mysqli_connect($servername, $username, $password, $db_name);			

		if (!$conn) {
			echo 0; // error at connection
		} else {

			if( $_GET['subParam'] === 0 ) {		// post to a club
				
				$query = 'SELECT subgroupID FROM subgroups WHERE subgroupname = '.$_GET['subgroupname'].'';

				$result = mysqli_query($conn, $query);

				if (mysqli_num_rows($result) > 0) {

					while($row = mysqli_fetch_assoc($result)) {

						$subgroupID = $row['subgroupID'];
					}

				}

				$query = 'INSERT INT0 post VALUES ('.$_GET['userID'].','.$_GET['text'].','.$subgroupID.', CURDATE())';
				$result = mysqli_query($conn, $query);
				
				if ($result) {
					echo "posted to the club";
				} else {
					echo "error";
				}	

			} else if( $_GET['subParam'] === 1 ) {	// post to inbox
				
				$query = 'INSERT INT0 personal VALUES ('.$_GET['fromID'].','.$_GET['toID'].','.$_GET['text'].', CURDATE())';
				$result = mysqli_query($conn, $query);
				
				if ($result) {
					echo "posted to inbox";
				} else {
					echo "error";
				}	

			}

			mysqli_close($conn);

		}		
?>
