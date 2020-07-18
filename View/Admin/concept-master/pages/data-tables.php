<?php
    include_once "../../../../Classes/Model/Session.class.php";
    include_once "../../../../Classes/Model/Database.class.php";
    include_once "../../../../Classes/Controller/Controller.class.php";
    //use Classes\Controller\Controller as Controller;
    $user = new Controller;
    if(!$user::is_logged_in()){
        $user::login_error_redirect("../Login/login.php");
    } 
    include_once "../../../../src/requests.inc.php";
    include_once "../../../../src/test.php";
?>
<div class="row">
<!-- ============================================================== -->
<!-- basic table  -->
<!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="container bg-white">
            <a href="../Post.php" class="btn btn-outline-dark  m-4">Add Product</a>
            <div class="card-body">
                <div class="table-responsive">
                     <table class="table table-striped  table-bordered fist text-center">
                        <thead class='text-white'>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>List Price</th>
                                <th>Available quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $data = new Controller;
                                $data = $data->selectAll();
                                if(!empty($data)):
                                    foreach($data as $row):
                            ?>
                                        <tr>
                                            <td><?=$row['product_name']?></td>
                                            <td><?=$row['price']?></td>
                                            <td><?=$row['list_price']?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        <p>
										                    <b class="caret" style="margin-left:25%"></b>
									                    </p>

                                                    </a>
                                                    <div class="dropdown-menu text-center">
                                                        <table class="mx-auto">
                                                            <thead>
                                                                <tr>
                                                                    <th>Size</th>
                                                                    <th>Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $size_array = explode(',',$row['sizes']);
                                                                    foreach($size_array as $size):
                                                                        $available = explode(':',$size);
                                                                        $sizes = $available[0];
                                                                        $qty = end($available);
                                                                ?>
                                                                        <tr>
                                                                            <td><?=$sizes?></td>
                                                                            <td><?=$qty?></td>
                                                                        </tr>
                                                                <?php
                                                                    endforeach;
                                                                ?>        
                                                            </tbody>
                                                        </table>
                                                                      
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="col-4 text-center">
                                                        <a href='../Post.php?delete=<?=$row['id']?>' class="btn btn-ouline-success btn-sm edt-btn"><i class="fas fa-trash-alt"></i></i></a>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <a href='../Post.php?edit=<?=$row['id']?>' class="btn btn-ouline-success btn-sm edt-btn"><i class="fas fa-pencil-alt"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                            <?php
                                    endforeach;
                                endif;    
                            ?>            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="javascript: void(0);">About</a>
                    <a href="javascript: void(0);">Support</a>
                    <a href="javascript: void(0);">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end footer -->
<!-- ============================================================== -->
</div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="../assets/vendor/multi-select/js/jquery.multi-select.js"></script>
<script src="../assets/libs/js/main-js.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/vendor/datatables/js/data-table.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript">
    	$(document).ready(function(){

        	//demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-look',
            	message: "Welcome to <b>Eko Heights</b>"

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>    
</body>
 
</html>