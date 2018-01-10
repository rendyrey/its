<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
             
             <?=$this->session->flashdata('pesan')?> 

           

                     <?php if(isset($latihan) AND !empty($latihan)){$i=1;
                  foreach($latihan as $lat){

                    if(($lat->latihan_active ==1) && ($lat->public==1)){
                      $hr=(int)substr($lat->durasi_waktu,0,2);//returns hours
                      $minutes=substr($lat->durasi_waktu, -5,5);//return minutes
                 ?>
                 <div class="profile-activity clearfix">
                    <a href="<?=site_url('murid/view_latihan_summery/'.$lat->title_id)?>">
                     
                        <div class="user"> <img width="60" class="pull-left" height="60" alt="User" src="<?=base_url('assets/upload/latihan/'.$lat->feature_image_name)?>"> </div>
                        <div class="time"> <span class="ace-icon fa fa-clock-o bigger-110">  <b><?=($hr)?$lat->durasi_waktu.'&nbsp;hours':$minutes.'minutes'?></b></span>
                          <p><?=$lat->judul_latihan?> </p>
                          </div>
                 
                     </a>
                      
                         
                      <?php $i++;
             } ?>
</div><?php
         }
     }
     else{
      echo "Belum ada Latihan";
     } ?>
                    
          </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
 