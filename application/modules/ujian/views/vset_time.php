

<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
           
                    <div>
                     
        
             
             
             <?=$this->session->flashdata('pesan')?> 

          
         <?=form_open(site_url('ujian/update_time_n_random_per_no'), 'role="form" class="form-horizontal"');?>
                  <input type="hidden" name="ujian_id" value="<?=$ujian_id?>">
       <input type="hidden" name="ujian_title" value="<?=$ujian_title?>">
       <input type="hidden" name="per_count" value="<?=$per_count?>">
             
             <div class="form-group">
             <label class="control-label col-md-3" > lama Ujian</label>
            <div class="col-sm-9">
           <?=form_input('duration','','id="timepicker1" placeholder="hh:mm:ss" class="form-control"')?>
                   <label class="control-label col-md-3"> ket : hh = Jam <br> mm: Menit <br> ss: Detik</label>
            </div>
          </div>

           <div class="form-group">
             <label class="control-label col-md-3" > Jumlah Acak Soal</label>
            <div class="col-sm-9">
           <?=form_input('random_per','','id="random_per" placeholder="hanya angka" class="form-control"')?>
                   <label class="control-label col-md-12">Jumlah Acak Soal Tidak Boleh Lebih Dari &nbsp; <font color="red"><b><h3><?=$per_count?></h3></b></font></label>
            </div>
          </div>


          
         
         <div class="control-group">
                      <div class="controls">
                        <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Save</button>
                      </div>
                    </div>
         </form>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
<script type="text/javascript">
  var i=6;
  function add_field()
  {
    var str='<div class="form-group"><label for="section_'+i+'" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">section title'+i+':</label>';
    str+='<div class="col-lg-6 col-sm-8 col-xs-7 col-mb">';
    str+='<textarea name="section[]" placeholder="section title'+i+'" class="form-control" row="2"></textarea>';
    str+='</div></div><div id="add_more_field-'+(i+1)+'"></div>';
    document.getElementById('add_more_field-'+i).innerHTML=str;
    i++;
  }
</script>