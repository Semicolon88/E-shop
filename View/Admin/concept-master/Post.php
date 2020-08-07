<?php
    include_once "../../../Classes/Model/Session.class.php";
    include_once "../../../Classes/Model/Database.class.php";
    include_once "../../../Classes/Controller/Controller.class.php"; 
    //include "../../../src/Autoload.inc.php";
    
    $user = new Controller;
    if(!$user::is_logged_in()){
        $user::login_error_redirect("Login/login.php");
    }
    //include_once "../../../src/requests.inc.php";
    if(isset($_POST['submit']))
    {
        $obj = new Controller;
        $productName = $_POST['product_name'];
        $price = $_POST['price'];
        $listPrice = $_POST['list_price'];
        $cat = $_POST['category'];
        $port = $_POST['portfolio'];
        $brand = $_POST['brand'];
        $details = $_POST['details'];
        $sizes = $_POST['sizes'];


        $fields = [
            'product_name'=>$productName,
            'price'=>$price,
            'list_price'=>$listPrice,
            'category'=>$cat,
            'portfolio'=>$port,
            'brand'=>$brand,
            'description'=>$details,
            'sizes'=>$sizes
        ];
        foreach ($fields as $key => $value) 
        {
            if(isset($_POST[$key]) && empty($_POST[$key]))
            {
                $obj->error[] = "All feilds are required";
            break;
            }
        }
        if(empty($_FILES['photo']['name'][0])){
            $obj->error[] = "upload image";
        }else{
            $obj->setFile($_FILES);
            $obj->upload_image();
        }
        if(!empty($obj->error))
        {
            echo $obj->display_errors();
        }else{
            $obj->setData($fields);
            $obj->add();
        }
    }
    if(isset($_GET['edit']))
    {
        $edit_id = $_GET['edit'];
        $edit_data = new Controller;
        $data = $edit_data->select_this($edit_id);
        $img = explode(',',$data['photo']);
        $res = "";
        if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name']))
        {
            $edit_index = $_POST['file-index'];
            $edit_data->setFile($_FILES['file']);
            $edit_data->update_image($edit_id,$edit_index);
        }
        if(isset($_POST['del-index'])){
            $edit_data->delete_image($edit_id,$_POST['del-index']);
        }
        if(isset($_POST['edit']))
        { 
            if(isset($_FILES['photo']) && !empty($_FILES['photo']['name'])){
                $edit_data->setFile($_FILES);
                $edit_data->upload_image();
                //print_r($_POST);
                //print_r($_FILES);
            }
            $productName = $_POST['product_name'];
            $price = $_POST['price'];
            $listPrice = $_POST['list_price'];
            $cat = $_POST['category'];
            $port = $_POST['portfolio'];
            $brand = $_POST['brand'];
            $details = $_POST['details'];
            $sizes = $_POST['sizes'];
            $photo = explode(',',$_POST['img']);
            $fields = [
                'product_name'=>$productName,
                'price'=>$price,
                'list_price'=>$listPrice,
                'category'=>$cat,
                'portfolio'=>$port,
                'brand'=>$brand,
                'description'=>$details,
                'sizes'=>$sizes
            ];
            foreach ($fields as $key => $value) 
            {
                if(isset($_POST[$key]) && empty($_POST[$key]))
                {
                    $edit_data->error[] = "All feilds are required";
                break;
                }
            }
            if(!empty($edit_data->error))
            {
                echo $edit_data->display_errors();
            }else
            {
                $edit_data->setData($fields);
                if(!empty($edit_data->data))
                {
                    $edit_data->update($edit_id);
                }
            }
        }           
    }
    include_once "../../../src/header.inc.php";
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="content">
                <!--content-->
                <form action="Post.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'')?>" method="POST" id='form' enctype="multipart/form-data">
                    <div class="row my-4 mx-3">
                        <div class="form-group col-12 col-md-4 col-sm-12">
                            <label for="name">Title</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" value="<?=((isset($_GET['edit']))?$data['product_name']:'')?>">
                        </div>
                        <div class="form-group col-12 col-md-4 col-sm-12">
                            <label for="price">Price:</label>
                            <input type="number" name="price" id="price" class="form-control" min=0 value="<?=((isset($_GET['edit']))?$data['price']:'')?>">
                        </div>
                        <div class="form-group col-12 col-md-4 col-sm-12">
                            <label for="listPrice">List Price:</label>
                            <input type="text" name="list_price" id="list_price" class="form-control" value="<?=((isset($_GET['edit']))?$data['list_price']:'')?>">
                        </div>
                    </div>
                    <div class="row mx-3 my-4">
                        <div class="form-group col-md-12 col-lg-6 col-sm-12">
                            <?php
                                if(!empty($img[0])):
                                    $count = 0;
                            ?>
                                    <div class="row">
                                        <?php
                                            foreach($img as $photo): 
                                        ?>
                                                <div style="width:150px;height:150px;" class='col-4 col-md-4 col-sm-4'>
                                                    <img src="<?=$photo?>" alt="img" id="img-<?=$count?>" style="width:100%;height:80%;"/>
                                                    <div class="row">
                                                        <div class="upload-btn-wrapper text-center col-6 my-2" >
                                                            <button class="bttn mx-4"><i class="fas fa-pencil-alt"></i></button>
                                                            <input type="file" class='edit' id='edit-<?=$count?>' onclick ='getId(this.id);'/>
                                                        </div>
                                                        <div class="upload-btn-wrapper text-center col-6 my-2" >
                                                            <button class="btn" id='delete-<?=$count?>' onclick='del(this.id);return false;'><i class="fas fa-trash-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                                $count++;
                                            endforeach;
                                        ?> 
                                    </div> 
                            <?php
                                else:    
                            ?>
                                    <label for="photo">Product Image</label>
                                    <input type="file" name="photo[]" class="form-control" multiple>
                            <?php
                                endif;
                            ?>
                        </div>
                        <div class="form-group col-sm-12 col-lg-5 col-md-12">
                            <div class="input-group flex-nowrap my-4">
                                <input type="text" class="form-control" id="info" placeholder="Available Product" aria-label="Username" aria-describedby="addon-wrapping">
                                <div class="input-group-prepend">
                                    <button class="input-group-text btn" id="addon-wrapping">Add Sizes</button>
                                </div>
                                <!--div class="form-g col-md-5"-->
                                    <input type="text" name='img' value="<?=$data['photo']?>" class='form-control mx-4'>
                                    <input type="text" id='val' name='sizes' value="<?=$data['sizes']?>" class='form-control mx-4'>
                                <!--/div-->
                            </div>
                        </div>
                    </div>
            <!--/div-->
                    <div class="row mx-3 my-4">
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="Category">Category:</label>
                            <input type="text" name="category" id="category" class="form-control" value="<?=((isset($_GET['edit']))?$data['category']:'')?>">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="brand">Brand:</label>
                            <input type="text" name="brand" id="brand" class="form-control" min=0 value="<?=((isset($_GET['edit']))?$data['brand']:'')?>">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="portfolio">Portfolio:</label>
                            <input type="text" name="portfolio" id="portfolio" class="form-control" value="<?=((isset($_GET['edit']))?$data['portfolio']:'')?>">
                        </div>
                    </div>
                    <div class="row mx-3 my-4">
                        <div class="form-group col-md-8 col-sm-8">
                            <label for="description">Description*:</label>
                            <textarea id="description" name="details" class="form-control tinymce" rows="6"><?=((isset($_GET['edit']))?$data['description']:'')?></textarea>
                        </div>
                        <div class="form-group pull-right col-sm-4 col-md-4"><br>
                            <a href="post.php" class="btn btn-outline-dark">Cancel</a>&nbsp;&nbsp;
                            <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add')?>" id='<?=((isset($_GET['edit']))?'edit':'sub')?>' name="<?=((isset($_GET['edit']))?'edit':'submit')?>" class=" btn btn-outline-success pull-right">
                        </div><div class="çlearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>   
