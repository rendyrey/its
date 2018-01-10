<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
             
             <?=$this->session->flashdata('pesan')?> 

           

        <div class="widget-body">
        <div class="widget-main">
        <p class="alert alert-info"> Latihan :<?=$latihan->judul_latihan?>Category: &nbsp; <?=$latihan->nama_categori?></p>
        <p class="alert alert-success">Aturan:
        <ol>Total Pertanyaan <ol><b><?=$latihan->acak_soal?></b></ol></ol>
        <ol>Passing Score <ol><b><?=$latihan->nilai?>&nbsp;%</b></ol></ol>
        <ol>Duration : <ol><b><?=$latihan->durasi_waktu?></b></ol></ol></p>
        </div>
        <div class="widget-toolbox padding-8 clearfix">
                          

                          
                          <a href="<?=site_url('murid/view_latihan_instructions'.'/'.$latihan->title_id)?>" class="btn btn-xs btn-success pull-right"> <span class="bigger-110">I accept</span><i class="ace-icon fa fa-arrow-right icon-on-right"></i></a>
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
 