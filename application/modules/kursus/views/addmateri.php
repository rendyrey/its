<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

                    <div>

          <?=form_open_multipart(site_url('kursus/simpanmateri'), 'id="upload-form" role="form" class="form=horizontal"');?>

       <div class="form-group">
            <label class="control-label col-md-3" >Judul Materi</label>
            <div class="controls">
           <input type="text" name="kursus_title" id="kursus_title" class="form-control">
            </div>
          </div>



          <div class="form-group">
            <label class="control-label col-md-3" >Deskripsi Materi</label>
            <div class="controls">
            <?php
                    $data=array(
                        'name'        => 'kursus_intro',
                        'placeholder' => '',
                        'id'          => 'kursus_intro',
                        'value'       => '',
                        'rows'        => '1',
                        'class'       => 'form-control',

                      );
                   ?>
                  <?=form_textarea($data)?>
            </div>
          </div>


             <div class="form-group">
            <label class="control-label col-md-3" >Pilih document</label>
            <div class="controls">
           <?=form_upload('document','document','id="document" class="form-control" required')?>
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
