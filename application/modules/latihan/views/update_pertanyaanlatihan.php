<script type="text/javascript">
  $('.update').click(function(){
    var id=$(this).attr('data-update');
    var value=$.trim($('#pertanyaan_title-'+id).html());
    $('#input').val(value);
    $('#per_id').val(id);
  })
</script>
<div class="modal modal" id="update_per" role="dialog"">

    <div class="modal-content" role="document">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title w-100" id="exampleModalLabel">Form Update Pertanyaan</h3>

      </div>
      <div class="modal-body form">
       
        <form action="<?php echo site_url('latihan/update_pertanyaanlatihan')?>" class="form-horizontal" method="post">
        <input type="hidden" value="<?=$latihan_title->title_id?>" name="per_id" id="per_id" />
        <input type="hidden" name="latihan_id" value="<?=$latihan_title->title_id?>">
          <div class="row">
          
          
          <div class="control-group">
              <label class="control-label">pertanyaan</label>
              <div class="controls">
               
             <?php 
             $data=array(
                'name'=>'pertanyaanlatihan',
                'id'  =>'input',
                'rows'  =>'2',
                'value'=>'',
               
              );

             ?>
             <?php echo form_textarea($data);?>
              </div>
            </div>
           
            
          
                       
         
          <div class="col-md-6">
          <div class="modal-footer">
            <?=form_submit('submit','save','class="btn btn-primary"')?>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>Cancel</button>
          </div>
         </div>
        </div>
   </form>
          </div>
          
        </div><!-- /.modal-content -->
   
    </div>  
   <!--/////////////////////////////// -->
    