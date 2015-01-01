<?php

		$servername = "localhost";
		$username = "root";
		$password = "google60";
		$db_name = "mytest";
		$table_name = "Persons";

		//-------------------------function definitions----------------------------//
		function createConnection($servername, $username, $password, $db_name){

			return mysqli_connect($servername, $username, $password, $db_name);			
		}

		function executeQuery($con, $query) {

			return mysqli_query($con, $query);
		}

		function closeConnection($con) {
			mysqli_close($con);
		}
		//-------------------------function definitions----------------------------//

		$con = createConnection($servername, $username, $password, $db_name);

		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		} else {
			echo 'connected t mysql datavase';
		}

		//what to do with the returned data
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		    }
		} else {
		    echo "0 results";
		}

		closeConnection($con);
		
?>
