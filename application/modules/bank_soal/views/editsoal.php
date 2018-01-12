<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

                    <div>


 <?=$this->session->flashdata('pesan')?>
  <?=form_open_multipart(site_url('bank_soal/update_soal'), 'role="form" class="form=horizontal"');?>

            <input type="hidden" name="soal_id" id="soal_id" value="<?=$soal->soal_id?>">



          <div class="form-group">
            <label class="control-label" >Pilih Mata Pelajaran </label>
            <div class="controls" id="subcategorydiv">
              <select name="mapel" class="chosen-select" style="width:300px;" required>
                  <option value="<?=$soal->mapel_id?>"><?=$soal->nama_mapel?></option>
                </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" >Pilih Kompetensi Dasar </label>
            <div class="controls" id="subcategorydiv2">
              <select name="kompetensi" class="chosen-select" style="width:300px;" required>
                  <option value="<?=$soal->kompetensi_id?>"><?=$soal->nama_kompetensi?></option>
                </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" >Tingkat Kesulitan </label>
            <div class="controls" >
              <select name="kesulitan" class="" style="width:300px;" required>
                  <option value="">Pilih Tingkat Kesulitan</option>
                    <option value="1" <?=($soal->kesulitan==1)?"selected":""?>>Mudah</option>
                    <option value="2" <?=($soal->kesulitan==2)?"selected":""?>>Sedang</option>
                    <option value="3" <?=($soal->kesulitan==3)?"selected":""?>>Sulit</option>
                </select>
            </div>
          </div>

            <div class="form-group">
            <label class="control-label" >Soal </label>
            <div class="controls">
             <?php
                $data=array(
                    'name'        =>'soal',
                    'placeholder' =>'',
                    'id'          =>'soal',
                    'value'       =>$soal->deskripsi,
                    'rows'        =>'1',
                    'class'       => 'form-control',


                  );
               ?>
               <?php echo form_textarea($data); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label">Tipe Jawaban</label>
            <div class="controls">
             <select name="tipe" class=""  onchange="showDiv(this)" id="pr_bookingtype">
              <option value="">Pilih Tipe Jawaban</option>
              <option value="Single" <?=($soal->tipe=="Single")?"selected":""?>>Pilihan Ganda</option>
              <option value="Multiple" <?=($soal->tipe=="Multiple")?"selected":""?>>Multi Pilihan</option>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" >Status </label>
            <div class="controls">
              <select name="status">
              <option value="" disabled>Pilih Status</option>
              <option value="0" <?php echo ($soal->active==0)? "selected":"";?>>Tidak Aktif</option>
              <option value="1" <?php echo ($soal->active==1)? "selected":"";?>>Aktif</option>
              </select>
            </div>
          </div>

          <?php
          $pilihan = $this->db->select('*')
                    ->where('soal_id',$soal->soal_id)
                    ->from('soal_detail')
                    ->get()
                    ->result();
          $jml = count($pilihan);
          ?>
          <div id="hidden_div_single" style="<?=($soal->tipe=='Single')?'':'display: none;'?>">
          <label class="control-label">Masukan Pilihan</label>
          <table width="100%">
            <tr><th>No</th><th>Benar</th><th>Pilihan</th></tr>
            <?php
            for($j=0;$j<$jml;$j++){
              $cek = ($pilihan[$j]->benar=='1') ? 'checked=checked' : '';
            ?>
            <tr>
              <td><?=$pilihan[$j]->nomor?></td><td><input type="radio" name="correct_ans" value="<?=$pilihan[$j]->nomor?>" <?=$cek?>></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="option_<?=$pilihan[$j]->nomor?>" class="validate[required]" rows="5" placeholder="Add Choices <?=$pilihan[$j]->nomor?>"><?=$pilihan[$j]->pilihan?></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <?php } ?>
          </table>
          </div>

          <div id="hidden_div_multiple" style="<?=($soal->tipe=='Multiple')?'':'display: none;'?>">
            <label class="control-label">Masukan Pilihan</label>
            <table width="100%">
            <tr><th>No</th><th>Benar</th><th>Pilihan</th></tr>
            <?php
            for($h=0;$h<$jml;$h++){
              $cek = ($pilihan[$h]->benar=='1') ? 'checked=checked' : '';
            ?>
            <tr>
              <td><?=$pilihan[$h]->nomor?></td><td><input type="checkbox" name="correct_ans_<?=$pilihan[$h]->nomor?>" value="<?=$pilihan[$h]->nomor?>" <?=$cek?>></td>
              <td>
                <div class="form-group">
                  <div class="controls">
                    <textarea  name="check_option_<?=$pilihan[$h]->nomor?>" class="validate[required]" rows="5" placeholder="Add Choices <?=$pilihan[$h]->nomor?>"></textarea>
                  </div>
                </div>
              </td>
            <tr>
            <?php }  ?>

          </table>
          </div>

          <div class="form-group">
            <label class="control-label">Nilai Benar</label>
            <div class="controls">
              <input type="number" name="nilai" min="0" max="25" value="<?=$soal->nilai?>">
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

    var strURL="<?=base_url()?>bank_soal/getsubcategoriajax2/"+mapel_id;
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
