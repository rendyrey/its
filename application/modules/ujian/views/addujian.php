<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">
      <div class="row">
        <div class="col-xs-12">

          <div>

            <form action="<?=site_url('Ujian/create_ujian/');?>" role="form" class="form=horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">

              <table>
                <tbody><tr>
                  <td width="50%">Judul Ujian  </td><td><input type="text" name="ujian_title" id="ujian_title" class="form-control"></td>
                </tr>
                <tr> 			<td>Pelajaran </td><td>
                  <!-- <select name="mapel_id" id="category" class="form-control"> -->
                  <!-- <option value="">algoritma pemrograman dasar</option> -->
                  <?=form_dropdown('mapel_id', $mata_pel, '');?>
                </select>
              </td>
            </tr>


            <tr>
              <td>Jenis Ujian  </td><td><select name="jenis" class="form-control">
                <option value="1">Pretest</option>
                <option value="0">Postest</option>
              </select></td>
            </tr>
            <tr>
              <td>Nilai Berhasil  </td><td> <input type="text" name="passing_score" value="" id="passing_score" placeholder="Nilai" class="form-control">
              </td>
            </tr>
            <tr>
              <td>Publish Ujian  </td><td><select name="public" class="form-control">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
              </select></td>
            </tr>
          </tbody></table>


          <!--<div class="control-group">
          <label class="control-label col-md-3" >Pilih Kelas</label>
          <div class="controls">
          <select name="parent-kelas" id="parent-kelas" class="form-control">
          <option value="24">algoritma pemrograman dasar</option>
        </select>
      </div>
    </div>-->

    <!--<div class="control-group">
    <label class="control-label col-md-3" >Pilih Sub Kelas</label>
    <div class="controls">
    <select name="kelas" id="kelas" class="form-control">
    <option> sub kelas</option>
  </select>
</div>
</div> -->













<div class="control-group">
  <div class="controls">
    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Submit</button>
  </div>
</div>
</form>
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
