
<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                <div>
                     <div class="col-xs-6">
                    <div class="inline position-relative">

                    <img id="avatar" class="img-responsive"  src="<?=base_url().'assets/upload/user/'.$hasils->image?>" alt="<?=$hasils->nama?>" style="width: 70%;height: 50%" />
                    </div>
                    </div>
            <div class="col-xs-6">
                    <div class="profile-user-info profile-user-info-striped">
                      <div class="profile-info-row">
                      <div class="profile-info-name"> Nama </div>
                      <div class="profile-info-value">
                            <span class="editable" id="username"><?=$hasils->nama?></span>
                          </div>

                      </div>
                      <div class="profile-info-row">
                      <div class="profile-info-name"> Email </div>
                      <div class="profile-info-value">
                            <span class="editable" id="username"><?=$hasils->email?></span>
                          </div>

                      </div>
                      <div class="profile-info-row">
                      <div class="profile-info-name"> Judul Latihan </div>
                      <div class="profile-info-value">
                            <span class="editable" id="username"><?=$hasils->judul_latihan?></span>
                          </div>

                      </div>

                      <div class="profile-info-row">
                      <div class="profile-info-name"> Total Pertanyaan </div>
                      <div class="profile-info-value">
                            <span class="editable" id="username"><?=$hasils->pertanyaanlatihan_dijawablatihan?></span>
                          </div>

                      </div>

                      <div class="profile-info-row">
                      <div class="profile-info-name"> Nilai </div>
                      <div class="profile-info-value">
                            <span class="editable" id="username"><?=$hasils->nilai?></span>
                          </div>

                      </div>

                    </div>
                     <?=($hasils->result_persen >= $hasils->nilai)? '<center><span class="label label-success">+++++++BERHASIL+++++++</span></center>':'<center><span class="btn btn-danger btn-sm popover-error">+++++++GAGAL+++++++ </span> </center>'?> dengan Nilai 
 <center><span class="label <?=($hasils->result_persen >= $hasils->nilai)?'label-success':'label-primary'?> "> (<?=$hasils->result_persen?>)</span>
             </div>

                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>


