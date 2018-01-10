<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                
                    <div>
                     
          <?=form_open_multipart(site_url('mapel/simpanmapel'), 'id="upload-form" role="form" class="form=horizontal"');?>
     
          <div class="form-group">
            <label class="control-label" >Pilih Categori </label>
            <div class="controls">
             <select name="category" data-placeholder="Pilih Kategori..." class="chosen-select" required>
              <option value=""></option> 
              <?php  foreach ($categories as $category) { ?>
               <option value="<?=$category->categori_id?>"><?=$category->nama_categori?></option> 
               <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" >Nama Mata Pelajaran</label>
            <div class="controls">
           <input type="text" name="mapel_title" id="mapel_title" class="form-control" required>
            </div>
          </div>
       
          <div class="form-group">
           
            <div class="controls">
             <button type="submit" id="btnSave"  class="btn btn-success"><span class="glyphicon glyphicon-saved"></span>Save</button>
            </div>
          </div>

       <?=form_close()?>
                  
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
