<?php 
if(isset($_POST['page'])){ 
    require_once 'includes/session.php';
    include_once 'Pagination.class.php'; 
    require_once 'includes/config.php'; 

    $baseURL = 'get_price_data.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 10; 
     
    // Set conditions for search 
    $whereSQL = ''; 
    $whereSQL1 = '';
    if(!empty($_POST['keywords'])){ 
        $whereSQL = " WHERE (item_name LIKE '%".$_POST['keywords']."%' OR barcode LIKE '%".$_POST['keywords']."%' ) ";
        $whereSQL1 = " WHERE (tbl_items.item_name LIKE '%".$_POST['keywords']."%' OR tbl_items.barcode LIKE '%".$_POST['keywords']."%' OR tbl_cat.catagory_name  LIKE '%".$_POST['keywords']."%') ";  
    } 

    $query   = $conn->query("SELECT COUNT(*) as rowNum FROM tbl_items ".$whereSQL); 
    $result  = $query->fetch_assoc(); 
    $rowCount= $result['rowNum']; 
     
    // Initialize pagination class 
    $pagConfig = array( 
        'baseURL' => $baseURL, 
        'totalRows' => $rowCount, 
        'perPage' => $limit, 
        'currentPage' => $offset, 
        'contentDiv' => 'dataContainer', 
        'link_func' => 'searchFilter' 
    ); 
    $pagination =  new Pagination($pagConfig); 
 
    // Fetch records based on the offset and limit 
    $query = $conn->query("SELECT tbl_items.*, tbl_catagory.cat_name, tbl_cat.catagory_name FROM ((tbl_items INNER JOIN tbl_catagory ON tbl_items.brand_id = tbl_catagory.id) INNER JOIN tbl_cat ON tbl_items.category = tbl_cat.id) $whereSQL1 ORDER BY tbl_items.id ASC LIMIT $offset,$limit"); 
?> 
    <!-- Data list container --> 
    <table class="table table-striped"> 
    <thead> 
              <tr>
                <th scope="col">#</th>
                <th scope="col">Item Name</th>
                <th scope="col">Barcode</th>
                <th scope="col">Opening Qty</th>
                <th scope="col">Stock</th>
                <th scope="col">Purchase</th>
                <th scope="col">Retail</th>
                <th scope="col" >Mini Wholesale</th>
                <th scope="col" >Wholesale</th>
                <th scope="col" >Type A</th>
                <th scope="col" >Type B</th>
                <th scope="col" >Type C</th>
            </tr> 
    </thead> 
    <tbody> 
        <?php 
        if($query->num_rows > 0){ 
            while($data = $query->fetch_assoc()){ 
                $offset++;
                        $id = $data['item_id'];
                        $brand_id = $data['brand_id'];
                        $item_name = $data['item_name'];
                        $item_image = $data['item_image'];
                        $created_date = $data['created_date'];
                        $barcode = $data['barcode']; 
                        $catname=$data['cat_name'];
                        $catagory_name=$data['catagory_name'];
                        $purchase=$data['purchase'];
                        $retail=$data['retail'];
                        $mini_wholesale=$data['mini_wholesale'];
                        $wholesale=$data['wholesale'];
                        $type_a=$data['type_a'];
                        $type_b=$data['type_b'];
                        $type_c=$data['type_c'];

                        $query3 = mysqli_query($conn,"SELECT SUM(qty_rec) as total_qty FROM tbl_purchase_detail where product='$id' and purchase_id='1'"); 

                                   $cdata = mysqli_fetch_assoc($query3) ;
                                   $total_qty=$cdata['total_qty'];
               $sql10=mysqli_query($conn, "SELECT user_privilege,created_by,user_id FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql10);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                $user_id=$data['user_id'];
                                
                               if($user_privilege=='branch')
                               {
                                $created_by=$user_id;
                               }
                               else
                               {
                                $created_by=$created_by;
                               }

               $sql1 = "SELECT  SUM(qty_rec) as pur_qty FROM tbl_purchase_detail where product='$id' and parent_id='$created_by'";
                      $pur_qty=0;
                      $sold_qty=0;
                      $sale_returned_qty=0;            

                  $result1 = mysqli_query($conn,$sql1);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $pur_qty = $row1['pur_qty'];
                     }

                    $sql2 = "SELECT sum(qty) as sold_qty FROM tbl_sale_detail where product = '$id' and parent_id='$created_by'";
                                      

                      $result1 = mysqli_query($conn,$sql2);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $sold_qty = $row1['sold_qty'];


                     }

                

                    $sql3 = "SELECT sum(returned_qty) as sale_returned_qty FROM tbl_sale_return_detail where product = '$id' and parent_id='$created_by'";
                        $result3 = mysqli_query($conn,$sql3);
                               while($row3 = mysqli_fetch_array($result3) ){
                                 $sale_returned_qty = $row3['sale_returned_qty'];


                             }
                
                      $stock_qty=$pur_qty-($sold_qty-$sale_returned_qty); 
                      if($stock_qty=='' || $stock_qty==0)
                        {
                          $stock_qty=0;
                        }
        ?> 
            <tr> 
                <th scope="row"><?php echo $offset; ?></th>
                    <td style="font-size: 12px;"><?php echo $catagory_name." ".$item_name;?></td>
                    <td style="font-size: 12px;"><span><?php echo $barcode;?></span></td>
                    <td style="font-size: 12px;"><?php 
                                              
                                              if($retail>0 && $stock_qty>0 && $total_qty>0){?>
                                               
                                                      <div class="body">

                                                        <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                                 <input type="text" class="form-control calculate " onchange="update_qty(<?php echo $offset;?>, <?php echo $id;?>, <?php echo $total_qty;?>)" maxlength="7"  name="total_qty" id="qty_<?php echo $offset;?>"  style="border-width: 3px; border-style: transparent;" value="<?php echo $total_qty;?>"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  <?php }else{?>
                                          <div class="body">
                                            <a href="#" data-toggle="modal" data-target="#opening<?php echo $id;?>" class="btn btn-sm btn-outline-success" title="Opening" style="font-size: 12px;">Add Opening</a>
                                          </div>
                                            <div id="opening<?php echo $id;?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-body">
                                                    <form action="operations/add_opening_stock.php" method="post" enctype="multipart/form-data">
                                                        <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                              <label>Opening Qty</label>
                                                                 <input type="text" class="form-control calculate "  maxlength="7"  name="opening_qty" required="" style="border-width: 3px; border-style: transparent;"></input>
                                                                  <input type="hidden" name="product" value="<?php echo $id;?>"></input>
                                                                  <input type="hidden" name="barcode" value="<?php echo $barcode;?>"></input>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                              <label>Retail Rate</label>
                                                                 <input type="text" class="form-control calculate "  maxlength="7"  name="sale_rate" required="" value="<?php echo $retail;?>" style="border-width: 3px; border-style: transparent;"></input>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                              <label>Pur Rate</label>
                                                                 <input type="text" class="form-control calculate "  maxlength="7"  name="purchase_rate" required="" value="<?php echo $purchase;?>" style="border-width: 3px; border-style: transparent;"></input>
                                                            </div>
                                                        </div> <hr>
                                                        <button type="submit" d="submit" name="add_opening" class="btn btn-primary">Add</button>
                                                        <button type="button"  class="btn btn-danger text-center" data-dismiss="modal" id="docmode">Close</button>                                          
                                                    </form>      
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                                  <?php } ?></td>
                                        <td><span><?php echo $stock_qty;?></span></td>
                                        <td>
                                          <div class="body">
                                                  <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                                <input type="text" class="form-control calculate purchase" maxlength="7"  name="purchase" data-id="<?php echo $id;?>"  data-id1="<?php echo $purchase;?>" style="border-width: 3px; border-style: transparent;" value="<?php echo $purchase;?>"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </td>
                                        <td>
                                          <div class="body">
                                                  <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                                <input type="text" class="form-control calculate retail" maxlength="7"  name="retail" data-id="<?php echo $id;?>" data-id1="<?php echo $retail;?>"  style="border-width: 3px; border-style: transparent;" value="<?php echo $retail;?>"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </td>
                                       <td>
                                          <div class="body">
                                                  <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                                <input type="text" class="form-control calculate mini" maxlength="7"  name="mini_wholesale" data-id="<?php echo $id;?>" data-id1="<?php echo $mini_wholesale;?>"  style="border-width: 3px; border-style: transparent;" value="<?php echo $mini_wholesale;?>"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </td>
                                        <td>
                                          <div class="body">
                                                  <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                                <input type="text" class="form-control calculate wholesale" maxlength="7"  name="wholesale" data-id="<?php echo $id;?>" data-id1="<?php echo $wholesale;?>" style="border-width: 3px; border-style: transparent;" value="<?php echo $wholesale;?>"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </td>
                                        <td>
                                          <div class="body">
                                                  <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                                <input type="text" class="form-control calculate typea" maxlength="7"  name="retail" data-id="<?php echo $id;?>" data-id1="<?php echo $type_a;?>"  style="border-width: 3px; border-style: transparent;" value="<?php echo $type_a;?>"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </td>
                                         <td>
                                          <div class="body">
                                                  <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                                <input type="text" class="form-control calculate typeb" maxlength="7"  name="type_b" data-id="<?php echo $id;?>" data-id1="<?php echo $type_b;?>"  style="border-width: 3px; border-style: transparent;" value="<?php echo $type_b;?>"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </td>
                                         <td>
                                          <div class="body">
                                                  <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                                <input type="text" class="form-control calculate typec" maxlength="7"  name="type_c" data-id="<?php echo $id;?>" data-id1="<?php echo $type_c;?>"  style="border-width: 3px; border-style: transparent;" value="<?php echo $type_c;?>"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </td>
                                        
            </tr> 
        <?php 
            } 
        }else{ 
            echo '<tr><td colspan="6">No records found...</td></tr>'; 
        } 
        ?> 
    </tbody> 
    </table> 
     
    <!-- Display pagination links --> 
    <?php echo $pagination->createLinks(); ?> 
