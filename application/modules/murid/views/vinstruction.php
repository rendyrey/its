<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
             
             <?=$this->session->flashdata('pesan')?> 

           

        <div class="widget-body">
        <div class="widget-main">
        <p class="alert alert-info"> <noscript>
              Browser kamu tidak mendukung javascript atau javasript dalam posisi disabled, silahkan enable dulu
            </noscript>
                <h3 class="text-muted">Requirements</h3>
                <ol>Enabe Javascript</ol>
                <ol>browser Update</ol>

                <h3 class="text-muted">Instruksi</h3>
                <ol>1</ol>
                <ol>2</ol>
                <ol>3</ol></p>
       
        </div>
        <div class="widget-toolbox padding-8 clearfix">
                          

                          
                          <a href="<?=site_url('murid/mulai_latihan/'.$latihan->title_id)?>" id="start_latihan" class="btn btn-xs btn-success pull-right"> <span class="bigger-110">Mulai Latihan</span><i class="ace-icon fa fa-arrow-right icon-on-right"></i></a>
                        </div>

        </div>
                    
          </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
  <script>
   $(document).ready(function(){
    $("#start_latihan").removeAttr("disabled");
   })
 </script>
 <script language="JavaScript">
 javascript:window.history.forward(1);
 </script>
    