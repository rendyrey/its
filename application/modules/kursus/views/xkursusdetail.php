
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Data Isi Materi dari Modul :&nbsp;<i><?=$kursus->kursus_title?></i></h5>
         <h1><?=$this->session->flashdata('pesan')?></h1>
         <?php 
                    if($kursus->id ==$this->session->userdata['user_id'])
                    { ?>
                        <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="<?=site_url('kursus/addsections/'.$kursus->kursus_id);?>" ><i class="glyphicon glyphicon-plus-sign"></i>Tambah Sub </a>
                        
                        
                        <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="<?=site_url('kursus/adddocument/'.$kursus->kursus_id);?>" ><i class="glyphicon glyphicon-plus-sign"></i>Tambah document </a>                         
                  <?php
                    }
                   ?>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="span12">
            
             
             <?=$this->session->flashdata('pesan')?> 
             <?php foreach($sections as $section){ ?>
              <div class="span4">
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
         <?=$this->db->where('kursus_id',$kursus->kursus_id)->where('section_id',$section->section_id)->from('kursus_document')->count_all_results();?> document 
         </p>
        <p>
        <a href="<?=site_url('kursus/section_detail/'.$section->section_id)?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-resize-small"></i><span class="invisible-on-sm">Lihat Dokumen</span></a>
        
        <a onclick="return delete_confirmation()" href="<?=site_url('kursus/hapusisi_modul/'.$section->section_id)?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">Delete</span></a>
        </p>
              </div>
               </div>
             </div>
             <?php }?>
             
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
<script type="text/javascript">
  $('#button').click(function(event){
    var order=$("#sortlist").sortable("serialize");
    $('#message').html('saving changes');
    $.post("<?=site_url();?>Kursus/save_order",order,function(theResponse){
      $('#message').html(theResponse);
    });
  });

  $('#update').click(function(){
    var id =$(this).attr('data-update');
    var str =$.trim($('#section_title-'+id).html());
    var value=str.split(": ");
    $('#update_section_title').val(value[1]);
    $('#update_section_id').val(id);
  });
</script>
<script type="text/javascript">
  function delete_confirmation (){
    return confirm ('yakin mengahpus modul + document ini ?');
  }
</script>