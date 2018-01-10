
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Data Section</h5>
          
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="span12">
            
             
             <?=$this->session->flashdata('pesan')?> 

           <form action="<?=site_url('kursus/save_sections');?>" method="post" id="ajax-form" role="form" class="form-horizontal">
                  <input type="hidden" name="kursus_id" value="<?=$kursus_id;?>">
                  <input type="hidden" name="kursus_title" value="<?=$kursus_title;?>">
             
             <div class="control-group">
             <label for="section_1" class="col-xs-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px"> section title 1</label>
            <div class="controls">
             <?php 
                            $data=array(
                                'name'        =>'section[]',
                                'placeholder' =>'sections title 1',
                                'id'          =>'section_1',
                                'value'       =>'',
                                'rows'        =>'2',
                                'class'       =>'form-control',
                               
                            
                              );
                          ?>
                          <?php echo form_textarea($data); ?>
            </div>
          </div>


            <div class="control-group">
             <label for="section_2" class="col-xs-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px"> section title 2</label>
            <div class="controls">
             <?php 
                            $data=array(
                                'name'        =>'section[]',
                                'placeholder' =>'sections title 2',
                                'id'          =>'section_2',
                                'value'       =>'',
                                'rows'        =>'2',
                                'class'       =>'form-control',
                               
                            
                              );
                          ?>
                          <?php echo form_textarea($data); ?>
            </div>
          </div>
            <div class="control-group">
             <label for="section_3" class="col-xs-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px"> section title 3</label>
            <div class="controls">
             <?php 
                            $data=array(
                                'name'        =>'section[]',
                                'placeholder' =>'sections title 3',
                                'id'          =>'section_3',
                                'value'       =>'',
                                'rows'        =>'2',
                                'class'       =>'form-control',
                               
                            
                              );
                          ?>
                          <?php echo form_textarea($data); ?>
            </div>
          </div>
            <div class="control-group">
             <label for="section_4" class="col-xs-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px"> section title 4</label>
            <div class="controls">
             <?php 
                            $data=array(
                                'name'        =>'section[]',
                                'placeholder' =>'sections title 4',
                                'id'          =>'section_4',
                                'value'       =>'',
                                'rows'        =>'2',
                                'class'       =>'form-control',
                               
                            
                              );
                          ?>
                          <?php echo form_textarea($data); ?>
            </div>
          </div>
            <div class="control-group">
             <label for="section_5" class="col-xs-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px"> section title 5</label>
            <div class="controls">
             <?php 
                            $data=array(
                                'name'        =>'section[]',
                                'placeholder' =>'sections title 5',
                                'id'          =>'section_1',
                                'value'       =>'',
                                'rows'        =>'5',
                                'class'       =>'form-control',
                               
                            
                              );
                          ?>
                          <?php echo form_textarea($data); ?>
            </div>
          </div>
         
          <div class="row">
                      <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                        <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Save</button>
                      </div>
                    </div>
         </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
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