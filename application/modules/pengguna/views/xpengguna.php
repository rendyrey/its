
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Daftar Buku Telepon</h5>
         <!-- <button type = "button" class = "btn btn-primary" onclick="add_pengguna()" data-toggle="modal"><i class="fa fa-plus"></i>  <i class=" fa fa-map-marker"></i>  Tambah Pengguna</button>-->
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="col-sm-12">
            
             
             <?=$this->session->flashdata('pesan')?> 

           <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th></th>
                  <th>Nama </th>
                  <th>Email</th>
                  
                  <th>Level</th>
                  <th>Username</th>
                  <th>status</th>
                  <th>Aksi</th>
                  
                </tr>
              </thead>
                
              <tbody>
              <?php $no=1;?>
              <?php foreach($penggunalist as $list ) : ?>
                <tr >
                <td><?=$no++;?></td>
                <td>
                    
                <?php if(!empty($list->image)){?>
                    <li class="span2">
                    <a class="thumbnail lightbox_trigger" href="<?=base_url().'assets/upload/user/'.$list->image?>">
                      <img src="<?=base_url().'assets/upload/user/'.$list->image?>" alt="" >
                    </a>
                  
                  </li>
                <?php }else {?>
                    <li class="span2">
                    <a class="thumbnail lightbox_trigger" href="<?=base_url().'assets/upload/user/noimage.jpg'?>">
                      <img src="<?=base_url().'assets/upload/user/noimage.jpg'?>" alt="" >
                    </a>
                  
                  </li>
              <?php  }?>


                </td>
                <td><?=$list->nama?></td>
                <td><?=$list->email?></td>
                <td><?=$list->level?></td>
                <td><?=$list->username?></td>
                <td><?php 
                                if ($list->active==1){echo "aktif";}else {echo "dinonaktifkan";}
                            ?></td>
                            <td>
                            <!--<button class="btn btn-default btn-xs" onclick="edit_pengguna(<?=$list->id;?>)">
                            <i class="icon icon-edit"></i> Edit
                            </button>-->
                            <button class="btn btn-default btn-xs" onclick="delete_pengguna(<?=$list->id;?>)">
                            <i class="icon icon-trash"></i> Hapus
                            </button>
                            <?php if ($list->active==1){?>
                            <button class="btn btn-default btn-xs" onclick="nonaktifkan_pengguna(<?=$list->id?>)" title="nonaktifkan"><i class="icon icon-eye-close"></i> Non Aktifkan
                            </button>
                            <?php } else {?>
                            <button class="btn btn-default btn-xs" onclick="aktifkan_pengguna(<?=$list->id?>)" title="aktifkan"><i class="icon icon-eye-open"></i>Aktifkan
                            </button>
                            <?php } ?>
                            </td>
                </tr>
                 <?php endforeach; ?>
              </tbody>
            </table>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <hr>
    
    
    
  </div>
 <script type="text/javascript">
      var save_method; //for save method string
      var table;
      function add_pengguna()
        {
          save_method = 'add';
          $('#form')[0].reset(); // reset form on modals
          $('#modal_form').modal('show'); // show bootstrap modal
          $('.modal-title').text('Tambah Pengguna '); // Set Title to Bootstrap modal title
        }
      $(document).ready(function(){
          $("#form").validate({
            rules:{
              username:{required:true},
              namalengkap:{required:true},
              email:{required:true},
              password:{required:true},
              level:{required:true}
            }
           });
      });
      
      function save()
        {   
          var form = $("#form");
          var url;
          if (!form.valid())
            {
              document.getElementById('form').focus();
            }
            else{
              if (save_method == 'add') {
                url="<?=site_url('pengguna/save')?>";
              }else{
                url="<?=site_url('pengguna/updateaction')?>";
              }
            $.ajax({
              url:url,
              type:"POST",
              data:$('#form').serialize(),
              dataType:"JSON",
              success:function(data)
                {
                  $('#modal_form').modal('hide');
                  location.reload();
                },
              error:function ()
                {
                  alert('Terdapat Kesalahan');
                }
            }); 
        }}
        function delete_pengguna(id)
         {
            if (confirm('Anda Yakin Menghapus data Pengguna ini?')) 
            {
              $.ajax
              ({
                url:"<?=site_url('pengguna/delete')?>/"+id,
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
         function nonaktifkan_pengguna(id)
         {
            if (confirm('Anda Yakin menonaktifkan Pengguna ini?')) 
            {
              $.ajax
              ({
                url:"<?=site_url('pengguna/nonaktifkan_pengguna')?>/"+id,
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
         function aktifkan_pengguna(id)
         {
            if (confirm('Anda Yakin aktifkan Pengguna ini?')) 
            {
              $.ajax
              ({
                url:"<?=site_url('pengguna/aktifkan_pengguna')?>/"+id,
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
         function edit_pengguna(id)
         {
            save_method='update';
            $('#form')[0].reset();
            $.ajax
            ({
                url:"<?=site_url('pengguna/update')?>/"+id,
                type:"GET",
                dataType:"JSON",
                success:function(data)
                {
                  $('[name="id"]').val(data.id);
                  $('[name="username"]').val(data.username);
                  $('[name="nama"]').val(data.nama);
                  $('[name="email"]').val(data.email);
                  $('[name="password"]').val(data.password);
                  $('[name="level"]').val(data.level);
                  $('#modal_form').modal('show');
                  $('.modal-title').text('Edit Data Pengguna');
                },
                error:function(jqXHR, textStatus, errorThrown)
                {
                  alert('Gagal dalam pengambilan data');
                }
            });
         }
                
 </script>
</div>
 <div class="modal modal hide " id="modal_form" role="dialog"">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" role="document">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title w-100" id="exampleModalLabel">Buku Telepon</h3>

      </div>
      <div class="modal-body form">
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
        <input type="hidden" value="" name="id" id="phonebook_id" />
          <div class="control-group">
            <label class="control-label col-md-3" >Username </label>
            <div class="controls">
            <input type="text" name="username" id="username" required="" title="Field username Harus Diisi">
            </div>
          </div>
           <div class="control-group">
            <label class="control-label col-md-3" >Password</label>
            <div class="controls">
            <input type="password" name="password" id="password" required="" title="Field Password Harus Diisi">
            </div>
          </div>
           <div class="control-group">
            <label class="control-label col-md-3" >Email </label>
            <div class="controls">
            <input type="text" name="email" id="email" required="" title="Field Email Harus Diisi">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label col-md-3" >Nama </label>
            <div class="controls">
            <input type="text" name="nama" id="nama" required="" title="Field nama Harus Diisi">
            </div>
          </div>
         
           <div class="control-group">
            <label class="control-label col-md-3" >Group </label>
            <div class="controls">
          <select name="level">
            <option value="guru">Guru</option>
            <option value="murid">Murid</option>
          </select>
            </div>
          </div>
        </form>
          </div>
          <div class="modal-footer">
           <button type="button" id="btnSave" onclick="save()" class="btn btn-success"><span class="glyphicon glyphicon-saved"></span>Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>  
    <!-- sms -->
   