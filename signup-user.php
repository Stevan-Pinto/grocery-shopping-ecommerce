<?php require_once "controllerUserData.php"; ?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/components.css">

</head>
<body>
<?php include './components/header_section.php'; ?>

   
<section class="form-container">

   <form action="signup-user.php" method="POST" autocomplete="">
      <h3>Register</h3>
      <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
      <input type="text" name="name" class="box" placeholder="Full Name" required value="<?php echo $name ?>">
      <input type="email" name="email" class="box" placeholder="Enter email" required value="<?php echo $email ?>">
      <input type="password" name="password" class="box" placeholder="Enter password" required>
      <input type="password" name="cpassword" class="box" placeholder="Confirm password" required>
      <input type="submit" value="Register" class="btn" name="signup">
      <p>already a member? <a href="login-user.php">login here</a></p>
   </form>

</section>


</body>
</html>