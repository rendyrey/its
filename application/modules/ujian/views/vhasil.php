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
                            <th>Nama</th>
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
                            <td><?=$has->nama?></td>
                            <td><?=$has->judul_ujian?></td>
                            <td><?=($has->result_persen >= $has->nilai)? '<div class="btn btn-success btn-sm">
              <div class="btn btn-success btn-sm" style="width: 100%">BERHASIL</div>
            </div>
' : '<div class="btn btn-danger btn-sm ">
              <div class="btn btn-danger btn-sm " style="width: 100%">GAGAL</div>
            </div>'?></td>
                            <td><?=$has->result_persen?>&nbsp;%</td>
                            <td><?=date("D, d M", strtotime($has->ujian_taken_date))?></td>
                            <td>
                              <a class="btn btn-default btn-xs" href="<?=site_url('ujian/lihat_ujian_detail/'.$has->hasil_id)?>"> <i class="icon icon-eye-open"></i>Detail
                              </a>
                              <a class="btn btn-default btn-xs" href="<?=site_url('ujian/cetak/'.$has->hasil_id)?>"> <i class="icon icon-print"></i>Cetak
                              </a>
                              <button class="btn btn-default btn-xs" onclick="delete_hasil(<?=$has->hasil_id;?>)"><i class="icon icon-trash"></i>Delete
                            </button>
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
 <script type="text/javascript">
  function delete_hasil(hasil_id)
         {
            if (confirm('Anda Yakin Menghapus data hasil ujian ini?')) 
            {
              $.ajax
              ({
                url:"<?=site_url('ujian/deletehasil')?>/"+hasil_id,
                type:"POST",
                dataType:"JSON",
                success :function(data)
                {
                  location.reload();
                },
                error:function(jqXHR, textStatus, errorThrown)
                {
                  alert('Terdapat Kesalahan Dalam Menghapus Data');
                }
              });
            }
         }
</script>
