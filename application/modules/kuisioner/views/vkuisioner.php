<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Learning ITS</title>

    <meta name="description" content="Static &amp; Dynamic Tables" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
</head>
<style type="text/css">
#kuisioner {
  width: 80%;
  margin: 0 auto;
  display: block;
}
.main-content {
  margin-top: 30px;
}
</style>
<body>
<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">
      <div class="row">
        <div class="col-xs-12">
              <div id="kuisioner">
                <center><h4>KUISIONER</h4></center>
                <ul>
                  <li>SR = Sering</li>
                  <li>KD = Kadang-kadang</li>
                  <li>JR = Jarang</li>
                </ul>
                <?=form_open_multipart(site_url('kuisioner/simpan'), 'id="upload-form" role="form" class="form=horizontal"');?>
                <table id="dynamic-table" class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th width="50px">No</th>
                        <th width="50px">SR</th>
                        <th width="50px">KD</th>
                        <th width="50px">JR</th>
                        <th>Pertanyaan</th>
                       
                    </tr>
                </thead>
               
                <tbody>
                 <?php $no=1; ?>
                <?php foreach($quis as $list): ?>
                    <tr>
                        <td><?=$no++?><input type="hidden" name="kuisioner_id[]" value="<?=$list->kuisioner_id?>"></td>
                        <td><input type="radio" name="jawab_<?=$list->kuisioner_id?>" value="SR"></td>
                        <td><input type="radio" name="jawab_<?=$list->kuisioner_id?>" value="KD"></td>
                        <td><input type="radio" name="jawab_<?=$list->kuisioner_id?>" value="JR"></td>
                        <td><?=$list->kuisioner?></td>
                    </tr>
                 <?php endforeach; ?>   
                </tbody>
                </table>

                <div class="form-group">
                  <div class="controls">
                   <button type="submit" id="btnSave"  class="btn btn-success"><span class="glyphicon glyphicon-saved"></span>Simpan</button>
                  </div>
                </div>
        
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   
   </body>
   </html>