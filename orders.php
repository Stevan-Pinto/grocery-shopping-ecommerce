<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login-user.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/style_cart.css">

</head>
<body>
   
<?php include 'header.php'; ?>





<div class="container">

<section class="shopping-cart">

   <h1 class="heading">Order Details</h1>

   <table>

      <thead>
         <th>Name</th>
         <th>Number</th>
         <th>Email</th>
         <th>Address</th>
         <th>Placed on </th>
         <th>Total Price</th>
         <th>Payment status</th>
      </thead>

      <tbody>

      <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
         <tr>
            <td><span><?= $fetch_orders['name']; ?></span></td>
            <td><span><?= $fetch_orders['number']; ?></span> </td>
            <td><span><?= $fetch_orders['email']; ?></span></td>
            <td><span><?= $fetch_orders['address']; ?></span></td>
            <td><span><?= $fetch_orders['placed_on']; ?></span></td>
            <td><span>₹<?= $fetch_orders['total_price']; ?>/-</span></td>
            <td><span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </td>
         </tr>
         <?php
            };
         }else{
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>

      </tbody>

   </table>
</section>

</div>






			<div id="content" class="site-content">
				<!-- Breadcrumb -->
				<div id="breadcrumb">
					<div class="container">
						<h2 class="title">Shopping Cart</h2>
						
						<ul class="breadcrumb">
							<li><span>Shopping Cart</span></li>
						</ul>
					</div>
				</div>
			
				<div class="container">
					<div class="page-cart">
						<div class="table-responsive">
							<table class="cart-summary table table-bordered">
								<thead>
									<tr>
										<th class="width-20">&nbsp;</th>
										<th class="width-80 text-center">Image</th>
										<th>Name</th>
										<th class="width-100 text-center">Unit price</th>
										<th class="width-100 text-center">Qty</th>
										<th class="width-100 text-center">Total</th>
									</tr>
								</thead>
								
								<tbody>
									<tr>
										<td class="product-remove">
											<a title="Remove this item" class="remove" href="#">
												<i class="fa fa-times"></i>
											</a>
										</td>
										<td>
											<a href="product-detail-left-sidebar.html">
												<img width="80" alt="Product Image" class="img-responsive" src="img/product/19.jpg">
											</a>
										</td>
										<td>
											<a href="product-detail-left-sidebar.html" class="product-name">Organic Strawberry Fruits</a>
										</td>
										<td class="text-center">
											$265
										</td>
										<td>
											<div class="product-quantity">
												<div class="qty">
													<div class="input-group">
														<input type="text" name="qty" value="1" data-min="1">
														<span class="adjust-qty">
															<span class="adjust-btn plus">+</span>
															<span class="adjust-btn minus">-</span>
														</span>
													</div>
												</div>
											</div>
										</td>
										<td class="text-center">
											$265
										</td>
									</tr>
									
									<tr>
										<td class="product-remove">
											<a title="Remove this item" class="remove" href="#">
												<i class="fa fa-times"></i>
											</a>
										</td>
										<td>
											<a href="product-detail-left-sidebar.html">
												<img width="80" alt="Product Image" class="img-responsive" src="img/product/31.jpg">
											</a>
										</td>
										<td>
											<a href="product-detail-left-sidebar.html" class="product-name">Organic Strawberry Fruits</a>
										</td>
										<td class="text-center">
											$150
										</td>
										<td>
											<div class="product-quantity">
												<div class="qty">
													<div class="input-group">
														<input type="text" name="qty" value="2" data-min="1">
														<span class="adjust-qty">
															<span class="adjust-btn plus">+</span>
															<span class="adjust-btn minus">-</span>
														</span>
													</div>
												</div>
											</div>
										</td>
										<td class="text-center">
											$300
										</td>
									</tr>
								</tbody>
								
								<tfoot>
									<tr class="cart-total">
										<td rowspan="3" colspan="3"></td>
										<td colspan="2" class="text-right">Total products</td>
										<td colspan="1" class="text-center">$565</td>
									</tr>
									<tr class="cart-total">
										<td colspan="2" class="text-right">Total shipping</td>
										<td colspan="1" class="text-center">$10</td>
									</tr>
									<tr class="cart-total">
										<td colspan="2" class="total text-right">Total</td>
										<td colspan="1" class="total text-center">$575</td>
									</tr>
								</tfoot>
							</table>
						</div>
						
						<div class="checkout-btn">
							<a href="product-checkout.html" class="btn btn-primary pull-right" title="Proceed to checkout">
								<span>Proceed to checkout</span>
								<i class="fa fa-angle-right ml-xs"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			





<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>