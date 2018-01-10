<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>E-Learning ITS</title>

	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />

	<!-- text fonts -->
	<link rel="stylesheet" href="<?=base_url()?>assets/fonts/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/ace.min.css" />

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
	<![endif]-->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/ace-rtl.min.css" />
	<style>
	#response{display: none}
	</style>
	<!--[if lte IE 9]>
	<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
	<![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="login-layout">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-leaf green"></i>
								<span class="red">E- </span>
								<span class="white" id="id-text2">Learning</span>
							</h1>
							<h4 class="blue" id="id-company-text">&copy; ITS</h4>
						</div>

						<div class="space-6"></div>

						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">


										<div class="space-6"></div>

										<form id="loginform" class="form-vertical" action="<?=site_url('Login/logincek');?>" method="POST">
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" placeholder="Email" name="email" class="form-control" />
														<i class="ace-icon fa fa-user"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" placeholder="Password" name="password" class="form-control" />
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>

												<div class="space"></div>

												<div class="clearfix">

													<button type="submit" class="width-35 pull-right btn btn-sm btn-primary" form="loginform">
														<i class="ace-icon fa fa-key"></i>
														<span class="bigger-110">Login</span>
													</button>
												</div>

												<div class="space-4"></div>
											</fieldset>
										</form>



										<div class="space-6"></div>

									</div><!-- /.widget-main -->

									<div class="toolbar clearfix">


										<div>
											<a href="#" data-target="#signup-box" class="user-signup-link">
												Registasi
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
										<?=$message;?>
									</div>
								</div><!-- /.widget-body -->
							</div><!-- /.login-box -->


							<div id="signup-box" class="signup-box widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header green lighter bigger">
											<i class="ace-icon fa fa-users blue"></i>
											Registrasi E-Learning ITS
										</h4>


										<div class="space-6"></div>


										<form id="recoverform" action="<?=site_url('Login/registrasi')?>" class="form-vertical" method="POST" enctype="multipart/form-data">
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" placeholder="Username" name="username" class="form-control" />
														<i class="ace-icon fa fa-envelope"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" placeholder="Password" name="password" class="form-control" />
														<i class="ace-icon fa fa-user"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" placeholder="Email" name="email" class="form-control" />
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" placeholder="Nama" name="nama" class="form-control" />
														<i class="ace-icon fa fa-retweet"></i>
													</span>
												</label>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="file" name="gambar" id="gambar" class="form-control" />
														<i class="ace-icon fa fa-retweet"></i>
													</span>
												</label>


												<div class="space-24"></div>

												<div class="clearfix">


													<button type="submit" class="width-65 pull-right btn btn-sm btn-success">
														<span class="bigger-110">Register</span>

														<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
													</button>
												</div>
											</fieldset>
										</form>
									</div>

									<div class="toolbar center">
										<a href="#" data-target="#login-box" class="back-to-login-link">
											<i class="ace-icon fa fa-arrow-left"></i>
											Back to login
										</a>
									</div>
								</div><!-- /.widget-body -->
							</div><!-- /.signup-box -->
						</div><!-- /.position-relative -->


					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.main-content -->
	</div><!-- /.main-container -->

	<!-- basic scripts -->

	<!--[if !IE]> -->
	<script src="<?=base_url()?>assets/js/jquery.2.1.1.min.js"></script>

	<!-- <![endif]-->

	<!--[if IE]>
	<script src="assets/js/jquery.1.11.1.min.js"></script>
	<![endif]-->

	<!--[if !IE]> -->
	<script type="text/javascript">
	window.jQuery || document.write("<script src='<?=base_url()?>assets/js/jquery.min.js'>"+"<"+"/script>");
	</script>

	<!-- <![endif]-->

	<!--[if IE]>
	<script type="text/javascript">
	window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
if('ontouchstart' in document.documentElement) document.write("<script src='<?=base_url()?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
	$(document).on('click', '.toolbar a[data-target]', function(e) {
		e.preventDefault();
		var target = $(this).data('target');
		$('.widget-box.visible').removeClass('visible');//hide others
		$(target).addClass('visible');//show target
	});
});



//you don't need this, just used for changing background
jQuery(function($) {
	$('#btn-login-dark').on('click', function(e) {
		$('body').attr('class', 'login-layout');
		$('#id-text2').attr('class', 'white');
		$('#id-company-text').attr('class', 'blue');

		e.preventDefault();
	});
	$('#btn-login-light').on('click', function(e) {
		$('body').attr('class', 'login-layout light-login');
		$('#id-text2').attr('class', 'grey');
		$('#id-company-text').attr('class', 'blue');

		e.preventDefault();
	});
	$('#btn-login-blur').on('click', function(e) {
		$('body').attr('class', 'login-layout blur-login');
		$('#id-text2').attr('class', 'white');
		$('#id-company-text').attr('class', 'light-blue');

		e.preventDefault();
	});

});
</script>
<script>
$(document).ready(function (){
	// $("#loginform").submit(function (e){
	// 	e.preventDefault();
	// 	var url = $(this).attr('action');
	// 	var method = $(this).attr('method');
	// 	var data = $(this).serialize();
  //
	// 	$.ajax({
	// 		url:url,
	// 		type:method,
	// 		data:data
	// 	}).done(function(data){
	// 		if(data =='')
	// 		{
	// 			$("#response").show('fast');
	// 			$("#response").effect( "shake" );
	// 			// $('#loginform')[0].reset();
	// 		}
	// 		else
	// 		{
	// 			window.location.href='';
	// 			throw new Error('go');
	// 		}
	// 	});
	// });

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

</body>
</html>
