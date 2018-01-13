<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">

             <?=$this->session->flashdata('pesan')?>

             <?php   if(isset($latihan) AND !empty($latihan)){?>

              <table id="dynamic-table" class="table table-bordered data-table">
                 <thead>
                        <tr>

                            <th>Judul Latihan</th>
                            <th></th>

                        </tr>
                    </thead>

                    <tbody>
                     <?php $i=1;
                     foreach ($latihan as $latihans) {
                     ?>

                        <tr class="<?=($i&1)?'even':'odd';?>">
                            <td>
                            <span class="text-muted">Judul :</span> <?=$latihans->judul_latihan ?></span>
                              <span class="text-muted">Publish :</span> <?= ($latihans->public ==1)? 'Ya': 'Tidak' ?></span>
                              &nbsp;
                              <span class="text-muted">Nilai (%) :</span> <?=$latihans->nilai?></span>
                              &nbsp;
                              <!--<span class="text-muted">Kelas :</span> <?=$latihans->nama_kelas.'/'.$latihans->namasubkelas?></span>&nbsp;<br> -->

                              <span class="pull-right">
                                 <span class="text-muted">Aktive :</span> <?= ($latihans->latihan_active ==1)?'Ya' : 'Tidak' ?>&nbsp;
                                  <span class="text-muted">Pembuat Soal :</span> <?= $latihans->username ?>
                            </td>

                            <td>
<a class="btn btn-warning" href = " <?= site_url('latihan/latihandetail/' . $latihans->title_id)?>"><span class="glyphicon glyphicon-edit" title="Edit">Lihat Latihan</span></a>
<a class="btn btn-warning" href = " <?= site_url('latihan/edit_latihan_detail/' . $latihans->title_id)?>"><span class="glyphicon glyphicon-edit" title="Edit">Edit Latihan</span></a>
<a onclick="return delete_confirmation()" class="btn btn-warning" href = " <?= site_url('latihan/delete_latihan/' . $latihans->title_id)?>"><span class="glyphicon glyphicon-edit" title="Edit">Hapus Latihan</span></a>
<?php
if($latihans->latihan_active==1){?>
<a class="btn btn-warning" href = " <?= site_url('latihan/nonaktif/' . $latihans->title_id)?>"><span class="glyphicon glyphicon-edit" title="Edit">nonaktif</span></a>
<?php }
else { ?>
<a class="btn btn-warning" href = " <?= site_url('latihan/aktif/' . $latihans->title_id)?>"><span class="glyphicon glyphicon-edit" title="Edit">aktif</span></a>
<?php }?>



                                    </td>
                        </tr>
                       <?php
                       $i++;
                     }
                       ?>
                    </tbody>
              </table>



              <?php }else{
                echo "Belum Ada Latihan";
                } ?>
            </div>

          </div>
        </div>
      </div>
    </div>
    <hr>



  </div>
 <script type="text/javascript">
  function delete_confirmation (){
    return confirm ('yakin mengahpus soal ini ?');
  }
</script>