</div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<div class="footer">
   <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
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
<!-- ============================================================== -->
<!-- end wrapper  -->
<!-- ============================================================== -->
</div>
</div>
<!--Modal-->
<div class="modal" tabindex="-1" id='myModal' role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center">
          <table class='text-center'>
              <thead>
                  <tr>
                      <th>Size</th>
                      <th>Quantity</th>
                  </tr>
              </thead>
              <tbody id='receiver'>

              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" id='save' data-dismiss='modal' class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<!-- jquery 3.3.1  -->
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<!-- bootstap bundle js-->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<!-- slimscroll js-->
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<!-- main js-->
<script src="assets/libs/js/main-js.js"></script>
<script>
    $("#addon-wrapping").click((e)=>
    {
        e.preventDefault();
        let data = $("#info").val();
       $.ajax({
            url : '../../../src/requests.inc.php',
            method : 'POST',
            data : {data : data},
            success : (res)=>{
                $('#myModal').modal('toggle');
                $('#receiver').html(res);
            }
        })
    })


    $('#save').click(()=>
    {
        let qty = '';
        let dat = $('#receiver').children('tr');
        for(let i = 0;i < dat.length;++i){
            qty += $('#size'+i).val()+':'+$('#qty'+i).val()+",";
        }
        $('#val').val(qty);
    })

    
    let getId = (id)=>
    {
        $('#'+id).change(()=>
        {
            let file = document.querySelector('#'+id).files[0];
            let formdata = new FormData();
            formdata.append('file',file);
            formdata.append('file-index',id.split('-').pop());
            $.ajax({
                url : '<?=$_SERVER['PHP_SELF']?>?edit=<?=$data['id']?>',
                method : 'POST',
                data : formdata,
                cache : false,
                contentType : false,
                processData : false,
                success : function(res)
                {
                    let index = id.split('-').pop();
                    $('#img-'+index).attr('src',res);
                }
            })
        });
    }

    let del = (id)=>
    {
        let index = id.split('-').pop();
        $.ajax({
            url : '../../../src/requests.inc.php?edit=<?=$data['id']?>',
            method : 'POST',
            data : {'del-index : index},
            success : (res)=>
            {
                console.log(res);
            } 
        })
    }
</script>
</body>

 
</html>