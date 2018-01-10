<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                <?php 
                    if($kursus->id ==$this->session->userdata['user_id'])
                    { ?>
                        <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="<?=site_url('saran/addsections/'.$kursus->kursus_id);?>" ><i class="glyphicon glyphicon-plus-sign"></i>Tambah Sub </a>
                        
                        
                        <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="<?=site_url('saran/adddocument/'.$kursus->kursus_id);?>" ><i class="glyphicon glyphicon-plus-sign"></i>Tambah document </a>                         
                  <?php
                    }
                   ?>
                    <div>
                    
                   <h1><h1><?=$this->session->flashdata('pesan')?></h1></h1>
                   
                    <?=$this->session->flashdata('pesan')?> 
             <?php foreach($sections as $section){ ?>
              <div class="col-xs-4">
               <div class="widget-box">
                 <div class="widget-title">
                <span class="icon">
                  <i class="icon-eye-open"></i>
                </span>
                <h5><?=$section->section_title?></h5>
              </div>
              <div class="widget-content nopadding">
              <p><?=$section->section_name?></p>
              <p>
         <?=$this->db->where('kursus_id',$kursus->kursus_id)->where('section_id',$section->section_id)->from('saran_document')->count_all_results();?> document 
         </p>
        <p>
        <a href="<?=site_url('saran/section_detail/'.$section->section_id)?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-resize-small"></i><span class="invisible-on-sm">Lihat Dokumen</span></a>
        
        <a onclick="return delete_confirmation()" href="<?=site_url('saran/hapusisi_modul/'.$section->section_id)?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">Delete</span></a>
        </p>
              </div>
               </div>
             </div>
             <?php }?>
             


                   
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div><!-- /.main-content 