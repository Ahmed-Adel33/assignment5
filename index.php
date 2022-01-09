
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta Title="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Register</h2>
  <form   action="<?php  echo  $_SERVER['PHP_SELF'];?>"  method="post" enctype="multipart/form-data">
   <input type="hidden"   value="1" Title="register">
  <div class="form-group">
    <label for="exampleInputTitle">Title</label>
    <input type="text" class="form-control" id="exampleInputTitle"  required name="Title" aria-describedby="" placeholder="Enter Title">
  </div>

  <div class="form-group">
    <label for="exampleInputcontent">content </label>
    <input type="text"   class="form-control" id="exampleInputcontent1" required name="content" aria-describedby="contentHelp" placeholder="Enter content">
  </div>


   <div class="form-group">
    <label for="exampleInputPassword">profileImage</label>
    <input type="file" name="image">
  </div> 

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
</body>
</html>



<?php


function Clean($input){

$input =  trim($input);
$input =  strip_tags($input);
$input =  stripslashes($input);
return $input;

return  trim(strip_tags(stripslashes($input)));
}



if($_SERVER['REQUEST_METHOD'] == "POST"){

$Title     = Clean($_POST['Title']); 
$content    = Clean($_POST['content']);




$errors = [];


if(empty($Title)){
$errors['Title'] = "Field Required";
}


if(empty($content)){
$errors['content'] = "Field Required";
}elseif(strlen($content)<50 ){
$errors['content'] = " content must be 50 char";
}

if(!empty($_FILES['image']['name'])){

    $imgName     = $_FILES['image']['name'];
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imagSize    = $_FILES['image']['size'];
    $imgType     = $_FILES['image']['type'];


    $imgExtensionDetails = explode('.',$imgName);
    $imgExtension        = strtolower(end($imgExtensionDetails));

    $allowedExtensions   = ['png','jpg','gif'];

       
    if(in_array($imgExtension ,$allowedExtensions)){
            
          
        $finalName = rand().time().'.'.$imgExtension;

         $disPath = './upload/'.$finalName;
          
        if(move_uploaded_file($imgTempPath,$disPath)){
            echo 'Image Uploaded';
        }else{
            echo 'Error Try Again';
        }

       }else{
           echo 'Extension Not Allowed';
       }


   }else{
       echo 'Image Field Required';
   }



if(count($errors) > 0){
foreach ($errors as $key => $value) {
    # code...
    echo '* '.$key.' : '.$value.'<br>';
}

}else
{
    $file=fopen('text.txt','w') or die('unable to open file');
    $tex= $Title ."\n". $content ."\n" .$imgName."\n";
    fwrite($file,$tex);
  

}


}



?>

