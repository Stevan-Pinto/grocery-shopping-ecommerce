<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

?>

<?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="POST" class="box">
    
     
      <? $fetch_cart['price']; ?>
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <div class="flex-btn">
         <input type="hidden" min="1" value="<?= $fetch_cart['quantity']; ?>" class="qty" name="p_qty">
         <input type="hidden" value="update" name="update_qty" class="option-btn">
      </div>
      <div type="hidden" class="sub-total"><span></span> </div>
   </form>
   <?php
      $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); 
      $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/components.css">
   <style>
   
   .form-containers{
   min-height: 100vh;

   display: flex;
   align-items: center;
   justify-content: center;
}

.form-containers form{
   width: 32rem;
   background-color: var(--white);
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
   text-align: center;
   padding:2rem;
}

.form-containers form h3{
   font-size: 3rem;
   color:var(--black);
   margin-bottom: 1rem;
}

.form-containers form .box{
   width: 100%;
   margin:1rem 0;
   border-radius: .5rem;
   border:none;
   padding:1.1rem 1.3rem;
   font-size: 1.8rem;
   color:var(--black);
   background-color: var(--light-bg);
}

.form-container form p{
   margin-top: 2rem;
   font-size: 2.2rem;
   color:var(--light-color);
   text-align: center;
}

.btn
{
   display: block;
   width: 100%;
   margin-top: 1rem;
   border-radius: .5rem;
   color:var(--white);
   font-size: 2rem;
   padding:6px 6px;
   text-transform: capitalize;
   cursor: pointer;
   text-align: center;
}

.btn{
   background-color: blue;
}

   
   </style>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>



<section class="form-containers">
<form>
<h3>Payment </h3>
    <input class="box" type="textbox" name="name" id="name" placeholder="Enter your name" required><br/><br/>
    <input style=" text-align: center; font-weight:bold;" class="box" type="textbox" name="amt" id="amt" value="<?php echo(isset($grand_total))?$grand_total:''?>" readonly><br/><br/>
    <input class="btn" type="button" name="btn" id="btn" value="Pay Now" onclick="pay_now()"/>
</form>
</section>



<script>
    function pay_now(){
        var name=jQuery('#name').val();
        var amt=jQuery('#amt').val();
        
         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&name="+name,
               success:function(result){
                   var options = {
                        "key": "rzp_test_Iwq6JMt7AzRLrt", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "Acme Corp",
                        "description": "Test Transaction",
                        "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id,
                               success:function(result){
                                   window.location.href="order_placed.php";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    }
</script>

<?php include 'footer.php'; ?>
</body>
</html>