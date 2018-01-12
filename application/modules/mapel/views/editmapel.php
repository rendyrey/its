<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

  <?=$this->session->flashdata('pesan')?>
  <?=form_open_multipart(site_url('mapel/update_mapel'), 'role="form" class="form=horizontal"');?>
            <input type="hidden" name="mapel_id" id="mapel_id" value="<?=$mapel->mapel_id?>">

        

          <div class="form-group">
            <label class="control-label col-md-3" >Nama Mata Pelajaran </label>
            <div class="col-sm-9">
               <input type="text" name="mapel_title" id="mapel_title" value="<?=$mapel->nama_mapel?>" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3" >Status </label>
            <div class="col-sm-9">
              <select name="status">
              <option value="" disabled>Pilih Status</option>
              <option value="0" <?php echo ($mapel->active==0)? "selected":"";?>>Tidak Aktif</option>
              <option value="1" <?php echo ($mapel->active==1)? "selected":"";?>>Aktif</option>
              </select>
            </div>
          </div>

          <div class="modal-footer">
           <button type="submit" id="btnSave"  class="btn btn-success"><span class="glyphicon glyphicon-saved"></span>Save</button>

          </div>
            <?=form_close();?>

              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
