<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
               
                    <div>
                     
             <?=$this->session->flashdata('pesan')?> 
                     

                    <?=$this->session->flashdata('pesan')?>  <?php 
                   $user_id=$this->db->get_where('kursus',array('kursus_id'=>$materi->kursus_id))->row()->created_by;
                    if($user_id==$this->session->userdata('user_id'))
                    { ?>
                        
                     
                        <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="<?=site_url('kursus/adddocumentmateri/'.$materi->section_id);?>" ><i class="glyphicon glyphicon-plus-sign"></i>Tambah document </a>                         
                  <?php
                    }
                   ?>
<table id="example" class="table table-bordered data-table">
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
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
 <script type="text/javascript">
  function delete_confirmation_document (){
    return confirm ('yakin mengahpus document ini ?');
  }
</script>