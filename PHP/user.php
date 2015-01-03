<?php

		$servername = "localhost";
		$username = "root";
		$password = "google60";
		$db_name = "postbox";

		$conn = mysqli_connect($servername, $username, $password, $db_name);			

		if (!$conn) {
			echo 0; // error at connection
		} else {

			$returnObj = array();
			
			$query = 'SELECT * FROM userinfo WHERE userID = '.$_GET['subParam'].'';
			$result = mysqli_query($conn, $query);
			

			if (mysqli_num_rows($result) > 0) {

				while($row = mysqli_fetch_assoc($result)) {
				
					array_push($returnObj, $row);
				}
			}	


			$query = 'SELECT firstname, text, postdate FROM personal LEFT JOIN userinfo ON personal.fromID = userinfo.userID WHERE toID = '.$_GET['subParam'].'';

			$result = mysqli_query($conn, $query);
			

			if (mysqli_num_rows($result) > 0) {

				while($row = mysqli_fetch_assoc($result)) {
				
					array_push($returnObj, $row);
				}
			}	


			echo json_encode($returnObj);			
			mysqli_close($conn);

		}		
?>
