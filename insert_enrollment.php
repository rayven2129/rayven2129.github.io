<?php
$conn = new mysqli("localhost", "root","","enrollment_grading_system");
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$gender_type_result = $_POST['gender_type_result'];
$date_of_birth = $_POST['date_of_birth'];
$place_of_birth = $_POST['place_of_birth'];
$complete_address = $_POST['complete_address'];
$contact_number = $_POST['contact_number'];
$email_address = $_POST['email_address'];
$guardian_name = $_POST['guardian_name'];
$guardian_contact_number = $_POST['guardian_contact_number'];
$guardian_relation_to_student = $_POST['guardian_relation_to_student'];
$username = $_POST['username'];
$password = $_POST['password'];
$student_type = $_POST['student_type'];

$search_duplicate = "SELECT username FROM enrollment_system WHERE username = '$username'";
$query = $conn->query($search_duplicate);
$fetch = $query->fetch_array();
	if ($username == isset($fetch['username'])) {
		echo "<script>alert('Username exists');</script>";
		echo "<script>window.location.assign('enrollment_system.php');</script>";
	}else{
		$sql = "INSERT INTO enrollment_system(last_name,first_name,middle_name,gender,date_of_birth,place_of_birth,address,contact_number,email_address,guardian_name,guardian_contact_number,guardian_relation_to_student,username,password_user,student_status) VALUES ('$last_name','$first_name','$middle_name','$gender_type_result','$date_of_birth','$place_of_birth','$complete_address','$contact_number','$email_address','$guardian_name','$guardian_contact_number','$guardian_relation_to_student','$username','$password','$student_type')";

			if ($conn->query($sql) == TRUE) {
				$insert_second_table = "INSERT into grading_system(student_id) VALUES ((SELECT student_id from enrollment_system WHERE username = '$username'))";
					if ($conn->query($insert_second_table) == TRUE) {
						echo "<script>alert('Created Account Success!');</script>";
						echo "<script>window.location.assign('index.php');</script>";
					}else{
						echo "<script>alert('Created Account Failed!');</script>";
						echo "<script>window.location.assign('index.php');</script>";
					}
				
			}else{
				echo "<script>alert('Created Account Failed!');</script>";
				echo "<script>window.location.assign('index.php');</script>";
			}

	}



?>