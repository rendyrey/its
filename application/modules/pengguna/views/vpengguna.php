<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
                <div class="row">
                  <div class="col-xs-12">
                    <div>
                     
             <?=$this->session->flashdata('pesan')?> 
                      <table id="dynamic-table" class="table table-bordered data-table">
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
                 
                   
                      <img src="<?=base_url().'assets/upload/user/'.$list->image?>" alt="" width="100" height="100" >
                  
                  
                
                <?php }else {?>
                    
                    
                      <img src="<?=base_url().'assets/upload/user/noimage.jpg'?>" alt="" width="100" height="100">
                    
                  
                 
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
                            <button class="btn btn-danger" onclick="delete_pengguna(<?=$list->id;?>)">
                            <i class="ace-icon fa fa-trash"></i> Hapus
                            </button>
                            <?php if ($list->active==1){?>
                            <button class="btn btn-danger" onclick="nonaktifkan_pengguna(<?=$list->id?>)" title="nonaktifkan"><i class="ace-icon fa fa-eye-slash"></i> Non Aktifkan
                            </button>
                            <?php } else {?>
                            <button class="btn btn-primary" onclick="aktifkan_pengguna(<?=$list->id?>)" title="aktifkan"><i class="ace-icon fa fa-eye"></i>Aktifkan
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
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
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