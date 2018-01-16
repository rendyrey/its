<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">
      <div class="row">
        <div class="col-xs-12">

          <div>
            <a href="<?=site_url('Ujian/addujian')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah Ujian</a>

            <?=$this->session->flashdata('pesan')?>
            <?php   if(isset($ujian) AND !empty($ujian)){?>
              <table id="dynamic-table" class="table table-bordered data-table">
                <thead>
                  <tr>

                    <th>Judul ujian</th>
                    <th></th>

                  </tr>
                </thead>

                <tbody>
                  <?php $i=1;
                  foreach ($ujian as $ujians) {
                    ?>

                    <tr class="<?=($i&1)?'even':'odd';?>">
                      <td>
                        <span class="text-muted">Judul :</span> <?=$ujians->judul_ujian ?></span>
                        <span class="text-muted">Publish :</span> <?= ($ujians->public ==1)? 'Ya': 'Tidak' ?></span>
                        &nbsp;
                        <span class="text-muted">Nilai (%) :</span> <?=$ujians->nilai?></span>
                        &nbsp;


                        <span class="pull-right">
                          <span class="text-muted">Aktive :</span> <?= ($ujians->ujian_active ==1)?'Ya' : 'Tidak' ?>&nbsp;
                          <span class="text-muted">Pembuat Soal :</span> <?= $ujians->username ?>
                        </td>

                        <td>
                          <a class="btn btn-default btn-xs" href = " <?= site_url('ujian/ujiandetail/' . $ujians->title_id)?>"><i class="icon icon-eye-open"></i>Lihat Ujian</a>
                          <a class="btn btn-default btn-xs" href = " <?= site_url('ujian/edit_ujian_detail/' . $ujians->title_id)?>"><i class="icon icon-edit"></i>Edit Ujian</a>
                          <a onclick="return delete_confirmation()" class="btn btn-default btn-xs" href = " <?= site_url('ujian/delete_ujian/' . $ujians->title_id)?>"><i class="icon icon-trash"></i>Hapus</a>
                          <?php
                          if($ujians->ujian_active==1){?>
                            <a class="btn btn-default btn-xs" href = " <?= site_url('ujian/nonaktif/' . $ujians->title_id)?>"><i class="icon icon-eye-close"></i>Nonaktif</a>
                          <?php }
                          else { ?>
                            <a class="btn btn-default btn-xs" href = " <?= site_url('ujian/aktif/' . $ujians->title_id)?>"><i class="icon icon-eye-open"></i>Aktif</a>
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
                echo "Belum Ada Ujian";
              } ?>


            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.page-content -->
    </div>
  </div>
  <script type="text/javascript">
  function delete_confirmation (){
    return confirm ('yakin mengahpus soal ini ?');
  }
</script>
