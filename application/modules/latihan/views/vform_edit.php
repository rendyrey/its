<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

                    <div>

             <?=$this->session->flashdata('pesan')?>

             <?=form_open_multipart(site_url('latihan/update_latihan/'.$latihan->title_id), 'role="form" class="form-horizontal"');?>

             <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="form-field-1" > Nama Latihan</label>
            <div class="col-sm-9">
            <?php
                    $data=array(
                        'name'        => 'latihan_title',
                        'placeholder' => 'latihan Title',
                        'id'          => 'latihan_title',
                        'value'       => $latihan->judul_latihan,
                        'rows'        => '2',
                        'class'       => 'col-xs-10 col-sm-5',

                      );
                   ?>
                   <?=form_textarea($data)?>
            </div>
          </div>
<?php
           // $kelas=$this->db->get('kelas')->result();
            //$option=array();
            //foreach($kelas as $kelass){
              //$option[$kelass->kelas_id]=$kelass->nama_kelas;
            //}
            //$sub_kelas=$this->db->get('subkelas')->result();
            //$option2=array();
            //foreach($sub_kelas as $sub_kelass){
              //$option2[$sub_kelass->id]=$sub_kelass->namasubkelas;
            //}
          ?>
         <!--<div class="control-group">
         <label class="control-label col-md-3" >Pilih Kelas</label>
         <div class="controls">
         </div>
         </div> -->

         <!--<div class="control-group">
         <label class="control-label col-md-3" >Pilih Sub Kelas</label>
         <div class="controls">
         </div>
         </div> -->
  <?php
            $option=array();
            foreach($mapel as $map){
              $option[$map->mapel_id]=$map->nama_mapel;
            }

          ?>
           <div class="form-group">
         <label class="col-sm-3 control-label no-padding-right" >Pilih Mata Pelajaran</label>
         <div class="col-sm-9">
           <?=form_dropdown('mapel_id',$option,$latihan->mapel_id,'id="category" class="col-xs-10 col-sm-5"')?>
         </div>
         </div>


           <div class="form-group">
         <label class="col-sm-3 control-label no-padding-right" >Foto</label>
         <div class="col-sm-9">
            <?=form_upload('feature_image','','id="feature_image" class="col-xs-10 col-sm-5"')?>
         </div>
         </div>
          <div class="form-group">
         <label class="col-sm-3 control-label no-padding-right" >Nilai</label>
         <div class="col-sm-9">
        <?=form_input('passing_score',$latihan->nilai,'id="passing_score" placeholder="passing_score" class="form-control"')?>
         </div>
         </div>
           <div class="form-group">
         <label class="control-label col-md-3" >Publish Latihan </label>
         <div class="col-sm-9">
           <select name="public" class="col-xs-10 col-sm-5">
               <option value="1">Yes</option>
               <option value="0">No</option>
             </select>
         </div>
         </div>


          <div class="form-group">
         <label class="col-sm-3 control-label no-padding-right" >Durasi waktu</label>
         <div class="col-sm-9">
          <?=form_input('duration',$latihan->durasi_waktu,'id="timepicker1" placeholder="hh:mm:ss" class="col-xs-10 col-sm-5"')?>
         </div>
         </div>

           <div class="form-group">
         <label class="col-sm-3 control-label no-padding-right" >Acak Soal</label>
         <div class="col-sm-9">
           <?=form_input('random_per',$latihan->acak_soal,'id="random_per" placeholder="hanya nomor yang tidak lebih '.$per_count.'" class="fcol-xs-10 col-sm-5"')?>
         </div>
         </div>


          <div class="clearfix form-actions">
                      <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-primary"><i class="ace-icon fa fa-floppy-o bigger-120 white"></i>
SImpan</button>
                      </div>
                    </div>
        <?=form_close()?>


                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
