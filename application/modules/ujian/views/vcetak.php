
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Hasil Ujian Anda</h5>
         
        </div>
        <div class="widget-content">
          <div class="row-fluid">
           <div class="span3">
           <div class="widget-box">
           <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Detail Ujian</h5>
        </div>
 

<div class="widget-content nopadding">
<p>Judul Ujian : <b><?=$hasils->judul_ujian?></b></p>
<p>Total pertanyaan: <b><?=$hasils->pertanyaan_dijawab?></b></p>
<p>Nilai : <b><?=$hasils->nilai?></b></p>
                

</div>

              </div>

        
            </div>

             <div class="span4">
           <div class="widget-box">
           <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Biodata</h5>
        </div>
 

<div class="widget-content nopadding">
<a class="thumbnail lightbox_trigger" href="<?=base_url().'assets/upload/user/'.$hasils->image?>">
<img src="<?=base_url().'assets/upload/user/'.$hasils->image?>" alt="<?=$hasils->nama?>" >
</a>

<ol>nama <ol><b><?=$hasils->nama?></b></ol></ol>
<ol>email <ol><b><?=$hasils->email?></b></ol></ol>
                

</div>

              </div>

        
            </div>
                <div class="span4">
           <div class="widget-box">
           <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Hasil</h5>
        </div>
 

<div class="widget-content nopadding">
 <?=($hasils->result_persen >= $hasils->nilai)? '<center><span class="label label-success">+++++++BERHASIL+++++++ </span></center>':'<center><span class="label label-important">+++++++GAGAL+++++++ </span> </center>'?> dengan Nilai 
 <center><span class="label <?=($hasils->result_persen >= $hasils->nilai)?'label-success':'label-primary'?> "> (<?=$hasils->result_persen?>)</span></center>
                            </blockquote>
                

</div>

              </div>

        
            </div>


          </div>
        </div>
      </div>
    </div>
    <hr>

    
  </div>
