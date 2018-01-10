<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
               
                    <div>
                     
             <?=$this->session->flashdata('pesan')?> 
    
           <?=form_open_multipart(site_url('ujian/update_ujian/'.$ujian->title_id), 'role="form" class="form-horizontal"');?>    
             
             <div class="form-group">
             <label class="control-label col-md-3" > Nama Ujian</label>
            <div class="col-sm-9">
            <?php 
                    $data=array(
                        'name'        => 'ujian_title',
                        'placeholder' => 'ujian Title',
                        'id'          => 'ujian_title',
                        'value'       => $ujian->judul_ujian,
                        'rows'        => '2',
                        'class'       => 'form-control',
                     
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
            <?=form_dropdown('parent-kelas',$option,$ujian->kelas_id,'id="parent-kelas" class="form-control"')?>
         </div>
         </div>-->

         <!--<div class="control-group">
         <label class="control-label col-md-3" >Pilih Sub Kelas</label>
         <div class="controls">
           <?=form_dropdown('kelas',$option2,$ujian->id,'id="kelas" class="form-control"')?>
         </div>
         </div>-->
  <?php 
            $categories=$this->db->get('categori')->result();
            $option=array();
            foreach($categories as $category){
              $option[$category->categori_id]=$category->nama_categori;
            }
           
          ?>
           <div class="form-group">
         <label class="control-label col-md-3" >Pilih Mata Pelajaran</label>
         <div class="col-sm-9">
           <?=form_dropdown('category',$option,$ujian->categori_id,'id="category" class="form-control"')?>
         </div>
         </div>

         
           <div class="form-group">
         <label class="control-label col-md-3" >Foto</label>
         <div class="col-sm-9">
            <?=form_upload('feature_image','','id="feature_image" class="form-control"')?>
         </div>
         </div>
          <div class="form-group">
         <label class="control-label col-md-3" >Nilai</label>
         <div class="col-sm-9">
        <?=form_input('passing_score',$ujian->nilai,'id="passing_score" placeholder="passing_score" class="form-control"')?>
         </div>
         </div>
           <div class="form-group">
         <label class="control-label col-md-3" >Publish Ujian </label>
         <div class="col-sm-9">
           <select name="public" class="form-control">
               <option value="1">Yes</option>
               <option value="0">No</option>
             </select>
         </div>
         </div>


          <div class="form-group">
         <label class="control-label col-md-3" >Durasi waktu</label>
         <div class="col-sm-9">
          <?=form_input('duration',$ujian->durasi_waktu,'id="timepicker1" placeholder="hh:mm:ss" class="form-control"')?>
         </div>
         </div>

           <div class="form-group">
         <label class="control-label col-md-3" >Acak Soal</label>
         <div class="col-sm-9">
           <?=form_input('random_per',$ujian->acak_soal,'id="random_per" placeholder="hanya nomor yang tidak lebih '.$per_count.'" class="form-control"')?>
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

