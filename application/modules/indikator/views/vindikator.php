<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                <div class="row">
                  <div class="col-xs-12">
                    <div>
                      <a href="<?=site_url('indikator/addindikator')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah Indikator</a>
                      <br>&nbsp;
                      <?php if($this->session->flashdata('pesan')){ ?>
                      <div class="alert alert-success">
             <?=$this->session->flashdata('pesan')?>
                      </div> <?php } ?>
                <form action="" method="get" accept-charset="utf-8" class="form-horizontal validatable" target="_top">

                  <div class="padded">
                    <div class="control-group">
                      <label class="control-label col-md-2">Mata Pelajaran</label>
                      <div class="controls" id="subcategorydiv">
                        <select name="mapel" class="chosen-select" style="width:300px;" required>
                          <?php
                          $i=0;
                          // echo "<option>hi</option>";
                          foreach($mapel as $row){
                            echo "<option value='$mapel_id[$i]'>$mapel[$i]</option>";
                            $i++;
                          }
                           ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-actions">
                    <input type="hidden" name="operation" value="selection" />
                    <input type="submit" value="Tampilkan" class="btn btn-normal btn-gray" />
                  </div>
                </form>
                     <table id="dynamic-table" class="table table-bordered data-table">
            <thead>
                        <tr>

                            <th>Mata Pelajaran</th>
                            <th>Kompetensi Dasar</th>
                            <th>Indikator</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>

                    <tbody>
                     <?php $i=1;
                     foreach ($indikator as $indi) {
                     ?>

                        <tr class="<?=($i&1)?'even':'odd';?>">
                            <td><?=$indi->nama_mapel?></td>
                            <td><?=$indi->nama_kompetensi?></td>
                            <td><?=$indi->nama_indikator;?></td>
                            <td><?php echo ($indi->active==='1')?"<span class='btn btn-xs btn-success'>Aktif</span>":"<span class='btn btn-xs btn-danger'>Tidak Aktif</span>"; ?></td>

                            <td>
<a class="btn btn-warning" href = " <?= site_url('indikator/edit_indikator/' . $indi->id_indikator)?>"><span class="glyphicon glyphicon-edit" title="Edit">Edit</span></a>
<a onclick="return delete_confirmation()" class="btn btn-warning" href = " <?= site_url('indikator/hapus_indikator/' . $indi->id_indikator)?>"><span class="glyphicon glyphicon-edit" title="Edit">Delete</span></a>

                                    </td>
                        </tr>
                       <?php
                       $i++;
                     }
                       ?>
                    </tbody>
            </table>

                    </div>
                  </div>

                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
<script language="javascript" type="text/javascript">

function getXMLHTTP() {
    var xmlhttp=false;
    try{
      xmlhttp=new XMLHttpRequest();
    }
    catch(e)  {
      try{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e){
        try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e1){
          xmlhttp=false;
        }
      }
    }

    return xmlhttp;
    }

  function getState(category_id) {

    var strURL="<?=base_url()?>kompetensi_dasar/getsubcategoriajax/"+category_id;
    var req = getXMLHTTP();

    if (req) {

      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {
            document.getElementById('subcategorydiv').innerHTML=req.responseText;
          } else {
            alert("There was a problem while using XMLHTTP:\n" + req.statusText);
          }
        }
      }

      req.open("GET", strURL, true);
      req.send(null);
    }
  }


</script>
<script type="text/javascript">
      var save_method; //for save method string
      var table;
      function add_kursus()
        {
          save_method = 'add';
          $('#form')[0].reset(); // reset form on modals
          $('#modal_form').modal('show'); // show bootstrap modal
          $('.modal-title').text('Tambah Kursus '); // Set Title to Bootstrap modal title
        }
        function save ()
        {
          var form =$("#form");
          var url;
          if (!form.valid()) {
            document.getElementById('form').focus();
          }
          else{
            if(save_method=='add'){
              url="<?=site_url('kursus/save')?>";
            }else{
              url="<?=site_url('kursus/updateaction')?>";
            }
            $.ajax({
              url:url,
              type:"POST",
              data:$('#form').serialize(),
              dataType:"JSON",
              success:function(data)
              {
                $('#modal_form').modal('hide');
                location.reload();
              },
              error:function()
              {
                alert('terdapat kesalahan');
              }
            });
          }
        }

     </script>
</div>
  <div class="modal fade bs-example-modal-lg " id="modal_form" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" role="document">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title w-100" id="exampleModalLabel">Categori</h3>

      </div>
      <div class="modal-body form">
         <?php echo form_open_multipart(site_url('kursus/save'),'role="form" id="form" class="form-horizontal"');?>
        <input type="hidden" value="" name="kursus_id" id="kursus_id" />
        <?php
          $option=array();
          $option['']='Pilih Category';
          foreach ($categories as $categoriii)
          {
            if ($categoriii->active){
              $option[$categoriii->categori_id]=$categoriii->nama_categori;
            }
          }
          ?>
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pilih Categori</label>
            <div class="col-sm-9">
             <?php echo form_dropdown('category', $option, '','id="category" ')?>
            </div>
          </div>



           <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" >Judul Modul </label>
            <div class="col-sm-9">
             <?php
                $data=array(
                    'name'        =>'kursus_title',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_title',
                    'value'       =>'',
                    'rows'        =>'2',


                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" >Intro Modul </label>
            <div class="col-sm-9">
              <?php
                $data=array(
                    'name'        =>'kursus_intro',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_intro',
                    'value'       =>'',
                    'rows'        =>'2',


                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>

              <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" >Deskripsi Modul </label>
            <div class="col-sm-9">
              <?php
                $data=array(
                    'name'        =>'kursus_description',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_description',
                    'value'       =>'',
                    'rows'        =>'2',


                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>


              <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" >Requirement Modul </label>
            <div class="col-sm-9">
              <?php
                $data=array(
                    'name'        =>'kursus_requirement',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'kursus_requirement',
                    'value'       =>'',
                    'rows'        =>'2',

                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">target Modul </label>
            <div class="col-sm-9">
             <?php
                $data=array(
                    'name'        =>'target_audience',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'target_audience',
                    'value'       =>'',
                    'rows'        =>'2',

                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Yang Didapat Dari Modul </label>
            <div class="col-sm-9">
            <?php
                $data=array(
                    'name'        =>'what_i_get',
                    'placeholder' =>'Kursus Title',
                    'id'        =>'what_i_get',
                    'value'       =>'',
                    'rows'        =>'2',


                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>
            <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" >Image </label>
            <div class="col-sm-9">
           <?=form_upload('feature_image','','id="feature_image" ')?>
            </div>
          </div>


          <div class="modal-footer">
           <button type="submit" id="btnSave"  class="btn btn-success"><span class="glyphicon glyphicon-saved"></span>Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>Cancel</button>
          </div>


       <?= form_close();?>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
    <!-- sms -->

<script>
$('select#parent-category').change(function() {

    var category = $(this).val();
    var link = '<?php echo site_url()?>'+'kursus/getsubcategoriajax/'+category;
    $.ajax({
        data: category,
        url: link
    }).done(function(subcategories) {

        console.log(subcategories);
        $('#category').html(subcategories);
    });
});
 function delete_confirmation (){
    return confirm ('yakin mengahpus Materi Modul ini ?');
  }
</script>
