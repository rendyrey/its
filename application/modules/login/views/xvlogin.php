<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>E-Learning</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?=base_url()?>assets/css/sms-login.css" />
         <style>
            #response{display: none}
  </style>   
    </head>
    <body>
        <div id="loginbox">  
               
            <form id="loginform" class="form-vertical" action="<?php echo base_url() ?>login/logincek" method="POST"> 
				 <div class="control-group normal_text"> <h3><img src="<?=base_url()?>assets/img/logo.png" alt="Logo" /></h3></div>

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="Email" name="email" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password" />
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                   
                    <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-recover">Registrasi</a></span>
                    <span class="pull-right" id="response">Terdapat kesalahan dalam menginput Username dan Password</span> 
                    <span class="pull-right"><input type="submit" class="btn btn-success" value="Login" /></span>
                </div>
            </form>

            <form id="recoverform" action="<?=site_url()?>login/registrasi" class="form-vertical" method="POST" enctype="multipart/form-data">
				<p class="normal_text">Registrasi E-Learning</p>
				    <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="Username" name="username" />
                        </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="password" placeholder="Password" name="password" />
                        </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="Email" name="email" />
                        </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="Nama" name="nama" />
                        </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="file" name="gambar" id="gambar" />
                        </div>
                    </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-login">&laquo; Login</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-info" value="Registrasi" /></span>
                </div>
            </form>
        </div>
        
        <script src="<?=base_url()?>assets/js/jquery.min.js"></script>  
        <script src="<?=base_url()?>assets/js/sms.login.js"></script> 
    </body>
<script>
        $(document).ready(function (){
            $("#loginform").submit(function (e){
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                var data = $(this).serialize();
                
                $.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
                   if(data !=='')
                    {
                        $("#response").show('fast');
                        $("#response").effect( "shake" );
                        $('#loginform')[0].reset();
                    }
                    else
                    {
                    window.location.href='<?php echo site_url() ?>dashboard/';
                    throw new Error('go');
                    } 
                });
            });
            
            $( "div" ).each(function( index ) {
            var cl = $(this).attr('class');
            if(cl =='')
                {
                    $(this).hide();
                }
            });
            
        });
        </script>    
</html>
