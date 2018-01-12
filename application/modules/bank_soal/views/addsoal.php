<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

                    <div>

          <?=form_open_multipart(site_url('bank_soal/simpansoal'), 'id="upload-form" role="form" class="form=horizontal"');?>



          <div class="form-group">
            <label class="control-label" >Pilih Mata Pelajaran </label>
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

          <div class="form-group">
            <label class="control-label" >Pilih Kompetensi Dasar </label>
            <div class="controls" id="subcategorydiv2">
              <select name="kompetensi" class="chosen-select" style="width:300px;" required>
                  <option>Pilih Mata Pelajaran Dulu</option>
                </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" >Tingkat Kesulitan </label>
            <div class="controls" >
              <select name="kesulitan" class="" style="width:300px;" required>
                  <option value="0">Pilih Tingkat Kesulitan</option>
                    <option value="1">Mudah</option>
                    <option value="2">Sedang</option>
                    <option value="3">Sulit</option>
                </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label ">Soal</label>
            <div class="controls">
            <?php
                    $data=array(
                        'name'        => 'soal',
                        'placeholder' => '',
                        'id'          => 'soal',
                        'value'       => '',
                        'rows'        => '1',
                        'class'       => 'form-control',
                      );
                   ?>
                  <?=form_textarea($data)?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label">Tipe Jawaban</label>
            <div class="controls">
             <select name="tipe" class=""  onchange="showDiv(this)" id="pr_bookingtype" required>
              <option value="">Pilih Tipe Jawaban</option>
              <option value="Single">Pilihan Ganda</option>
              <option value="Multiple">Multi Pilihan</option>
            </select>
            </div>
          </div>

          <div id="hidden_div_single" style="display: none;">
          <label class="control-label">Masukan Pilihan</label>
          <table width="100%">
            <tr><th>No</th><th>Benar</th><th>Pilihan</th></tr>
            <tr>
              <td>A</td><td><input type="radio" name="correct_ans" value="A"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="option_A" class="validate[required]" rows="5" placeholder="Add Choices A"></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <tr>
              <td>B</td><td><input type="radio" name="correct_ans" value="B"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="option_B" class="validate[required]" rows="5" placeholder="Add Choices B"></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <tr>
              <td>C</td><td><input type="radio" name="correct_ans" value="C"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="option_C" class="validate[required]" rows="5" placeholder="Add Choices C"></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <tr>
              <td>D</td><td><input type="radio" name="correct_ans" value="D"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="option_D" class="validate[required]" rows="5" placeholder="Add Choices D"></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <tr>
              <td>E</td><td><input type="radio" name="correct_ans" value="E"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="option_E" class="validate[required]" rows="5" placeholder="Add Choices E"></textarea>
                  </div>
                </div>
              </td>
            <tr>
          </table>
          </div>

          <div id="hidden_div_multiple" style="display: none;">
            <label class="control-label">Masukan Pilihan</label>
            <table width="100%">
            <tr><th>No</th><th>Benar</th><th>Pilihan</th></tr>
            <tr>
              <td>A</td><td><input type="checkbox" name="correct_ans_A" value="A"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="check_option_A" class="validate[required]" rows="5" placeholder="Add Choices A"></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <tr>
              <td>B</td><td><input type="checkbox" name="correct_ans_B" value="B"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="check_option_B" class="validate[required]" rows="5" placeholder="Add Choices B"></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <tr>
              <td>C</td><td><input type="checkbox" name="correct_ans_C" value="C"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="check_option_C" class="validate[required]" rows="5" placeholder="Add Choices C"></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <tr>
              <td>D</td><td><input type="checkbox" name="correct_ans_D" value="D"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="check_option_D" class="validate[required]" rows="5" placeholder="Add Choices D"></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <tr>
              <td>E</td><td><input type="checkbox" name="correct_ans_E" value="E"></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="check_option_E" class="validate[required]" rows="5" placeholder="Add Choices E"></textarea>
                  </div>
                </div>
              </td>
            <tr>
          </table>
          </div>

          <div class="form-group">
            <label class="control-label">Nilai Benar</label>
            <div class="controls">
              <input type="number" name="nilai" min="0" max="25" required>
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
<script>
  function showDiv(elem){
  if(elem.value == 'Single')
  {
  document.getElementById('hidden_div_single').style.display = "block";
  document.getElementById('hidden_div_multiple').style.display = "none";
  document.getElementById('hidden_div_descriptive').style.display = "none";
  }
  else if(elem.value=='Multiple')
  {
  document.getElementById('hidden_div_multiple').style.display = "block";
  document.getElementById('hidden_div_single').style.display = "none";
  document.getElementById('hidden_div_descriptive').style.display = "none";

  }
  else if(elem.value=='Descriptive')
  {
    document.getElementById('hidden_div_descriptive').style.display = "block";
    document.getElementById('hidden_div_single').style.display = "none";
    document.getElementById('hidden_div_multiple').style.display = "none";
  }
  }
</script>
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
