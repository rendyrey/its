<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                
                    <div>
                     
          <?=form_open_multipart(site_url('kompetensi_dasar/simpankompetensi'), 'id="upload-form" role="form" class="form=horizontal"');?>
     
          <div class="form-group">
            <label class="control-label" >Pilih Categori </label>
            <div class="controls">
             <select name="category" data-placeholder="Pilih Kategori..." class="chosen-select" style="width:300px;" onChange="getState(this.value)" required>
              <option value=""></option> 
              <?php  foreach ($categories as $category) { ?>
               <option value="<?=$category->categori_id?>"><?=$category->nama_categori?></option> 
               <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" >Pilih Mata Pelajaran </label>
            <div class="controls" id="subcategorydiv">
              <select name="mapel" class="chosen-select" style="width:300px;" required>
                  <option>Pilih Kategori Dulu</option> 
                </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3" >Deskripsi Materi</label>
            <div class="controls">
            <?php 
                    $data=array(
                        'name'        => 'kompetensi',
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