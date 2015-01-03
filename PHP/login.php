<?php

		$servername = "localhost";
		$username = "root";
		$password = "google60";
		$db_name = "postbox";
		$table_name = "login";

		$conn = mysqli_connect($servername, $username, $password, $db_name);			

		if (!$conn) {
			echo 0; // error at connection
		} else {
			
			$query = 'SELECT password, blockflag, level FROM '.$table_name.' WHERE userID = '.$_GET['userID'].'';
			$result = mysqli_query($conn, $query);

			if (mysqli_num_rows($result) > 0) {

				$row = mysqli_fetch_assoc($result);

				if ( $row['password'] === $_GET['password'] && 
					$row['blockflag'] !== '1') {

					$arr = array('authenticated' => true,
					 'level' => $row['level']);

					echo json_encode($arr);

				} else {

					echo -1;
				}

			} else {
			    echo -1; // no results found
			}

			mysqli_close($conn);

		}		
?>
