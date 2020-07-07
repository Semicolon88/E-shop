<?php
    //include_once "../../../src/Autoload.inc.php";
    include_once "../../../Classes/Model/Database.class.php";
    include_once "../../../Classes/Controller/Controller.class.php";
    include_once "../../../src/modal.inc.php";
    include_once "../../../src/header.inc.php";
    use Classes\Controller as Ctrl;
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
                                if(!empty($img)):
                                    $count = 0;
                            ?>
                                    <div class="row">
                                        <?php
                                            foreach($img as $photo): 
                                        ?>
                                            <div style="width:150px;height:150px;" class='col-4 col-md-4 col-sm-4'>
                                                <img src="<?=$photo?>" alt="img" style="width:100%;height:80%;"/>
                                                <div class="row">
                                                    <div class="upload-btn-wrapper text-center col-6 my-2" >
                                                        <button class="bttn mx-4"><i class="fas fa-pencil-alt"></i></button>
                                                        <input type="file" name="photo[]" class='edit' id='edit<?=$count?>'/>
                                                    </div>
                                                    <div class="upload-btn-wrapper text-center col-6 my-2" >
                                                        <button class="btn" id='delete<?=$count?>' onclick='del(this.id);return false;'><i class="fas fa-trash-alt"></i></button>
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
                                    <input type="file" name="photo[]" id="photo" class="form-control" multiple>
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
                                    <input type="button" class='form-control mx-4'>
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
                            <input type="submit" value="Add" id='<?=((isset($_GET['edit']))?'edit':'sub')?>' name="<?=((isset($_GET['edit']))?'edit':'submit')?>" class=" btn btn-outline-success pull-right">
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
<!--?php include_once "../../../src/modal.inc.php";?>
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
    /*let editData = [];
    let deleteData = [];
    let del = (id)=>
    {
        deleteData.push(id);
        //alert(deleteData);
    }
    /*$('.edit').on('change',()=>{
        console.log('changed');
    })*/
    /*let edt = (id)=>{
        $('#'+id).on('change',()=>{
            let xhr = new FormData();
            let data = document.querySelector('#'+id).files;
            //xhr.open('post',../../../src/modal.inc.php');
            //xhr.send(data);
            xhr.append('photo',data);
            $.ajax({
                url : '../../../src/modal.inc.php',
                method : 'POST',
                data : xhr,
                processData : false,
                cache : false,
                contentType : false,
                success : (res)=>{
                    console.log(res);
                }
            })
        })
    }*/
    /*$("#addon-wrapping").click((e)=>{
        e.preventDefault();
        let data = $("#info").val();
        $.ajax({
            url : '../../../src/modal.inc.php',
            method : 'POST',
            data : {data : data},
            success : (res)=>{
                $('#myModal').modal('show');
            }
        })
    })
   $('#sub').click((e)=>
    {
        e.preventDefault();
        let data = new FormData();
        let files = document.querySelector('#photo').files;
        for(let file of files)
        {
            data.append('photo[]',file);
        }
        let keys = ['product_name','price','list_price','category','brand','portfolio','description','photo'];
        let values = [$('#product_name').val(),$('#price').val(),$('#list_price').val(),$('#category').val(),$('#brand').val(),$('#portfolio').val(),$('#description').val(),''];
        for(let key in keys)
        {
            data.append(keys[key],values[key]);
        }
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = ()=>
        {
            if((xhr.readyState == 4) && (xhr.status == 200))
            {
                for(let ele of keys)
                {
                    $('#'+ele).val('');
                }
            }
        }
        xhr.open('post','../../../src/modal.inc.php');
        xhr.send(data);
    })
    $('#edit').click((e)=>{
        e.preventDefault();
        let data = new FormData();
        let keys = ['product_name','price','list_price','category','brand','portfolio','description'];
        let values = [$('#product_name').val(),$('#price').val(),$('#list_price').val(),$('#category').val(),$('#brand').val(),$('#portfolio').val(),$('#description').val()];
        for(let key in keys)
        {
            data.append(keys[key],values[key]);
        }
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = ()=>
        {
            if((xhr.readyState == 4) && (xhr.status == 200))
            {
                /*for(let ele of keys)
                {
                    $('#'+ele).val('');
                }
                console.log('sent')
           }
        }
        xhr.open('post','../../../src/modal.inc.php');
        xhr.send(data);
    })*/
</script>
</body>

 
</html>