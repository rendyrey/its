
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Daftar Ujian</h5>
         
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="span12">
            <form id="recoverform" action="<?=site_url()?>profil/saveedit" class="form-vertical" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$this->session->userdata('user_id')?>" id="id">
            <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label col-md-3" > Username</label>
                            <input type="text" placeholder="Username" name="username" value="<?=$getid->username?>" />
                        </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label col-md-3" > Password</label><input type="password" placeholder="Password" name="password" value="<?=$getid->password?>" required />
                        </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                           <label class="control-label col-md-3" > Email</label><input type="text" placeholder="Email" name="email" value="<?=$getid->email?>"/>
                        </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label col-md-3" > Nama</label><input type="text" placeholder="Nama" name="nama" value="<?=$getid->nama?>" />
                        </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                           <label class="control-label col-md-3" > Foto</label><input type="file" name="gambar" id="gambar" />
                        </div>
                    </div>
                    </div>
               
                <div class="form-actions">
                    
                    <span class="pull-right"><input type="submit" class="btn btn-info" value="Simpan" /></span>
                </div>
            </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
