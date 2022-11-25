<?php
$page_title = "Home";
include('header.php');


//$resultant = $handler->insert('fer',
//    ['id'=>null,'name'=>'dev ji','address'=>'my home']
//);


//$rows = $handler->update(
//    'fer',
//    ['name'=>'dev','address'=>'asasasas a 56'],//set
//    ['id'=>890] ///where
//);
//
//print_r($rows);

//$handler->delete('fer','id',7);
//$alltypes = ['int','phone','email','string','empty'];
//$some1 = array_search('inst', $alltypes,TRUE);
//print_r($some1);















//
//<input type="file" name="myfile"> <br>
//
//// Uploads files
//if (isset($_POST['save'])) { // if save button on the form is clicked
//    // name of the uploaded file
//    $filename = $_FILES['myfile']['name'];
//
//    // destination of the file on the server
//    $destination = 'uploads/' . $filename;
//
//    // get the file extension
//    $extension = pathinfo($filename, PATHINFO_EXTENSION);
//
//    // the physical file on a temporary uploads directory on the server
//    $file = $_FILES['myfile']['tmp_name'];
//    $size = $_FILES['myfile']['size'];
//
//    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
//        echo "You file extension must be .zip, .pdf or .docx";
//    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
//        echo "File too large!";
//    } else {
//        // move the uploaded (temporary) file to the specified destination
//        if (move_uploaded_file($file, $destination)) {
//            $sql = "INSERT INTO files (name, size, downloads) VALUES ('$filename', $size, 0)";
//            if (mysqli_query($conn, $sql)) {
//                echo "File uploaded successfully";
//            }
//        } else {
//            echo "Failed to upload file.";
//        }
//    }
//}

?>
    <br>
    <br>
<center>
<h3>
Welcome To Farm Connect Management Software
</h3>
</center>

    <br>
    <br>
    <br>
<?php
include "footer.php";
?>