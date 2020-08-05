<?php

$servername = "localhost";
$username = "abir";
$password = "hello12345";
$connection = mysqli_connect($servername,$username,$password,"link_shortener");

if (!$connection){

	die("Connection failed: " . mysqli_connect_error());
}

else{  
	
	
	if (isset($_POST['submit_contact'])) {
         
        $error = false;
        $firstname = "";
        $lastname = "";
        $comment = "";
		if (isset($_POST['firstname']) && !empty($_POST['firstname'])){ 

			$firstname = $_POST['firstname'];

		}

		else{

			$error1 = "Firstname can not be empty"."<br>";
			$error = true;
		}

		if (isset($_POST["lastname"]) && !empty($_POST["lastname"])) {

			$lastname = $_POST['lastname'];
		}

		else{
		
			$error2 = "lastname can not be empty"."<br>";
			$error = true;
		}

		if (isset($_POST['comment']) && !empty($_POST['comment'])) {

			$comment = $_POST['comment'];

		}

		else{

			
			$error3 = "comment can not be empty". "<br>";
			$error = true;
		}

		if ($error === false) {

			$addnewdataSQL = "INSERT INTO form (firstname,lastname,comment)
			VALUES('$firstname','$lastname','$comment')";
			mysqli_query($connection,$addnewdataSQL);
			echo "<script type='text/javascript'>alert('Form submitted')</script>";
		}

		else{
            $msg = $error1." ".$error2. "". $error3;
			echo $error;
		}



	}

	
$sql = "SELECT * FROM form ORDER BY id DESC LIMIT 1";
$column = mysqli_query($connection,$sql) or die("error");
$data = mysqli_fetch_assoc($column);
$fullname = $data['firstname']." ".$data['lastname'];
$comments = $data['comment'];


}	
  ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Link shortener</title>
	<link rel="stylesheet" type="text/css" href="lib/mystyle.css">
	<link rel="icon" href="img/link.svg" type="image/icon type">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>




</head>
<body id="body">
	<div class="container-fluid">
		<!-- Section header -->

		<div class="row">
			<div class="col">
				<a href="http://echolink.ml">
					<h1 class="text-dark">Echo Link
						<img src="img/link.svg" alt="logo" id="my-logo">
						<span class="heading-slogan">Custom link shortener</span>
					</h1>
				</a>


				<nav class="navbar navbar-expand-lg nav-main">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-align-center"></i></button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
						<ul class="navbar-nav ">
							<li class="nav-item ">
								<a class="nav-link" href="index.htm"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							</li>
							<li class="nav-item ">
								<a class="nav-link" href="about.htm"><i class="fa fa-user" aria-hidden="true"></i> About</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="contact.htm"><i class="fa fa-phone" aria-hidden="true"></i> Contact</a>
							</li>				
						</ul>
					</div>
				</nav>
			</div>
		</div>



		<!-- Section Intro -->
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-6 intro-wrapper" >

					<h4 class="commentheading">Drop us your Thoughts. We'd love to Hear from you!</h4>
					<p class="commentheading2">See what people wrote!</p>
						<div class="comment">
							<div class="commenthead_1">
								<span class="sp-style">Full name</span>
								<?php 
                                    echo $fullname;
                                          
								?>
							</div>
							<div class="commenthead_2">
								<span class="sp-style">Comment</span>
								<?php

								echo $comments; 

								?>
							</div>
						</div>
										
				</div>
				<div class="col-lg-6">
					<div class="contact-form">
						<form class="needs-validation" action="#" method="post" validate>
							<div class="form-row">
								<div class="col-md-4 ">
									<label for="validationCustom01">First name</label>
									<input type="text" class="form-control form-control-sm" id="Firstname" placeholder="First name" name="firstname" required>
									<div class="invalid-feedback">
										Firstname required
									</div>
								</div>
								<div class="col-md-4 mb-2">
									<label for="validationCustom02">Last name</label>
									<input type="text" class="form-control form-control-sm" id="Lastname" placeholder="Last name" name="lastname" required>
									<div class="invalid-feedback">
										lastname required
									</div>
								</div>

							</div>

							<div class="form-row">
								<div class="col-md-10 mb-2">
									<label for="validationCustom04">Your comment</label>
									<textarea id="comment" class="form-control form-control-sm" rows="3" name="comment" required></textarea>
									<div class="invalid-feedback">
										Enter your comment.
									</div>
								</div>
							</div>

							<button class="btn btn-primary" type="submit" id="submit_contact" name="submit_contact">Submit form</button>
						</form>
					</div>
				</div>

              </div>
			</div>
			
				<div class="row">
					<div class="col-md-12">
						<nav class="navbar navbar-expand-sm nav-bottom">
							<ul class="navbar-nav ">
                        <li class="nav-item ">
                            <a class="nav-link" target="_blank" href="https://github.com/abirsikder"><i class="fa fa-heart" aria-hidden="true" ></i> github</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="https://www.facebook.com/abir.sikder.18" target="_blank"><i class="fa fa-share" aria-hidden="true"></i> Follow me</a>
                        </li>              
                    </ul>
						</nav>
					</div>
				</div>
			
			<script type="text/javascript" src="lib/script.js"></script>
			<script>

</script>
</body>
</html>


