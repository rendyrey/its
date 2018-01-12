<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

                    <div>

          <?=form_open_multipart(site_url('indikator/simpanindikator'), 'id="upload-form" role="form" class="form=horizontal"');?>



          <div class="padded">
            <div class="control-group">
              <label class="control-label col-md-2">Mata Pelajaran</label>
              <div class="controls" id="subcategorydiv">
                <select name="mapel" class="chosen-select" style="width:300px;" onChange="getState2(this.value)" required>
                  <option value="" disabled>Pilih Mata Pelajaran</option>
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
          <div class="padded">
            <div class="control-group">
              <label class="control-label col-md-2">Kompetensi Dasar</label>
              <div class="controls" id="subcategorydiv2">
                <select name="kompetensi" class="chosen-select" style="width:70%;" required>
                  <option>Pilih Mata Pelajaran Dulu</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-actions">
            <input type="hidden" name="operation" value="selection" />
          </div>

          <div class="form-group">
            <label class="control-label col-md-3" >Deskripsi Materi</label>
            <div class="controls">
            <?php
                    $data=array(
                        'name'        => 'nama_indikator',
                        'placeholder' => '',
                        'id'          => 'kompetensi',
                        'value'       => '',
                        'rows'        => '1',
                        'class'       => 'form-control',

                      );
                   ?>
                  <?=form_textarea($data)?>
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

    var strURL="<?=base_url()?>bank_soal/getsubcategoriajax/"+category_id;
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

  function getState2(mapel_id) {

    var strURL="<?=site_url('bank_soal/getsubcategoriajax2/')?>"+mapel_id;
    var req = getXMLHTTP();

    if (req) {

      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {
            document.getElementById('subcategorydiv2').innerHTML=req.responseText;
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
