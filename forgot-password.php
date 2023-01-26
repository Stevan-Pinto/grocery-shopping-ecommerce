<?php require_once "controllerUserData.php"; ?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>forgot password</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/components.css">

</head>
<body>
<?php include './components/header_section.php'; ?>
   
<section class="form-container">

   <form action="forgot-password.php" method="POST">
      <h3>Forgot password</h3>
                   <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
      <p class="text-center">Enter your email address</p>
      <input type="email" name="email" class="box" placeholder="Enter email" required value="<?php echo $email ?>">
      <input type="submit" value="Continue" class="btn" name="check-email">
   </form>

</section>


</body>
</html>