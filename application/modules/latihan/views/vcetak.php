
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Hasil Latihan Anda</h5>
         
        </div>
        <center><b>HASIL LATIHAN</b></center>
        <div class="widget-content">
          <div class="row-fluid">
           <div class="span3">
           <div class="widget-box">
           <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Detail Latihan</h5>
        </div>
 

<div class="widget-content nopadding">
<p>Judul Ujian : <b><?=$hasilslatihan->judul_latihan?></b></p>
<p>Total pertanyaan: <b><?=$hasilslatihan->pertanyaanlatihan_dijawablatihan?></b></p>
<p>Nilai : <b><?=$hasilslatihan->nilai?></b></p>
                

</div>

              </div>

        
            </div>

             <div class="span4">
           <div class="widget-box">
           <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Biodata</h5>
        </div>
 

<div class="widget-content nopadding">
<a class="thumbnail lightbox_trigger" href="<?=base_url().'assets/upload/user/'.$hasilslatihan->image?>">
<img src="<?=base_url().'assets/upload/user/'.$hasilslatihan->image?>" alt="<?=$hasilslatihan->nama?>" >
</a>

<ol>nama <ol><b><?=$hasilslatihan->nama?></b></ol></ol>
<ol>email <ol><b><?=$hasilslatihan->email?></b></ol></ol>
                

</div>

              </div>

        
            </div>
                <div class="span4">
           <div class="widget-box">
           <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Hasil</h5>
        </div>
 

<div class="widget-content nopadding">
 <?=($hasilslatihan->result_persen >= $hasilslatihan->nilai)? '<center><span class="label label-success">+++++++BERHASIL+++++++ </span></center>':'<center><span class="label label-important">+++++++GAGAL+++++++ </span> </center>'?> dengan Nilai 
 <center><span class="label <?=($hasilslatihan->result_persen >= $hasilslatihan->nilai)?'label-success':'label-primary'?> "> (<?=$hasilslatihan->result_persen?>)</span></center>
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
