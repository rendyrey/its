<?php 
$tmp=(array)json_decode($hasils->result_json)
?>
<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
             
             <?=$this->session->flashdata('pesan')?> 

           
 <div class="widget-content nopadding">
                  <?php foreach($tmp as $key =>$value){  
                    $pertanyaan=$this->db->where('per_id',$key)->get('pertanyaanlatihan')->row();
                        ?>
                   <div class="thumbnail">
                            <div class="caption">
                            <p><strong>pertanyaan : <?=$pertanyaan->pertanyaanlatihan?></strong></p>
                            <p><strong>Jawaban</strong></p>
                            <?php $jawaban=$this->db->where('per_id',$key)->get('jawabanlatihan')->result(); 
                            $temp_jaw=explode(',', $value);
                            foreach($jawaban as $val) {
                          ?>
                          <ol class="">
                              <input type="<?=$pertanyaan->option_type?>" disabled="disabled" <?=(in_array($val->jaw_id, $temp_jaw))?'checked':''?>/><span style="margin-left: 10px"><?=$val->jawabanlatihan?></span>
                              <?php 
                                if($val->right_jaw ==1){?>
                                <span class="badge"><i class="glyphicon glyphicon-ok"></i></span>
                                <?php } ?>
                            </ol>
                              <?php }?>
                            </div>
                  </div>
                  <?php } ?>          
                  </div>
                    
          </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
 