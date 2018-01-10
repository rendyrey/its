<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Learning ITS</title>

    <meta name="description" content="Static &amp; Dynamic Tables" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/fullcalendar.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/chosen.min.css" />


    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?=base_url()?>assets/fonts/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js' type='text/javascript'></script>
    <script src="<?=base_url()?>assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
<style type="text/css">
table#pilihan td, table#pilihan th {
  border: 1px solid #ddd;
  padding: 5px;
}
table#pilihan th {
  text-align: center;
}
tr.even {
  background-color: #eee;
}
</style>
  <body class="no-skin">
    <div id="navbar" class="navbar navbar-default">
      <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
      </script>

      <div class="navbar-container" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
          <span class="sr-only">Toggle sidebar</span>

          <span class="icon-bar"></span>

          <span class="icon-bar"></span>

          <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
          <a href="<?=site_url()?>" class="navbar-brand">
            <small>
              <i class="fa fa-leaf"></i>
              E-Learning ITS
            </small>
          </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
          <ul class="nav ace-nav">
            


         

            <li class="light-blue">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                
                <span class="user-info">
                  <small>Keluar</small>
                </span>

                <i class="ace-icon fa fa-caret-down"></i>
              </a>

              <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                

                

                <li>
                  <a href="<?=site_url()?>login/logout">
                    <i class="ace-icon fa fa-power-off"></i>
                    Logout
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- /.navbar-container -->
    </div>

    <div class="main-container" id="main-container">
      <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
      </script>

      <div id="sidebar" class="sidebar                  responsive">
        <script type="text/javascript">
          try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
              <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
              <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
              <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
              <i class="ace-icon fa fa-cogs"></i>
            </button>
          </div>

          <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
          </div>
        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
          <li class="">
            <a href="<?=site_url()?>">
              <i class="menu-icon fa fa-tachometer"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?=site_url()?>kursus">
              <i class="menu-icon fa fa-desktop"></i>
              <span class="menu-text">
               Modul Materi
              </span>
            </a>
            </li>

            <li class="">
            <a href="<?=site_url()?>mapel">
              <i class="menu-icon fa fa-book"></i>
              <span class="menu-text">
               Mata Pelajaran
              </span>
            </a>
            </li>

            <li>
            <a href="<?=site_url()?>kompetensi_dasar">
              <i class="menu-icon fa fa-bookmark"></i>
              <span class="menu-text">
               Kompetensi Dasar
              </span>
            </a>
            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?=site_url()?>indikator">
              <i class="menu-icon fa fa-list-ul"></i>
              <span class="menu-text">
               Indikator
              </span>
            </a>
            </li>

            <li class="">
            <a href="<?=site_url()?>bank_soal">
              <i class="menu-icon fa fa-archive"></i>
              <span class="menu-text">
               Bank Soal
              </span>
            </a>
            </li>

            <li class="">
            <a href="<?=site_url()?>latihan">
              <i class="menu-icon fa fa-pencil"></i>
              <span class="menu-text">
               Latihan
              </span>
            </a>
            </li>

            <li class="">
            <a href="<?=site_url()?>ujian">
              <i class="menu-icon fa fa-pencil-square-o"></i>
              <span class="menu-text">
               Ujian
              </span>
            </a>
            </li>

          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-list"></i>
              <span class="menu-text"> Hasil </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              <li class="active">
                <a href="<?=site_url()?>latihan/hasillatihan">
                  <i class="menu-icon fa fa-caret-right"></i>
                 Hasil Latihan
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="<?=site_url()?>ujian/hasil">
                  <i class="menu-icon fa fa-caret-right"></i>
            Hasil Ujian
                </a>

                <b class="arrow"></b>
              </li>
            </ul>
          </li>

       

          

       



        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>

        <script type="text/javascript">
          try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
      </div>
