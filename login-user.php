<?php require_once "controllerUserData.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/components.css">

</head>
<body>
<?php include './components/header_section.php'; ?>
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
   
<section class="form-container">

   <form action="login-user.php" method="POST">
      <h3>login </h3>
      <input type="email" name="email" class="box" placeholder="Enter email" required value="<?php echo $email ?>">
      <input type="password" name="password" class="box" placeholder="Enter password" required>
       <div style="text-align: left;" class="link"><a href="forgot-password.php">Forgot password?</a></div>
      <input type="submit" value="login" class="btn" name="login">
      <p>don't have an account? <a href="signup-user.php">Signup</a></p>
   </form>

</section>


</body>
</html>