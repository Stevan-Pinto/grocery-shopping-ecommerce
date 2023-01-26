<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="../css/adminstyle.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="messages">

<h1 class="heading">Feedback</h1>


</section>





<div class="product-display">
      <table class="product-display-table">
   
         <thead>
         <tr>
            <th>User id</th>
            <th>Name </th>
            <th> Email </th>
            <th>Number </th>
            <th>Message</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php
      $select_messages = $conn->prepare("SELECT * FROM `message`");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
   ?>
         <tr>
            <td> <?= $fetch_message['user_id']; ?></td>
            <td><?= $fetch_message['name']; ?></td>
            <td><?= $fetch_message['email']; ?></td>
            <td><?= $fetch_message['number']; ?></td>
            <td><?= $fetch_message['message']; ?></td>
            <td>
              
               <a href="messages.php?delete=<?= $fetch_message['id']; ?>"  onclick="return confirm('delete this message?');" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
         <?php
      }
   }else{
      echo '<p class="empty">you have no messages</p>';
   }
   ?>
      </table>
   </div>

</div>





<script src="../js/admin_script.js"></script>
   
</body>
</html>