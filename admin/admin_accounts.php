<?php

include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="../css/adminstyle.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">Admin accounts</h1>

   <div class="box-container">

   <div class="box">
      <p>add new admin</p>
      <a href="register_admin.php" class="option-btn">Register admin</a>
   </div>

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `admins`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   
   <?php
         }
      }else{
         echo '<p class="empty">no accounts available!</p>';
      }
   ?>

   </div>

</section>



<div class="product-display">
      <table class="product-display-table">
   
         <thead>
         <tr>
            <th>Admin id </th>
            <th>Admin Name </th>
            <th>Action</th>
         </tr>
         </thead>
         <?php
       $select_accounts = $conn->prepare("SELECT * FROM `admins`");
       $select_accounts->execute();
       if($select_accounts->rowCount() > 0){
          while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
         <tr>
            <td> <?= $fetch_accounts['id']; ?> </td>
            <td><?= $fetch_accounts['name']; ?></td>
          
            <td>
               
               <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="update_profile.php" class="sbtn"> <i class="fas fa-edit"></i>update</a>';
            }
         ?>
         <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account?')" class="sbtn"> <i class="fas fa-trash"></i> delete</a>
            </td>
         </tr>
         <?php
      }
   }else{
      echo  '<p class="empty">no accounts available!</p>';
   }
   ?>
      </table>
   </div>

</div>









<script src="../js/admin_script.js"></script>
   
</body>
</html>