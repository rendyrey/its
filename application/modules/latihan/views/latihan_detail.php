<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
          <div class="page-header">
              <?php 
                    if($latihan_title->user_id ==$this->session->userdata['user_id'])
                    { ?>
                        <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="<?=site_url('latihan/add_more_pertanyaanlatihan').'/'.$latihan_title->title_id;?>"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Pertanyaan </a>                        
                  <?php
                    }
                   ?>
            </div><!-- /.page-header -->

            <div class="row">
              <div class="col-xs-12">
          <h5>Judul Latihan: <?=(!empty($latihan_title)) ? $latihan_title->judul_latihan:'';?></h5>
         

             
             <?=$this->session->flashdata('pesan')?> 

<?php if(isset($latihans) != NULL) { ?>
              <table id="dynamic-table" class="table table-bordered data-table">
                 <thead>
                             <tr>
                               <th>S1</th>
                               <th>Pertanyaan</th>
                               <th class="sol-sm-3">Aksi</th>
                             </tr>
                           </thead>
                  <tbody>
                  <?php 
                              $i=1;
                              foreach($latihans as $latihan){
                             ?>
                             <tr class="accordion-group<?= ($i & 1) ?'even':'odd' ;?>">
                                <td class="col-sm-1"><?=$i;?></td>
                                <td class="accordion-heading">
                                  <a id="pertanyaan_title-<?=$latihan->per_id;?>" href="#collapse_<?=$i;?>" data-toggle="collapse_" class="accordion-toggle" style="text-decoration: none; padding: 0; color: #363636">
                                    <?=$latihan->pertanyaanlatihan;?>
                                  </a>
                                  <div class="accordion-body collapse" id="collapse_<?=$i;?>">
                                    <div class="accordion-inner"><br/>
                                      <p>
                                        
                                        
                                      </p>
                                      <?php 
                                        if($latihan_jawabanlatihan[$latihan->per_id][0]){ ?>
                                        <table id="dynamic-table" class="table table-bordered data-table">
                                          <thead>
                                            <tr>
                                              <th>s1</th>
                                              <th>Pilihan</th>
                                              <th>Jawaban Benar</th>
                                              <th style="width: 15%">Aksi</th>
                                            </tr>
                                          </thead>
                                          <?php 
                                            foreach ($latihan_jawabanlatihan[$latihan->per_id] as $all_jaw):
                                              $sl=1;
                                              foreach ($all_jaw as $jaw) :?>
                                              <tr>
                                                <td style="width: 5%"><?=$sl;?></td>
                                                <td>
                                                  <a href="#" data-name="jaw-text" datatype="textarea" data-rows="2" data-url="<?=site_url('latihan/update_jawabanlatihan/'.$latihan->per_id);?>" data-pk="<?=$jaw->jaw_id;?>" class="data-modify-<?=$jaw->jaw_id;?> no-style"><?=form_prep($jaw->jawabanlatihan);?></a>
                                                </td>
                                                <td>
                                                  <a href="#" data-name="right-jaw" data-type="select" data-source="[{value:0,text:' Salah '},{value:1,text:' Benar '}]" data-value="<?=$jaw->right_jaw; ?>" data-url="<?php echo site_url('latihan/update_jawabanlatihan/'.$latihan->per_id); ?>" data-pk="<?=$jaw->jaw_id; ?>" class="data-modify-<?=$jaw->jaw_id; ?> no-style"><?=($jaw->right_jaw != 0) ? 'Benar' : 'Salah'; ?></a>
                                                </td>
                                          <td class="btn-group">
                                              <a class="btn btn-white btn-warning btn-bold modify" name="modify-<?=$jaw->jaw_id;?>">Edit <i class="glyphicon glyphicon-pencil"></i></a>

                                                  <a class="btn btn-white btn-warning btn-bold" onclick="return delete_confirmation();" href="<?=site_url('latihan/delete_jawabanlatihan/'.$jaw->jaw_id);?>">Hapus<i class="ace-icon fa fa-trash-o bigger-120 orange"></i></a>
                                                </td>
                                              </tr>
                                              <?php 
                                              $sl++;
                                           endforeach;
                                           endforeach;
                                          ?>
                                        </table>
                                        <?php }else {echo "string";}?>
                                    </div>
                                  </div>
                                </td>
                                <td class="col-xs-3">
                                  <div class="btn-group">
                                    <a href="#collapse_<?=$i;?>" data-toggle="collapse" class="btn btn-sm btn-default accordion-toggle" ><i class="glyphicon glyphicon-resize-small"></i><span class="invisible-on-sm">view</span></a>
                                    
                                    <a class="btn btn-sm btn-default update" data-update="<?=$latihan->per_id;?>" href="#update_per" data-toggle="modal"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">modify</span></a>

                                    <a onclick="return delete_confirmation();" href="<?=site_url('latihan/delete_pertanyaanlatihan/'.$latihan->per_id);?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">Delete</span></a>
                                  </div>
                                </td>
                             </tr>
                             <?php 
                              $i++;
                            }
                             ?>
                           </tbody>
              </table>

<?php 
                      } else {
                        echo "sdsada";
                      }
                      ?>

            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
<script type="text/javascript">
  function delete_confirmation (){
    return confirm ('yakin mengahpus soal ini ?');
  }
</script>