<?php 
} 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  $('.calculate').keyup(function(e)
  {
  var character = String.fromCharCode(event.keyCode);
    return isValidC(character);  
});
  function isValidC(str) {
    return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?a-zA-Z]/g.test(str);
}
</script>
<script type="text/javascript">
$('.purchase').change(function() {
    
    var item_id = $(this).attr('data-id');
    var rate = $(this).val();
    var purchase = $(this).attr('data-id1');
    if(rate=='' || rate=='0')
    {
       $(this).val(purchase);
       $("#danger-alert3").show();
       $("#danger-alert3").fadeTo(4000, 200).slideUp(200, function() {
       $("#danger-alert3").slideUp(200);
                    });
       return false;

    }
    var type='0';

    $.ajax({
            url:"operations/add_item_price.php",
            method:"POST",
            data:{item_id:item_id, rate:rate, type:type},
            success: function(data)
            {
                $("#success-alert3").show();
                $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
                $("#success-alert3").slideUp(200);
                    });
            },
                    
       });
});
 $('.retail').change(function() {
 
    var item_id = $(this).attr('data-id');
    var rate = $(this).val();
    var type='1';
    var retail = $(this).attr('data-id1');
    if(rate=='' || rate=='0')
    {
       $(this).val(retail);
       $("#danger-alert3").show();
       $("#danger-alert3").fadeTo(4000, 200).slideUp(200, function() {
       $("#danger-alert3").slideUp(200);
                    });
       return false;

    }
    $.ajax({
            url:"operations/add_item_price.php",
            method:"POST",
            data:{item_id:item_id, rate:rate, type:type},
            success: function(data)
            {
                $("#success-alert3").show();
                $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
                $("#success-alert3").slideUp(200);
                    });
            },
                    
       });
});
 $('.mini').change(function() {
 
    var item_id = $(this).attr('data-id');
    var rate = $(this).val();
    var type='2';
    var mini = $(this).attr('data-id1');
    if(rate=='' || rate=='0')
    {
       $(this).val(mini);
       $("#danger-alert3").show();
       $("#danger-alert3").fadeTo(4000, 200).slideUp(200, function() {
       $("#danger-alert3").slideUp(200);
                    });
       return false;

    }
    $.ajax({
            url:"operations/add_item_price.php",
            method:"POST",
            data:{item_id:item_id, rate:rate, type:type},
            success: function(data)
            {
                $("#success-alert3").show();
                $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
                $("#success-alert3").slideUp(200);
                    });
            },
                    
       });
});
  $('.wholesale').change(function() {
 
    var item_id = $(this).attr('data-id');
    var rate = $(this).val();
    var type='3';
    var wholesale = $(this).attr('data-id1');
    if(rate=='' || rate=='0')
    {
       $(this).val(wholesale);
       $("#danger-alert3").show();
       $("#danger-alert3").fadeTo(4000, 200).slideUp(200, function() {
       $("#danger-alert3").slideUp(200);
                    });
       return false;

    }
    $.ajax({
            url:"operations/add_item_price.php",
            method:"POST",
            data:{item_id:item_id, rate:rate, type:type},
            success: function(data)
            {
                $("#success-alert3").show();
                $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
                $("#success-alert3").slideUp(200);
                    });
            },
                    
       });
});
    $('.typea').change(function() {
 
    var item_id = $(this).attr('data-id');
    var rate = $(this).val();
    var type='4';
    var typea = $(this).attr('data-id1');
    if(rate=='' || rate=='0')
    {
       $(this).val(typea);
       $("#danger-alert3").show();
       $("#danger-alert3").fadeTo(4000, 200).slideUp(200, function() {
       $("#danger-alert3").slideUp(200);
                    });
       return false;

    }
    $.ajax({
            url:"operations/add_item_price.php",
            method:"POST",
            data:{item_id:item_id, rate:rate, type:type},
            success: function(data)
            {
                $("#success-alert3").show();
                $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
                $("#success-alert3").slideUp(200);
                    });
            },
                    
       });
});
       $('.typeb').change(function() {
 
    var item_id = $(this).attr('data-id');
    var rate = $(this).val();
    var type='5';
    var typeb = $(this).attr('data-id1');
    if(rate=='' || rate=='0')
    {
       $(this).val(typeb);
       $("#danger-alert3").show();
       $("#danger-alert3").fadeTo(4000, 200).slideUp(200, function() {
       $("#danger-alert3").slideUp(200);
                    });
       return false;

    }
    $.ajax({
            url:"operations/add_item_price.php",
            method:"POST",
            data:{item_id:item_id, rate:rate, type:type},
            success: function(data)
            {
                $("#success-alert3").show();
                $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
                $("#success-alert3").slideUp(200);
                    });
            },
                    
       });
});
$('.typec').change(function() {
 
    var item_id = $(this).attr('data-id');
    var rate = $(this).val();
    var type='6';
    var typec = $(this).attr('data-id1');
    if(rate=='' || rate=='0')
    {
       $(this).val(typec);
       $("#danger-alert3").show();
       $("#danger-alert3").fadeTo(4000, 200).slideUp(200, function() {
       $("#danger-alert3").slideUp(200);
                    });
       return false;

    }
    $.ajax({
            url:"operations/add_item_price.php",
            method:"POST",
            data:{item_id:item_id, rate:rate, type:type},
            success: function(data)
            {
                $("#success-alert3").show();
                $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
                $("#success-alert3").slideUp(200);
                    });
            },
                    
       });
});
  function update_qty(row, itemid, old_qty) {
    
  
    var total_qty = $("#qty_"+row).val();

    if(total_qty=='' || total_qty=='0')
    {
       $("#qty_"+row).val(old_qty);
       $("#danger-alert4").show();
       $("#danger-alert4").fadeTo(4000, 200).slideUp(200, function() {
       $("#danger-alert4").slideUp(200);
                    });
       return false;

    }
      $.ajax({
                method: "POST",
                url: "operations/get_stock_update.php",
                data: {itemid:itemid},             
                })
                .done(function(response_stock){
       
                  if(response_stock!='0')
                  {
                    $.ajax({
                          url:"operations/add_item_qty.php",
                          method:"POST",
                          data:{itemid:itemid, total_qty:total_qty},
                          success: function(data)
                          {
                           
                              $("#success-alert4").show();
                              $("#success-alert4").fadeTo(4000, 200).slideUp(200, function() {
                              $("#success-alert4").slideUp(200);
                                  });
                          },
                                  
                     });
                  }
                  else
                  {
                       
                         $("#qty_"+row).val(old_qty);
                        $("#success-alert5").show();
                              $("#success-alert5").fadeTo(4000, 200).slideUp(200, function() {
                              $("#success-alert5").slideUp(200);
                                  });

                              
                              return false;
                  }
                });

    
}

</script>