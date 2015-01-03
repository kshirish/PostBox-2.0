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
			

			$query = 'SELECT level FROM login WHERE userID = '.$_GET['userID'].'';

			$result = mysqli_query($conn, $query);

			if (mysqli_num_rows($result) > 0) {

				while($row = mysqli_fetch_assoc($result)) {

					$level = $row['level'];					
				}

			}

			if ( $level === "0" ) {

				array_push($returnObj, true);
				array_push($returnObj, true);
				array_push($returnObj, true);

			} else if ( $level === "1" ) {
				
				$query = 'SELECT groupID FROM groups WHERE groupadmin = '.$_GET['userID'].' LIMIT 1';

				$result = mysqli_query($conn, $query);

				if (mysqli_num_rows($result) > 0) {

					while($row = mysqli_fetch_assoc($result)) {

						if( $row['groupID'] === $_GET['groupID'] ) {

							array_push($returnObj, true);
							array_push($returnObj, true);
							array_push($returnObj, true);

						}					
					}

				}

			} else if ( $level === "2" ) {

				$query = 'SELECT subgroupadmin FROM subgroups WHERE subgroupname = '.$_GET['subgroupname'].'';

				$result = mysqli_query($conn, $query);

				if (mysqli_num_rows($result) > 0) {

					while($row = mysqli_fetch_assoc($result)) {

						if( $row['subgroupadmin'] === $_GET['userID'] ) {

							array_push($returnObj, true);
							array_push($returnObj, true);
							array_push($returnObj, true);

						}					
					}

				}

			} else if ( $level === "3" ) {			

				$query = 'SELECT subgroupname FROM member LEFT JOIN subgroups ON member.subgroupID = subgroups.subgroupID where member.userID = '.$_GET['userID'].'';

				$result = mysqli_query($conn, $query);

				if (mysqli_num_rows($result) > 0) {

					while($row = mysqli_fetch_assoc($result)) {

						if( $row['subgroupname'] === $_GET['subgroupname'] ) {

							array_push($returnObj, true);
							array_push($returnObj, false);
							array_push($returnObj, false);

						}					
					}

				}
			} else {

				echo 'Nothing Found !';
			}

			echo json_encode( $returnObj );

			mysqli_close($conn);

		}		
?>
