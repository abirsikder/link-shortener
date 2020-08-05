<?php
$servername = "localhost";
$username = "abir";
$password = "hello12345";
$connection = mysqli_connect($servername,$username,$password,"link_shortener");

if (!$connection){

	die("Connection failed: " . mysqli_connect_error());
}

else{

	function genlink(){
		$name = "";
		if( $_POST["name"] && !empty($_POST["name"] ))
		{
			$name = $_POST['name'];
			if(filter_var($name,FILTER_VALIDATE_URL)) 
			{
				function generateRandomString($length ) {
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++){

						$randomString .= $characters[rand(0, $charactersLength-1 )];

					}
					return $randomString;
				}
				global $connection;
				$randnum = generateRandomString(6);
				$userUrl = $name;
				$CurrentSiteAddress = $_SERVER['HTTP_HOST'];
				$GenUrl = $CurrentSiteAddress."/".$randnum; 
				$AddnewDataSQL = "INSERT INTO keylist (gen_key,user_url,gen_url)
				VALUES('$randnum','$userUrl','$GenUrl')";



				if(mysqli_query($connection,$AddnewDataSQL)){

					$last_id = mysqli_insert_id($connection);
					$getOldGenUrlSQL = "SELECT gen_url FROM keylist WHERE id=(SELECT LAST_INSERT_ID())";
					$gen_url = mysqli_query($connection,$getOldGenUrlSQL) or die("Connection failed: " . mysqli_connect_error());
					$getOlduserUrlSQL = "SELECT user_url FROM keylist WHERE id=(SELECT LAST_INSERT_ID())";
					$user_url = mysqli_query($connection,$getOlduserUrlSQL) or die("Connection failed: " . mysqli_connect_error());
					$final_gen_url = mysqli_fetch_assoc($gen_url) or die("Connection failed: " . mysqli_connect_error());
					$final_user_url = mysqli_fetch_assoc($user_url) or die("Connection failed: " . mysqli_connect_error());


					$data = $final_user_url['user_url'];

					$data1 = 
					'<html>
					<head>
					</head>
					<body>
					<script type=text/javascript>window.location.replace("'.$data.'");
					</script>
					</body>
					</html>';
					
					$ran = $randnum.".htm";
					$myfile = fopen($ran, "w") or die("Unable to open file!");
					fwrite($myfile, $data1);
					echo $sendtouser = "http://".$CurrentSiteAddress."/link_shortner/".$randnum.".htm";
                    fclose($myfile);
				}
			}

			else{

				echo "URL IS NOT VALID!";
			}
		} 

		else{

			echo "URL CAN NOT BE EMPTY!";
		} 
	}
}
genlink();

?>