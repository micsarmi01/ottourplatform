<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.html");
}

// TODO: PLACE profile pic in folder hierarchy
require 'dbConnection.php';

function getBeacons(){ 
    $dbConn = getConnection(); 
    $sql = "SELECT * FROM cards ORDER BY location"; 
    $stmt = $dbConn->prepare($sql); 
    $stmt->execute(); 
    return $stmt->fetchAll(); 
} 
        
if(isset($_POST['uploadForm'])){   
/*echo $_FILES['fileName']['name'] . "\n";
echo $_FILES['fileName']['tmp_name'] . "\n";
echo $_FILES['fileName']['size'];
echo $_FILES['fileName']['type'];
echo " *****LOCATION****   :";
echo $_POST['beaconChoose'];*/
//$imageType = exif_imagetype($_FILES['fileName']['tmp_name']); // 1, 2, 3 for gif, jpg or png respectively.
//if($imageType != 1 ||  $imageType != 2 || $imageType !=3){
// delete image
//echo "Here";
//unlink($_FILES['fileName']['name']);
//}

$path = "img/" . $_SESSION['username'];
if(!file_exists($path)){ // check whether the user's folder exists
mkdir($path);
}

$message = "Successfully Updated Info Card";
echo "<script type='text/javascript'>alert('$message');</script>";
$pathOfPic = $path . "/" . $_FILES['fileName']['name'];
//echo "\nPath of pic: " . $path . "/" . $_FILES['fileName']['name'];
move_uploaded_file($_FILES['fileName']['tmp_name'],   'img/' . $_SESSION['username'] . "/" . $_FILES['fileName']['name']);

// update database with the name of the file for the profile picture
$dbConn = getConnection();
        $beacon = $_POST['beaconChoose'];
        $urlpathOfPicpathOfPic = "http://54.201.92.64/img/admin/" . $_FILES['fileName']['name'];
        $sql = "UPDATE cards SET url= '" . $urlpathOfPicpathOfPic . "'WHERE location='" .$beacon. "'";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>profile</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width; initial-scale=1.0">
  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="stylesheet" type="text/css" href="main.css">
  <!-- Latest compiled and minified CSS -->
  <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);
    
    #left
    {
      font-family: "Roboto", sans-serif;
      width: 520px;
      float: left;
      padding-top: 50px;
      padding-left: 10px;
      margin-right: 50px;
      
      
    }

    #right
    {
      font-family: "Roboto", sans-serif;
      text-align: left;
      margin-left: 100px;/* Change this to whatever the width of your left column is*/
      font-family: "Roboto", sans-serif;
    }

     #updater
    {
        font-family: "Roboto", sans-serif;
        padding: 25px;
      color: black;
      background-color: white; 
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
      font-family: "Roboto", sans-serif;
      
    }
     #selector
    {
      font-family: "Roboto", sans-serif;
      padding: 25px;
      margin-bottom: 5;
      color: black;
      background-color: white; /* Change this to whatever the width of your left column is*/
     
      border-radius: 10px;
      box-shadow: 5px 5px 5px black;
     
    }

    /*#imageSelect{
        font-size: 18px;
        padding:0px;
        text-align: center;
    }*/

    .clear
    {
      clear: both;
    }
    .btn {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0px;
  font-family: Arial;
  color: #ffffff;
  font-size: 18px;
  background: #3498db;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
  -webkit-box-shadow: none !important;
    -moz-box-shadow: none !important;
    box-shadow: none !important;
}

.btn:hover {
  background: #a9d8f5;
  text-decoration: none;
}

#container{
    /*background:rgba(255,255,255, 0.6);*/
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 5px;
      margin: auto;
   padding: 10px;
   width: 920px;
   margin-top: 40px;
  font-family: "Roboto", sans-serif;
}

.img-container { position: relative; }

.img-container .top {
  position: absolute;
  top: 75px;
  left: 502px;
  
  z-index: 1;
}

.fileUpload {
    font-family: "Roboto", sans-serif;
    outline: 0;
    position: relative;
    overflow: hidden;
    color:white;
  
}
.fileUpload input.upload {
    font-family: "Roboto", sans-serif;
    color:white;
    outline: 0;
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
    width: 100%;
}

.button1 {
  font-family: "Roboto", sans-serif;
  
  outline: 0;
  background: #a1d490;
  width: 100%;
  border: 0;
  padding: 15px;
  color: white;
  font-size: 18px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.button1:hover,.button1:active,.button1:focus {
  background: #a4dbb2;
}

#bottom{
    
}
  </style>
  
</head>
<body>
  <div>
  <header>
      
      </header>
 
      <div id="container">
        <div id="left">
           


          <div id="selector">
               <img  src="/img/admin/ottourslogo.png" height="150" width ="150">
               <br>
   
       
      Welcome <?=$_SESSION['username']?>!
      <br> <br>
      <form action="profile.php" method="post" enctype="multipart/form-data" >
          <?php 
            $beacons = getBeacons();
            
            $beaconsLocationArray = array();
            $beaconsURLArray = array();

            echo "Select a location to update <select id='beacon' name='beaconChoose' class='select-style'>";

            foreach ($beacons as $beacon){ 
              echo '<option value="'.$beacon['location'].'">'.$beacon['location'].'</option>'; 
              $beaconsLocationArray[$beacon['location']] = $beacon['url'];
              } 
              
            echo "</select>";
            
            
           
            
       ?> 
          <br><br>
          
          Select file to update location <label class="form_field"><span id="aggregator_name">Bit &nbsp;</span></label>
          
          <br>
          <div class="fileUpload btn btn-primary">
            <span id="fileselect">Select an image</span>
            <input id="imageSelect" type="file" name="fileName" class="upload"/> 
          </div>
          
      
      <input class="button1" type="submit" name="uploadForm" value="Update Location"/>
      </form>

          </div>
      </div>
      <div id="right">
           
        
           <div class="img-container">
               <img  class="top" id="pic" src="null" height="476" width="275"/></div>
               <img id="bottom" src="/img/admin/blackphoneshadow.png" height="623" width="320"/> </div>
           </div>
          
      
         
      <script src="jquery-1.12.0.min.js"></script>
      
      <script type="text/javascript">
            //Assign php generated json to JavaScript variable
            var tempArray = <?php echo json_encode($beaconsLocationArray); ?>;
            var hi = "hello";
            
           //You will be able to access the properties as 
            //alert(tempArray.Bit);
            //alert(hi); 
            
            document.getElementById('pic').src = tempArray.Bit.toString();
           
           document.getElementById('beacon').onchange = function(){
                var beaconArray = <?php echo json_encode($beaconsLocationArray); ?>;
                var e = document.getElementById('beacon');
                var stringB = e.options[e.selectedIndex].text;
                //alert(stringB);
                var newer = stringB.toString();
                var newerString = stringB.toString() + "  ";
                //alert(newer);
                var newString = beaconArray[newer];
                //alert(newString);
                document.getElementById('pic').src = newString;
                document.getElementById('aggregator_name').innerHTML = newerString;
            };
            
            
      </script>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      
      <script>
          $('input[type=file]').change(function(e){
             var file = $('input[type=file]').val().toString();
             var newfile = file.split("\\");
            $('#fileselect').text(newfile[newfile.length - 1]);
          });
          </script>
    </div>
    <footer>
    </footer>
  </div>
</body>
</html>
