 
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>penambahan modul untuk <?=$kursus_title?>&nbsp; <h1></h1></h5>
          
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="span12">
            
             
             <?=$this->session->flashdata('pesan')?> 

             <?=form_open_multipart(site_url('kursus/upload_kursus_document_materi'), 'id="upload-form" role="form" class="form=horizontal"');?>
     <input type="hidden" name="kursus_id" value="<?=$kursus_id;?>">
       <input type="hidden" name="kursus_title" value="<?=$kursus_title;?>">
       <input type="hidden" name="section" value="<?=$section_id;?>">
           
      

          <div class="control-group">
            <label class="control-label col-md-3" >dokumen title</label>
            <div class="controls">
            <?php 
                    $data=array(
                        'name'        => 'document_title',
                        'placeholder' => 'document Title',
                        'id'          => 'document_title',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control',
                     
                      );
                   ?>
                  <?=form_textarea($data)?>
            </div>
          </div>
           <div class="control-group">
            <label class="control-label col-md-3" >Associated Coourse</label>
            <div class="controls">
         <?php 
                  $data=array(
                      'name'  =>'free',
                      'id'    =>'free',
                      'value' =>'free',
                      'style' =>'margin:10px',
                    );
                 ?>
                 <?=form_checkbox($data)?>
            </div>
          </div>
          
             <div class="control-group">
            <label class="control-label col-md-3" >Pilih document</label>
            <div class="controls">
           <?=form_upload('media','','id="media" class="form-control"')?>
            </div>
          </div>
          <div id="progressBar" style="display: none;"><br> <img src="<?=base_url('assets/images/loading.gif')?>"></div>
          
<div class="control-group">
           
            <div class="controls">
           	 <button type="submit" id="btnSave"  class="btn btn-success"><span class="glyphicon glyphicon-saved"></span>Save</button>
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
