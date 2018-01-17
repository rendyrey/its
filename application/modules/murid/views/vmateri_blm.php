<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">
      <div class="row">
        <div class="col-xs-12">

          <div>

            <?=$this->session->flashdata('pesan')?>

            <div class="tabbable tabs-left">
              <h2>Anda Belum Melakukan Pretest</h2>
              <a href="<?=site_url('ujianmurid/pretest');?>"><button class="btn btn-warning">

            <i class="ace-icon fa fa-users"></i>
            Pretest
          </button>



            </div>

          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.page-content -->
  </div>
</div>
