
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

          <?=form_open_multipart(site_url('ujian/create_ujian'), 'role="form" class="form=horizontal"');?>
                 
             
             <div class="control-group">
             <label class="control-label col-md-3" > Nama Ujian</label>
            <div class="controls">
            <?php 
                    $data=array(
                        'name'        => 'ujian_title',
                        'placeholder' => 'ujian Title',
                        'id'          => 'ujian_title',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control',
                     
                      );
                   ?>
                   <?=form_textarea($data)?>
            </div>
          </div>

           <?php 
           // $option=array();
            //$option['']='Pilih Kelas';
            //foreach ($kelass as $kelas){
              //if($kelas->active){
                //$option[$kelas->kelas_id]=$kelas->nama_kelas;
              //}
            //}
          ?>
       <!--  <div class="control-group">
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
         </div>-->

         <?php 
            $option=array();
            $option['']='Pilih Mata Pelajaran';
            foreach ($categories as $category){
              if($category->active){
                $option[$category->categori_id]=$category->nama_categori;
              }
            }
          ?>
           <div class="control-group">
         <label class="control-label col-md-3" >Pilih Category</label>
         <div class="controls">
           <?=form_dropdown('category',$option,'','id="category" class="form-control"')?>
         </div>
         </div>


           <div class="control-group">
         <label class="control-label col-md-3" >Foto</label>
         <div class="controls">
           <?=form_upload('feature_image','','id="feature_image" class="form-control"')?>
         </div>
         </div>
          <div class="control-group">
         <label class="control-label col-md-3" >Nilai</label>
         <div class="controls">
        <?=form_input('passing_score','','id="passing_score" placeholder="Nilai" class="form-control"')?>
         </div>
         </div>
           <div class="control-group">
         <label class="control-label col-md-3" >Publish Ujian </label>
         <div class="controls">
           <select name="public" class="form-control">
               <option value="1">Yes</option>
               <option value="0">No</option>
             </select>
         </div>
         </div>


          <div class="control-group">
                      <div class="controls">
                        <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Lanjut</button>
                      </div>
                    </div>
        <?=form_close()?>
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
$('select#parent-kelas').change(function() {

    var kelas = $(this).val();
    var link = '<?php echo base_url()?>'+'kelas/getsubkelasajax/'+kelas;
    $.ajax({
        data: kelas,
        url: link
    }).done(function(subkelas) {

        console.log(subkelas);
        $('#kelas').html(subkelas);
    });
});
</script>