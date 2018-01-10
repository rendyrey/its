<!DOCTYPE html>
<html lang="en">
<head>
<title>E-LEarning</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />



<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/fullcalendar.css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/sms-style.css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/sms-media.css" class="skin-coor" />



<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js' type='text/javascript'></script>

</head>
<body>

<!--Header-part-->
<div id="header" >
  <h1><a href="<?=site_url()?>">SMS - Manager</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse ">
  <ul class="nav">
    <li class=" dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-user"></i> <span class="text">Profil</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a class="sAdd" title="" href="#">Profil</a></li>
     
   
      </ul>
    </li>
    

    <li class=""><a title="" href="<?=site_url()?>login/logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>

<!--close-top-Header-menu-->

<div id="sidebar" ><a href="#" class="visible-phone"><i class="icon icon-home"></i> Home</a><ul>
    <li class="active"><a href="<?=site_url()?>"><i class="icon icon-home"></i> <span>Home</span></a> </li>
    <li class="active"><a href="<?=site_url()?>pengguna"><i class="icon icon-home"></i> <span>Pengguna</span></a> </li>
    <li class="active"> <a href="<?=site_url()?>categori"><i class="icon icon-user"></i> <span>Pelajaran</span> 
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>materi</span>  <span class="label label-important">3</span></a>
      <ul>
        
        <li><a href="<?=site_url()?>kursus">Materi</a></li>
        <li><a href="<?=site_url()?>saran">Materi Yang Disarankan</a></li>
       
      </ul>
    </li>


    <li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>Latihan Soal</span>  <span class="label label-important">3</span></a>
      <ul>
        
        <li><a href="<?=site_url()?>latihan">Daftar Latihan Soal</a></li>
        <li><a href="<?=site_url()?>latihan/tambah">Tambah Latihan</a></li>
        <li><a href="<?=site_url()?>latihan/hasillatihan">Hasil Latihan</a></li>
      </ul>
    </li>

  <li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>Ujian</span>  <span class="label label-important">3</span></a>
      <ul>
        
        <li><a href="<?=site_url()?>ujian">Daftar Ujian</a></li>
        <li><a href="<?=site_url()?>ujian/tambah">Tambah Ujian</a></li>
        <li><a href="#">Hasil Latihan</a></li>
      </ul>
    </li>
   
<li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>Hasil</span>  <span class="label label-important">2</span></a>
      <ul>
        
        <li><a href="<?=site_url()?>latihan/hasillatihan">Hasil Latihan</a></li>
        <li><a href="<?=site_url()?>ujian/hasil">hasil Ujian</a></li>
      </ul>
    </li>
   
  
    
        
  </ul>
</div>