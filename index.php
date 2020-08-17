<?php
  $message = '';
  if (isset($_POST['btnUpload']) && $_POST['btnUpload'] == 'upload') {
    if (
      isset($_FILES['uploadedFile']) &&
      $_FILES['uploadedFile']['error'] == 0
    ) {

      $fileName = $_FILES['uploadedFile']['name'];
      $fileTempName = $_FILES['uploadedFile']['tmp_name'];
      $fileSize = $_FILES['uploadedFile']['size'];
      $fileType = $_FILES['uploadedFile']['type'];

      $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
      $filePathName = pathinfo($fileName, PATHINFO_FILENAME);

      //Sanitazing the info
      $newFileName = time() . $filePathName . '.' . $fileExtension;

      echo $newFileName;

      $uploadDir = './uploaded_files/';
      $destinationPath = $uploadDir . $newFileName;

      if (move_uploaded_file($fileTempName, $destinationPath)) {
        $message = 'File uploaded succesfully';
      } else {
        $message = 'Sorry, there was a problem with the upload';
      }

      // echo '<pre>',
      //   print_r($GLOBALS),
      //   '</pre>';
    } else {
      echo 'something went wrong';
    }
  } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div>
  <?php echo $message; ?>
</div>
<form method="POST" enctype="multipart/form-data">
  <div>
  <h3>Upload file</h3>
  <input type="file" name="uploadedFile">
  <button type="submit" name="btnUpload" value="upload">Save file</button>
  </div>
</form>  
</body>
</html>