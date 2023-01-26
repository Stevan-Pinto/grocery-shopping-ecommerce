<?php require_once "controllerUserData.php"; ?>


<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login-user.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Code Verification</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/components.css">

</head>
<body>
<?php include './components/header_section.php'; ?>


   
<section class="form-container">

   <form action="reset-code.php" method="POST" autocomplete="off">
      <h3>Code Verification</h3>
      <?php 
      if(isset($_SESSION['info'])){
          ?>
          <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
              <?php echo $_SESSION['info']; ?>
          </div>
          <?php
      }
      ?>

      <?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
      <input type="email" name="otp" class="box" placeholder="Enter code" required value="<?php echo $email ?>">
      <input type="submit" value="Submit" class="btn" name="check-reset-otp">
   </form>

</section>


</body>
</html>