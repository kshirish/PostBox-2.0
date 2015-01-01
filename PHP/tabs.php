<?php

		$servername = "localhost";
		$username = "root";
		$password = "google60";
		$db_name = "postbox";

		$conn = mysqli_connect($servername, $username, $password, $db_name);			

		if (!$conn) {
			echo 0; // error at connection
		} else {
			
			$query = 'SELECT subgroupID FROM groups WHERE groupID = '.$_GET['subParam'].'';
			$result = mysqli_query($conn, $query);
			$subGroupStack = array();

			if (mysqli_num_rows($result) > 0) {

				while($row = mysqli_fetch_assoc($result)) {
					
					array_push($subGroupStack, $row['subgroupID']);
				}

			}

			$length = sizeof($subGroupStack);
			$returnObj = array();

			for ($i=0; $i < $length; $i++) { 

				$query =	'select firstname, text, subgroupname, postdate
							from post
							left join userinfo on post.userID = userinfo.userID 
							left join subgroups on post.subgroupID = subgroups.subgroupID
							where post.subgroupID = '.$subGroupStack[$i].'';

				$result = mysqli_query($conn, $query);

				if (mysqli_num_rows($result) > 0) {

					while($row = mysqli_fetch_assoc($result)) {
					
						array_push($returnObj, $row);
					}
				}	

			}

			echo json_encode($returnObj);			
			mysqli_close($conn);

		}		
?>
