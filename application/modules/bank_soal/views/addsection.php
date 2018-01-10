<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                
                    <div>
                     
                     
 <form action="<?=site_url('kursus/save_sections');?>" method="post" id="ajax-form" role="form" class="form-horizontal">
                  <input type="hidden" name="kursus_id" value="<?=$kursus_id;?>">
                  <input type="hidden" name="kursus_title" value="<?=$kursus_title;?>">
             
             <div class="form-group">
             <label for="section_1" class="col-sm-3 control-label no-padding-right" for="form-field-1" > section title 1</label>
            <div class="col-sm-9">
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


            <div class="form-group">
             <label for="section_2" class="col-sm-3 control-label no-padding-right" for="form-field-1"  > section title 2</label>
            <div class="col-sm-9">
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
            <div class="form-group">
             <label for="section_3" class="col-sm-3 control-label no-padding-right" for="form-field-1"  > section title 3</label>
            <div class="col-sm-9">
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
            <div class="form-group">
             <label for="section_4" class="col-sm-3 control-label no-padding-right" for="form-field-1" > section title 4</label>
            <div class="col-sm-9">
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
            <div class="form-group">
             <label for="section_5" class="col-sm-3 control-label no-padding-right" for="form-field-1" > section title 5</label>
            <div class="col-sm-9">
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
         
    
                      <div class="col-sm-3 control-label no-padding-right" for="form-field-1" >
                        <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Save</button>
                      </div>
                    
         </form>
                   
                  
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
