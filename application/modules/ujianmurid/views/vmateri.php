
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title">
        <ul class="nav nav-tabs">
                                   
                                    <li><a data-toggle="tab" href="#tab2">Materi yang tersedia</a></li>
                                    <li><a data-toggle="tab" href="#tab3">Rekomendasi Materi</a></li>
                                </ul>

        </div>
        <div class="widget-content tab-content">
             <div id="tab2" class="tab-pane active">
                                  <p>
                                    
                                  
           <table class="table table-bordered data-table">
              <thead>
                <tr>
                 
                  <th> </th>
                  <th>Download Materi</th>
                </tr>
              </thead>
                
              <tbody>
              <?php $i=1;?>
              <?php foreach($doc as $materi ) : ?>
                <tr >
               
                <td>
                  
                    <span class="text-muted">Judul Materi :<?=$materi->kursus_title?></span> / 
                    <span class="text-muted"><?=$materi->section_title?></span>/ 
                    <span class="text-muted"><?=$materi->document_title?></span>
                    
                    <span class="text-muted">Categori :<?=$materi->nama_categori?></span> /
                  


                </td>
               
               
                <td>
                <a href="<?=base_url('assets/upload/kursus/document/'.$materi->kursus_id.'/'.$materi->document_link)?>" class="btn btn-danger"><i class="icon icon-view"></i>Download Materi</a>
                </td>
                </tr>
                 <?php endforeach; ?>
              </tbody>
            </table>
                                  </p>
                            
                                </div>
<div id="tab3" class="tab-pane">
                                <p> 
              <table class="table table-bordered data-table">
              <thead>
                <tr>
                 
                  <th> </th>
                  <th>Download Materi</th>
                </tr>
              </thead>
                
              <tbody>
              <tr>
              <?php $i=1;?>
              <?php foreach($hasils as $materi ) : 
                $Persen=$materi->result_persen;
                if ($Persen < 100) { ?>

                <td>
                  
                    <span class="text-muted">Judul Materi :<?=$materi->kursus_title?></span> / 
                    <span class="text-muted"><?=$materi->section_title?></span>/ 
                    <span class="text-muted"><?=$materi->document_title?></span>
                    
                    <span class="text-muted">Categori :<?=$materi->nama_categori?></span> /
                    <span class="text-muted">Sub categori :<?=$materi->namasubcategori?></span>


                </td>
               
               
                <td>
                <a href="<?=base_url('assets/upload/kursus/document/'.$materi->kursus_id.'/'.$materi->document_link)?>" class="btn btn-danger"><i class="icon icon-view"></i>Download Materi</a>
                </td>
           

                 <?php } else {echo "tidak ada ateri yang disarankan untuk anda";}endforeach; ?>
                 </tr>
              </tbody>
            </table>
                
             </p>
                                
                                </div>


        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
 