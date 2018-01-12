<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

                    <div>


 <?=$this->session->flashdata('pesan')?>
  <?=form_open_multipart(site_url('kompetensi_dasar/update_kompetensi'), 'role="form" class="form=horizontal"');?>

            <input type="hidden" name="kompetensi_id" id="kompetensi_id" value="<?=$kompetensi->kompetensi_id?>">



          <div class="form-group">
            <label class="control-label col-md-3" >Pilih Mata Pelajaran </label>
            <div class="col-sm-9" id="subcategorydiv">
              <select name="mapel" class="chosen-select" style="width:300px;" required>
                  <option value="<?=$kompetensi->mapel_id?>"><?=$kompetensi->nama_mapel?></option>
                </select>
            </div>
          </div>

            <div class="form-group">
            <label class="control-label col-md-3" >Kompetensi Dasar </label>
            <div class="col-sm-9">
             <?php
                $data=array(
                    'name'        =>'kompetensi',
                    'placeholder' =>'',
                    'id'          =>'kompetensi',
                    'value'       =>$kompetensi->nama_kompetensi,
                    'rows'        =>'1',
                    'class'       => 'form-control',


                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3" >Status </label>
            <div class="col-sm-9">
              <select name="status">
              <option value="" disabled>Pilih Status</option>
              <option value="0" <?php echo ($kompetensi->active==0)? "selected":"";?>>Tidak Aktif</option>
              <option value="1" <?php echo ($kompetensi->active==1)? "selected":"";?>>Aktif</option>
              </select>
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
