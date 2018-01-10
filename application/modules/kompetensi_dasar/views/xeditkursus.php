
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Data Ujian</h5>
          
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="span12">
            
             
             <?=$this->session->flashdata('pesan')?> 

            <?=form_open_multipart(site_url('kursus/update_kursus/'.$kursus->kursus_id), 'role="form" class="form=horizontal"');?>
              <?php 
              $kategori=$this->db->get('categori')->result();
              $option = array();
              foreach($kategori as $cat){
                if($cat->active){
                  $option[$cat->categori_id]=$cat->nama_categori;
                }
              }
             
         ?>
          <div class="control-group">
            <label class="control-label col-md-3" >Pilih Pelajaran </label>
            <div class="controls">
             <?php echo form_dropdown('category', $option, $kursus->categori_id,'id="parent-category" ')?>
            </div>
          </div>
          
            <div class="control-group">
            <label class="control-label col-md-3" >Judul Modul </label>
            <div class="controls">
             <?php 
                $data=array(
                    'name'        =>'kursus_title',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_title',
                    'value'       =>$kursus->kursus_title,
                    'rows'        =>'2',
                   
                   
                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>
           <div class="control-group">
            <label class="control-label col-md-3" >Intro Modul </label>
            <div class="controls">
              <?php 
                $data=array(
                    'name'        =>'kursus_intro',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_intro',
                    'value'       =>$kursus->kursus_intro,
                    'rows'        =>'2',
                    
                   
                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>
            <div class="control-group">
            <label class="control-label col-md-3" >Deskripsi Modul </label>
            <div class="controls">
              <?php 
                $data=array(
                    'name'        =>'kursus_description',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_description',
                    'value'       =>$kursus->kursus_description,
                    'rows'        =>'2',
                   
                   
                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>
           <div class="control-group">
            <label class="control-label col-md-3" >Requirement Modul </label>
            <div class="controls">
              <?php 
                $data=array(
                    'name'        =>'kursus_requirement',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_requirement',
                    'value'       =>$kursus->kursus_requirement,
                    'rows'        =>'2',
                  
                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>
           <div class="control-group">
            <label class="control-label col-md-3" >target Modul </label>
            <div class="controls">
             <?php 
                $data=array(
                    'name'        =>'target_audience',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'target_audience',
                    'value'       =>$kursus->target_audience,
                    'rows'        =>'2',
                   
                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>
<div class="control-group">
            <label class="control-label col-md-3" >Yang Didapat Dari Modul </label>
            <div class="controls">
            <?php 
                $data=array(
                    'name'        =>'what_i_get',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'what_i_get',
                    'value'       =>$kursus->what_i_get,
                    'rows'        =>'2',
             
                    
                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label col-md-3" >Image </label>
            <div class="controls">
           <?=form_upload('feature_image','','id="feature_image" ')?>
            </div>
          </div>
          
          <div class="modal-footer">
           <button type="submit" id="btnSave"  class="btn btn-success"><span class="glyphicon glyphicon-saved"></span>Save</button>
           
          </div>
            <?=form_close();?>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
<script>
$('select#parent-category').change(function() {

    var category = $(this).val();
    var link = '<?php echo base_url()?>'+'kursus/getsubcategoriajax/'+category;
    $.ajax({
        data: category,
        url: link
    }).done(function(subcategories) {

        console.log(subcategories);
        $('#category').html(subcategories);
    });
});

</script>