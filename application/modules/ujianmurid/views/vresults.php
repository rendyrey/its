<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                
                    <div>
                      
             <?=$this->session->flashdata('pesan')?> 
                     <table id="dynamic-table" class="table table-bordered data-table">
                       <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Ujian</th>
                            <th>Hasil</th>
                            <th>Nilai</th>
                            <th>Tanggal Ujian</th>
                            <th>Aksi</th>
                           
                           
                        </tr>
                    </thead>
                   
                    <tbody>
                     <?php $no=1; $i=1;?>
                    <?php foreach($hasil as $has): ?>
                        <tr clas="<?=($i & 1)? 'even' : 'odd';?>" >
                            <td><?=$no++?></td>
                            <td><?=$has->judul_ujian?></td>
                            <td><?=($has->result_persen >= $has->nilai)? '<div class="btn btn-success btn-sm">
              <div class="btn btn-success btn-sm" style="width: 100%">BERHASIL</div>
            </div>
' : '<div class="btn btn-danger btn-sm ">
              <div class="btn btn-danger btn-sm " style="width: 100%">GAGAL</div>
            </div>'?></td>
                            <td><?=$has->result_persen?>&nbsp;</td>
                            <td><?=date("D, d M", strtotime($has->ujian_taken_date))?></td>
                            <td>
                              <a class="btn btn-default " href="<?=site_url('ujianmurid/lihat_ujian_detail/'.$has->hasil_id)?>"> <i class="glyphicon glyphicon-list-alt"></i>Detail
                              </a>
                              <a class="btn btn-default " href="<?=site_url('ujianmurid/hasil_detail/'.$has->hasil_id)?>"> <i class="glyphicon glyphicon-list-alt"></i>Cetak
                              </a>

                            </td>
                            
                        </tr>

                     <?php $i++;endforeach; ?>   
                    </tbody>
                 
            </table>

                  
                  
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
