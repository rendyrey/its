<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">
      <div class="row">
        <div class="col-xs-12">

          <div>

            <?=$this->session->flashdata('pesan')?>
            <center>
            <table>
              <tr>
                <td width='100px'>Nama</td>
                <td width='50px'>:</td>
                <td><?=$this->session->userdata('nama');?></td>
              </tr>
              <tr>
                <td width='100px'>Email</td>
                <td width='50px'>:</td>
                <td><?=$this->session->userdata('email');?></td>
              </tr>
              <tr>
                <td width='100px'>Username</td>
                <td width='50px'>:</td>
                <td><?=$this->session->userdata('username');?></td>
              </tr>


            </table>
          </center>

          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.page-content -->
  </div>
</div>
