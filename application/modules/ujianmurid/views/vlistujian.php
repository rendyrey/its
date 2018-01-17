<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

             <?=$this->session->flashdata('pesan')?>



                      <?php if(isset($ujian) AND !empty($ujian)){$i=1;
                  foreach($ujian as $uji){
                    if(($uji->ujian_active ==1) && ($uji->public==1)){
                      $hr=(int)substr($uji->durasi_waktu,0,2);//returns hours
                      $minutes=substr($uji->durasi_waktu, -5,5);//return minutes
                 ?>
                 <div class="profile-activity clearfix">
                    <a href="<?=site_url('ujianmurid/view_ujian_summery/'.$uji->title_id)?>">

                        <div class="user"> <img width="60" class="pull-left" height="60" alt="User" src="<?=base_url('assets/upload/ujian/'.$uji->feature_image_name)?>"> </div>
                        <div class="time"> <span class="ace-icon fa fa-clock-o bigger-110">  <b><?=($hr)?$uji->durasi_waktu.'&nbsp;hours':$minutes.'minutes'?></b></span>
                          <p><?=$uji->judul_ujian?> </p>
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
