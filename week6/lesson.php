<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratice</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>

 <form action="Pratice.php" method="post" enctype="MULTIPART/FORM-DATA">
    <label for="">Enter your UserName</label>
    <input type="text" name="username">
    <label for="">Enter your Password</label>
    <input type="password" name="Password">
    <label for="">Choose your Gender</label>
    <input type="radio" name="sex" value="Male">Male
    <input type="radio" name="sex" value="Female">Female
    <label for="">Choose Your faculty</label>
    <input type="checkbox" name="Facuilties[]" value="Engineering">Engineering
    <input type="checkbox" name="Facuilties[]" value="Medicane">Medicane
    <input type="checkbox" name="Facuilties[]" value="Computer">Computer
    <label for="">Enter your Message</label>
    <textarea name="Message" ></textarea>
    <label for="">Choose your city</label>
    <Select name = "city[]" multiple>
        <option value="mogdhishu">mogdhishu</option>
        <option value="hargeysa">hargeysa</option>
        <option value="kismaayo">kismaayo</option>
    </Select>

    <label for="">Choose file</label>
    <input type="file" name="stdimage" id="">
    <input type="text" name="username">
    <label for="">Rename the file</label>
    <input type="text" name="fullname">

    <div class="buttons">
        <button type="rest" class="rest_btn">Rest</button>
        <button type="submit" class="Send_btn">Send</button>
    </div>

 </form>

<?php

  echo "Your Username is" .$_POST["username"] ."<br>";
  echo "</hr>";
  echo "Your password is" . $_POST["Password"]."<br>";
  echo "</hr>";
  echo "Your Message is" . $_POST["sex"]."<br>";
  echo "</hr>";
  echo "Your Message is" . $_POST["Message"]."<br>";
 echo "</hr>";

  if(!empty($_POST['Facuilties'])){
    foreach($_POST["Facuilties"] as $faculty){
        echo "facuilty is : " . $faculty ."<br>";
        echo "</hr>";
    }
  }
  else{
    echo 'please select facultiy';
  }

  if(!empty($_POST['city'])){
    foreach($_POST['city'] as $citys)
        echo "city is : ". $citys ."<br>";
        echo "</hr>";
  }
  else{
    echo 'please select city';
  }

  if(!empty($_FILES["stdimage"]["name"])){
    echo "image name is :" . $_FILES["stdimage"]["name"];
    echo "</hr>";
    echo "image size is :" . $_FILES["stdimage"]["size"];


    $EXT =explode(".",$_FILES["stdimage"]["name"]);
    $EXTs =explode(".",$_FILES["stdimage"]["name"]);
    $EXTs = strtolower(end($EXTs));
    $EXT = end($EXT);
    $extension = array("png","bdf");

    $temp = $_FILES["stdimage"]["tmp_name"];
    $distanition = "C:\Users\hp\Desktop\PHP\Image". $_POST["fullname"].".".$EXT;

  if(file_exists($distanition)){
    echo "sorry the folder is not exist";
  }
  else {
     if(!in_array($EXTs,$extension)){
       echo "not allowed extension";
     }
     else {
    if(!$_FILES['stdimage']['size']. 10*1024 *1024){
      if(move_uploaded_file($temp,$distanition)){
      echo "succesfull upload";
      }
     else{
      echo "file is required";
     }
     }
  else{
    echo "sorry file is too big";
  }
  }
  }
  }

  //move file to distintion

?>
</body>
</html>