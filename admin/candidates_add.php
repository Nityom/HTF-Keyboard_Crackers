<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $platform = $_POST['platform'];
    
    // Check if all required fields are filled
    if(empty($firstname) || empty($lastname) || empty($position) || empty($platform)) {
        $_SESSION['error'] = 'Please fill all required fields.';
        header('location: candidates.php');
        exit(); // Stop further execution
    }
    
    // Handle file upload for photo
    $filename = '';
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK){
        $filename = $_FILES['photo']['name'];
        $temp_name = $_FILES['photo']['tmp_name'];
        $upload_path = '../images/'.$filename;
        
        // Check if file is an image
        $image_info = getimagesize($temp_name);
        if($image_info === false) {
            $_SESSION['error'] = 'Uploaded file is not an image.';
            header('location: candidates.php');
            exit();
        }
        
        // Move uploaded file to destination folder
        if(move_uploaded_file($temp_name, $upload_path)) {
            // File uploaded successfully
        } else {
            $_SESSION['error'] = 'Failed to upload file.';
            header('location: candidates.php');
            exit();
        }
    }
    
    // Insert candidate data into database
    $sql = "INSERT INTO candidates (position_id, firstname, lastname, photo, platform) VALUES ('$position', '$firstname', '$lastname', '$filename', '$platform')";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Candidate added successfully';
    }
    else{
        $_SESSION['error'] = 'Error: ' . $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: candidates.php');
exit();
?>
