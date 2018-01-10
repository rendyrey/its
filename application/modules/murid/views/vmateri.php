<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">
      <div class="row">
        <div class="col-xs-12">

          <div>

            <?=$this->session->flashdata('pesan')?>

            <div class="tabbable tabs-left">
              <ul class="nav nav-tabs" id="myTab3">
                <li>
                  <a data-toggle="tab" href="#materi">
                    <i class="pink ace-icon fa fa-tachometer bigger-110"></i>
                    Materi
                  </a>
                </li>

                <li class="active">
                  <a data-toggle="tab" href="#saran">
                    <i class="blue ace-icon fa fa-user bigger-110"></i>
                    Materi yang Disarankan
                  </a>
                </li>


              </ul>

              <div class="tab-content">
                <div id="saran" class="tab-pane in active">

                  <table id="dynamic-table1" class="table table-bordered data-table">
                    <thead>
                      <tr>

                        <th> Judul Materi</th>
                        <th>Download Materi</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i=1;?>
                      <?php foreach($hasils as $materi ) : ?>
                        <?php if($materi->kursus_id > 0){ ?>
                          <tr >

                            <td>
                              <?php echo $materi->kursus_title; ?>





                            </td>


                            <td>

                              <a href="<?=base_url('assets/upload/saran/'.$materi->document)?>" class="btn btn-danger"><i class="icon icon-view"></i>Download Materi</a>

                            </td>
                          </tr>
                        <?php } ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>

                </div>
                <div id="materi" class="tab-pane">
                  <table id="dynamic-table" class="table table-bordered data-table">

                    <thead>
                      <tr>

                        <th> Judul Materi</th>
                        <th>Download Materi</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i=1;?>
                      <?php foreach($doc as $materi ) : ?>
                        <?php if($materi->kursus_id > 0){ ?>
                          <tr >

                            <td>
                              <?php echo $materi->kursus_title; ?>





                            </td>


                            <td>

                              <a href="<?=base_url('assets/upload/materi/'.$materi->document)?>" class="btn btn-danger"><i class="icon icon-view"></i>Download Materi</a>

                            </td>
                          </tr>
                        <?php } ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>


              </div>
            </div>

          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.page-content -->
  </div>
</div>
