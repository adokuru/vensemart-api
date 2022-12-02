<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script   
</head>
<body>
<style type="text/css">
    .amount{
        background: #656565 none repeat scroll 0 0;
        color: #fff;
        font-family: "Abel",sans-serif;
        font-size: 48px;
        padding: 10px 30px;
    }
    .total-purchase {
        color: #2b2b2c;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
        text-transform: uppercase;
    }
    strong {
    font-weight: 700;
}
</style>

 <div class="container-fluid">
   

    <!-- Main content -->
  <section id="page-title" class="row">
    <div class="panel invoice">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4">
                    <div class="invoice-logo">
                            <!--<img src="../images/logo.png" height="60" alt=""/>-->
                    </div>
                </div>
                <div class="col-xs-4">
                    <h1>invoice</h1>
                </div>
                <div class="col-xs-4">
                    <div class="total-purchase">
                        Total Booking
                    </div>
                        <div class="amount"><?php echo @number_format($order->final_amount,0); ?></div>
                    </div>
                </div><br/><br/><br/>
                <div class="row">
                    <div class="col-xs-4">
                        <address>
                            <strong>OFFICE ADDRESS</stvvrong>
                            <br>Papa Global<br>
                            papaglobal@yopmail.com
                        </address>
                    </div>     
                    <div class="col-xs-4">
                        <strong>TO</strong>    
                              <br/><?php echo  $order->user_name;?>
                        <br/><?php  echo $order->user_email;?>
                        <br/>Mobile Number: <?php echo @$order->user_mobile;?>
                    </div>
                    <div class="col-xs-4 inv-info">
                        <strong>Order No.</strong>
                        <br/> <span>  : </span><?php echo $order->order_id; ?>
                        <br/><span> Delivery Date : </span>	<?php echo $order->expected_date?>
                        <br/> <span> Order Status : </span>	<?php echo $order->order_status ?>
                    </div>
                </div><br/><br/><br/>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>S_No.</th>
                        <th> Name </th>
                        <th class="">Qty</th>
                        <th class="">Uom</th>
                        <th class="">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($order_detail) > 0){$i=1; foreach($order_detail as $key =>$val){?>    
                    <tr>
                        
                        <td>{{$i}}</td>
                        <td><?php echo $val->product_name; ?></td>
                        <td class=""><?php echo $val->quantity;?></td>
                        <td class=""><?php echo $val->uom_name;?></td>
                        <td class=""><?php echo $val->discounted_price;?></td>
                    </tr>
                   <?php  $i++;} }?>
                    </tbody>
                </table><br/><br/>

                <div class="row">
                    <div class="col-xs-8">
                        <h4>PAYMENT METHOD</h4>
                        <ul class="list-unstyled">
                            <li><?php echo "Online"; ?></li>
                        </ul>
                    </div>
                    <div class="col-xs-4">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td><?php $order->final_amount;?> INR</td>
                            </tr>
                           
                            <tr>
                                <td>Discount</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>GRAND TOTAL</strong>
                                </td>
                                <td><strong><?php $order->final_amount;?> INR</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><br/><br/><br/>

               

            </div>
        </div>
    <!-- /.content -->

  </section>
  </div>
  
  </body>
</html>
