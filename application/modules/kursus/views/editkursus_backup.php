<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

                    <div>


 <?=$this->session->flashdata('pesan')?>
  <?=form_open_multipart(site_url('kursus/update_materi'), 'role="form" class="form=horizontal"');?>
            <input type="hidden" name="kursus_id" id="kursus_id" value="<?=$kursus->kursus_id?>">
              <?php
              $kategori=$this->db->get('categori')->result();
              $option = array();
              foreach($kategori as $cat){
                if($cat->active){
                  $option[$cat->categori_id]=$cat->nama_categori;
                }
              }

         ?>
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" >Pilih Pelajaran </label>
            <div class="col-sm-9">
             <?php echo form_dropdown('category', $option, $kursus->categori_id,'id="parent-category" ')?>
            </div>
          </div>

            <div class="form-group">
            <label class="control-label col-md-3" >Judul Materi </label>
            <div class="col-sm-9">
             <?php
                $data=array(
                    'name'        =>'kursus_title',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_title',
                    'value'       =>$kursus->kursus_title,
                    'rows'        =>'1',
                    'class'       => 'form-control',


                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" >Deskripsi Materi</label>
            <div class="col-sm-9">
              <?php
                $data=array(
                    'name'        =>'kursus_intro',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_intro',
                    'value'       =>$kursus->kursus_intro,
                    'rows'        =>'1',
                    'class'       => 'form-control',

                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>




          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" >Document </label>
            <div class="col-sm-9">
           <?=form_upload('document','','id="document" ')?>
            </div>
          </div>

          <div class="modal-footer">
           <button type="submit" id="btnSave"  class="btn btn-success"><span class="glyphicon glyphicon-saved"></span>Save</button>

          </div>
            <?=form_close();?>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
