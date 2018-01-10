
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=site_url()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
  <div class="container-fluid">
    
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tasks"></i></span>
          <h5>Daftar Categori Mata Pelajaran</h5>
          <button type = "button" class = "btn btn-primary" onclick="add_categori()" data-toggle="modal"><i class="fa fa-plus"></i>  <i class=" fa fa-map-marker"></i>  Tambah Categori</button>
        </div>
        <div class="widget-content">
          <div class="row-fluid">
            <div class="span12">
            
             
             <?=$this->session->flashdata('pesan')?> 

              <table id="example" class="table table-bordered data-table">
              <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                           
                        </tr>
                    </thead>
                   
                    <tbody>
                     <?php $no=1; ?>
                    <?php foreach($categorilist as $list): ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$list->nama_categori?></td>
                            <td>
                            <button class="btn btn-default btn-xs" onclick="edit_categori(<?=$list->categori_id;?>)"><i class="icon icon-edit"></i>Edit
                            </button>
                                    <button class="btn btn-default btn-xs" onclick="delete_categori(<?=$list->categori_id;?>)"><i class="icon icon-trash"></i>Hapus</button></td>
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
      function add_categori()
        {
          save_method = 'add';
          $('#form')[0].reset(); // reset form on modals
          $('#modal_form').modal('show'); // show bootstrap modal
          $('.modal-title').text('Tambah categori '); // Set Title to Bootstrap modal title
        }
      $(document).ready(function(){
          $("#form").validate({
            rules:{
              nama_categori:{required:true}
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
                url="<?=site_url('categori/save')?>";
              }else{
                url="<?=site_url('categori/updateaction')?>";
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
        function delete_categori(categori_id)
         {
            if (confirm('Anda Yakin Menghapus data Categori ini?')) 
            {
              $.ajax
              ({
                url:"<?=site_url('categori/delete')?>/"+categori_id,
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
         function edit_categori(categori_id)
         {
            save_method='update';
            $('#form')[0].reset();
            $.ajax
            ({
                url:"<?=site_url('categori/update')?>/"+categori_id,
                type:"GET",
                dataType:"JSON",
                success:function(data)
                {
                  $('[name="categori_id"]').val(data.categori_id);
                  $('[name="nama_categori"]').val(data.nama_categori);
                  $('#modal_form').modal('show');
                  $('.modal-title').text('Edit Data Categori');
                },
                error:function(jqXHR, textStatus, errorThrown)
                {
                  alert('Gagal dalam pengambilan data');
                }
            });
         }
                
 </script>
</div>
 <div class="modal fade bs-example-modal-lg " id="modal_form" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" role="document">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title w-100" id="exampleModalLabel">Categori</h3>

      </div>
      <div class="modal-body form">
        <form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data" novalidate="novalidate">
        <input type="hidden" value="" name="categori_id" id="categori_id" />
          <div class="control-group">
            <label class="control-label col-md-3" >Nama Categori </label>
            <div class="controls">
            <input type="text" name="nama_categori" id="nama_categori" required="" title="Field Categori Harus Diisi">
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
   