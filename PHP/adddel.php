<?php

		$servername = "localhost";
		$username = "root";
		$password = "google60";
		$db_name = "postbox";

		$conn = mysqli_connect($servername, $username, $password, $db_name);			

		if (!$conn) {
			echo 0; // error at connection
		} else {

			if( $_GET['subParam'] === 0 ) {		// delete a user from subgroup
				
				$query = 'DELETE FROM member WHERE userID = '.$_GET['userID'].'';
				$result = mysqli_query($conn, $query);
				
				if ($result) {
					echo "deleted";
				} else {
					echo "error";
				}	

			} else if( $_GET['subParam'] === 1 ) {	// add a user to subgroup
				
				$query = 'SELECT subgroupID FROM subgroups WHERE subgroupname = '.$_GET['subgroupname'].'';

				$result = mysqli_query($conn, $query);

				if (mysqli_num_rows($result) > 0) {

					while($row = mysqli_fetch_assoc($result)) {

						$subgroupID = $row['subgroupID'];
					}

				}

				$query = 'INSERT INT0 member VALUES ('.$_GET['userID'].', '.$subgroupID.')';
				$result = mysqli_query($conn, $query);
				
				if ($result) {
					echo "added";
				} else {
					echo "error";
				}	

			}

			mysqli_close($conn);

		}		
?>
