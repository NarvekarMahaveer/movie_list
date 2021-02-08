<?php
include ("header.php");
$cat_dish='';
$cat_dish_arr=array();
$type='';
$search_str='';
if(isset($_GET['cat_dish'])){
	$cat_dish=get_safe_value($_GET['cat_dish']);
	$cat_dish_arr=array_filter(explode(':',$cat_dish));
	$cat_dish_str=implode(",",$cat_dish_arr);
}

if(isset($_GET['type'])){
	$type=get_safe_value($_GET['type']);
}

if(isset($_GET['search_str'])){
	$search_str=get_safe_value($_GET['search_str']);
}

$arrType=array("veg","non-veg","both");
?>

<div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li>
                    </li>
					</ul>
                </div>

            </div>
        </div>
		<?php
		if($website_close==1){
			echo '<div style="text-align: center;margin-top: 50px;"><h3>';
			echo $website_close_msg;
			echo '</h3></div>';
		}
		?>
        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">

                        <?php
                            $cat_id=0;
                            $product_sql="select * from dish where status=1";
                            if($cat_dish!=''){
                                $product_sql.=" and category_id in ($cat_dish_str) ";
                            }
							if($type!='' && $type!='both'){
                                $product_sql.=" and type ='$type' ";
                            }

							if($search_str!=''){
                                $product_sql.=" and (dish like '%$search_str%' or dish_detail like '%$search_str%') ";
                            }

                            $product_sql.=" order by dish desc";
                            $product_res=mysqli_query($con,$product_sql);
                            $product_count=mysqli_num_rows($product_res);
                        ?>
                        <div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                                <?php if($product_count>0){?>
                                    <div class="row">
                                        <?php while($product_row=mysqli_fetch_assoc($product_res)){?>
                                        <div class="product-width  col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                            <div class="product-wrapper">
                                                <div class="product-img">
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo SITE_DISH_IMAGE.$product_row['image']?>" id="myBtn">
														<!-- Trigger/Open The Modal -->
<!-- Trigger/Open The Modal -->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2><?php echo $product_row['dish']; ?></h2>
    </div>
    <div class="modal-body">
      <p><?php echo $product_row['type']; ?></p>
     </div>
    </div>
</div>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
                                                    </a>
                                                </div>
                                                <div class="product-content" id="dish_detail">
                                                    <h4>
														<?php
														if($product_row['type']=='veg'){
															echo "<img src='assets/img/icon-img/veg.png'/>";
														}else{
															echo "<img src='assets/img/icon-img/non-veg.png'/>";
														}
														?>



														<a href="javascript:void(0)"><?php echo $product_row['dish'];
														# echo $product_row['dish_detail'];
														getRatingByDishId($product_row['id']);
														?>

														</a>
                                                    </h4>
													<?php
													$dish_attr_res=mysqli_query($con,"select * from dish_details where status='1' and dish_id='".$product_row['id']."' order by price asc");
													?>
                                                    <div class="product-price-wrapper">
                                                        <?php
														while($dish_attr_row=mysqli_fetch_assoc($dish_attr_res)){
															if($website_close==0){
															echo "<input type='radio' class='dish_radio' name='radio_".$product_row['id']."' id='radio_".$product_row['id']."' value='".$dish_attr_row['id']."'/>";
															}
															echo $dish_attr_row['attribute'];
															echo "&nbsp;";
															echo "<span class='price'>(".$dish_attr_row['price'].")</span>";
															$added_msg="";
															if(array_key_exists($dish_attr_row['id'],$cartArr)){
																$added_qty=getUserFullCart($dish_attr_row['id']);
																$added_msg="(Added -$added_qty)";
															}
															echo " <span class='cart_already_added' id='shop_added_msg_".$dish_attr_row['id']."'>".$added_msg."</span>";
															echo "&nbsp;&nbsp;&nbsp;";
														}
														?>
                                                    </div>
													<?php if($website_close==0){?>
													<div class="product-price-wrapper">
														<select class="select" id="qty<?php echo $product_row['id']?>">
															<option value="0">Qty</option>
															<?php
															for($i=1;$i<=3;$i++){
																echo "<option>$i</option>";
															}
															?>
														</select>
														<i class="fa fa-cart-plus cart_icon" aria-hidden="true" onclick="add_to_cart('<?php echo $product_row['id']?>','add')"></i>
													</div>
													<?php } else{
														?>
														<div class="product-price-wrapper">
														<strong><?php echo $website_close_msg?>
														</strong></div>
														<?php
													}
													?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                <?php } else{
                                    echo "No dish found";
                                }?>
                            </div>

                        </div>
                    </div>
                    <?php
                    $cat_res=mysqli_query($con,"select * from category where status=1 order by order_number desc")
                    ?>
                    <div class="col-lg-3">
                        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title">Shop By Categories</h4>
								<div class="shop-catigory">
									<ul id="faq" class="category_list">
										<li><a href="<?php echo FRONT_SITE_PATH?>shop"><u>clear</u></a></li>
                                        <?php
                                        while($cat_row=mysqli_fetch_assoc($cat_res)){
                                            $class="selected";
                                            if($cat_id==$cat_row['id']){
                                                $class="active";
                                            }
											$is_checked='';
											if(in_array($cat_row['id'],$cat_dish_arr)){
												$is_checked="checked='checked'";
											}

											echo "<li> <input $is_checked onclick=set_checkbox('".$cat_row['id']."') type='checkbox' class='cat_checkbox' name='cat_arr[]' value='".$cat_row['id']."'/>".$cat_row['category']."</li>";

                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
							<br>
							 <a class="btn btn-large btn-warning" href="cart.php">Checkout</a>
						 <a class="btn btn-large btn-primary" href="checkout.php">View Cart</a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
		<form method="get" id="frmCatDish">
			<input type="hidden" name="cat_dish" id="cat_dish" value='<?php echo $cat_dish?>'/>
			<input type="hidden" name="type" id="type" value='<?php echo $type?>'/>
			<input type="hidden" name="search_str" id="search_str" value='<?php echo $search_str?>'/>

		</form>

<?php
include("footer.php");
?>
