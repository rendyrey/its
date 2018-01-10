<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                <div class="row">
                  <div class="col-xs-12">
                    <div>
                     
             <?=$this->session->flashdata('pesan')?> 
             
 <?=form_open_multipart(site_url('saran/upload_kursus_document_materi'), 'id="upload-form" role="form" class="form=horizontal"');?>
     <input type="hidden" name="kursus_id" value="<?=$kursus_id;?>">
       <input type="hidden" name="kursus_title" value="<?=$kursus_title;?>">
       <input type="hidden" name="section" value="<?=$section_id;?>">
           
      

          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"" >dokumen title</label>
            <div class="col-sm-9">
            <?php 
                    $data=array(
                        'name'        => 'document_title',
                        'placeholder' => 'document Title',
                        'id'          => 'document_title',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-group',
                     
                      );
                   ?>
                  <?=form_textarea($data)?>
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" >Associated Coourse</label>
            <div class="col-sm-9">
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
          
             <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" >Pilih document</label>
            <div class="col-sm-9">
           <?=form_upload('media','','id="media" class="form-control"')?>
            </div>
          </div>
          <div id="progressBar" style="display: none;"><br> <img src="<?=base_url('assets/images/loading.gif')?>"></div>
          
<div class="form-group">
           
            <div class="col-sm-9">
             <button type="submit" id="btnSave"  class="btn btn-success"><span class="glyphicon glyphicon-saved"></span>Save</button>
            </div>
          </div>

       <?=form_close()?>
                    </div>
                  </div>
                  
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>

