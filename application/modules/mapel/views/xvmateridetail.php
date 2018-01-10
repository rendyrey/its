
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Data Sub Materi : </h5>
          <p>disini kita bisa melihat document / video yang telah diupload sebagai modul dari mata pelajaran</p>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="span12">
            
             <p class="text-muted"> <?=$materi->section_name?>
             <?=$this->session->flashdata('pesan')?>  <?php 
                   $user_id=$this->db->get_where('kursus',array('kursus_id'=>$materi->kursus_id))->row()->created_by;
                    if($user_id==$this->session->userdata('user_id'))
                    { ?>
                        
                     
                        <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="<?=site_url('kursus/adddocumentmateri/'.$materi->section_id);?>" ><i class="glyphicon glyphicon-plus-sign"></i>Tambah document </a>                         
                  <?php
                    }
                   ?>

              <table class="table table-bordered data-table">
              <thead>
                    <tr>
                      <th></th>
                      <th>Judul Document</th>
                      <th>aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sl=1;
                      foreach ($doc as $document){?>
                     <tr>
                       <td><?=$sl?>:</td>
                       <td><span id="document_title-<?=$document->document_id?>"><?=$document->document_title?></span></td>
                       
                       <td>
                       <a href="<?=base_url();?>assets/upload/kursus/document/<?=$document->kursus_id.'/'.$document->document_link?>">Dwonload</a>
                                  
                                  <a onclick="return delete_confirmation_document()" href="<?=site_url('kursus/delete_document/'.$document->document_id)?>"><i class="glyphicon glyphicon-trash"></i>Delete</a></td>
                     </tr>
                      <?php 
                      $sl++;
                      } ?>
                  </tbody>
            </table>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
 <script type="text/javascript">
  function delete_confirmation_document (){
    return confirm ('yakin mengahpus document ini ?');
  }
</script>