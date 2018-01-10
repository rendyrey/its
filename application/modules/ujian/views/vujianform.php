<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                
                    <div>
                     
             <?=$this->session->flashdata('pesan')?> 
    <?=form_open_multipart(site_url('ujian/create_ujian'), 'role="form" class="form-horizontal"');?>
                 
             
             <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" > Nama Ujian</label>
            <div class="col-sm-9">
            <?php 
                    $data=array(
                        'name'        => 'ujian_title',
                        'placeholder' => 'Ujian Title',
                        'id'          => 'ujian_title',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'col-xs-10 col-sm-5',
                     
                      );
                   ?>
                   <?=form_textarea($data)?>
            </div>
          </div>

           <?php 
           // $option=array();
            //$option['']='Pilih Kelas';
            //foreach ($kelass as $kelas){
              ///if($kelas->active){
                //$option[$kelas->kelas_id]=$kelas->nama_kelas;
              //}
            //}
          ?>
         <!--<div class="control-group">
         <label class="control-label col-md-3" >Pilih Kelas</label>
         <div class="controls">
            <?=form_dropdown('parent-kelas',$option,'','id="parent-kelas" class="form-control"')?>
         </div>
         </div>-->

         <!--<div class="control-group">
         <label class="control-label col-md-3" >Pilih Sub Kelas</label>
         <div class="controls">
           <select name="kelas" id="kelas" class="form-control">
               <option> sub kelas</option>
               </select>
         </div>
         </div> -->

         <?php 
            $option=array();
            $option['']='Pilih Mata Pelajaran';
            foreach ($categories as $category){
              if($category->active){
                $option[$category->categori_id]=$category->nama_categori;
              }
            }
          ?>
           <div class="form-group">
         <label class="col-sm-3 control-label no-padding-right" >Pilih Category</label>
         <div class="col-sm-9">
           <?=form_dropdown('category',$option,'','id="category" class="col-xs-10 col-sm-5"')?>
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
        <?=form_input('passing_score','','id="passing_score" placeholder="Nilai" class="col-xs-10 col-sm-5"')?>
         </div>
         </div>
           <div class="form-group">
         <label class="col-sm-3 control-label no-padding-right" >Publish Latihan </label>
         <div class="col-sm-9">
           <select name="public" class="col-xs-10 col-sm-5">
               <option value="1">Yes</option>
               <option value="0">No</option>
             </select>
         </div>
         </div>


          <div class="clearfix form-actions">
                      <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-primary"><i class="ace-icon fa fa-floppy-o bigger-120 white"></i>
Simpan</button>
                      </div>
                    </div>
        <?=form_close()?>

                  
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
