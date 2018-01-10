<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
             
             <?=$this->session->flashdata('pesan')?> 

           

        <div class="widget-body">
        <div class="widget-main">
        <p class="alert alert-info"> Latihan :<?=$ujian->judul_ujian?>Category: &nbsp; ujian->nama_categori</p>
        <p class="alert alert-success">Aturan:
       <ol>Total Pertanyaan <ol><b><?=$ujian->acak_soal?></b></ol></ol>
                            <ol>Passing Score <ol><b><?=$ujian->nilai?>&nbsp;%</b></ol></ol>
                            <ol>Duration : <ol><b><?=$ujian->durasi_waktu?></b></ol></ol>
        </div>
        <div class="widget-toolbox padding-8 clearfix">
                          

                          
                          <a href="<?=site_url('ujianmurid/view_ujian_instructions'.'/'.$ujian->title_id)?>" class="btn btn-xs btn-success pull-right"> <span class="bigger-110">I accept</span><i class="ace-icon fa fa-arrow-right icon-on-right"></i></a>
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
 