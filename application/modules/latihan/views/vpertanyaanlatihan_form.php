

<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
           
                    <div>
                     
        
             
             
             <?=$this->session->flashdata('pesan')?> 

           <?=form_open_multipart(site_url('latihan/create_pertanyaanlatihan'), 'role="form" class="form-horizontal"');?>
           <div id="hidden_fields"></div>
                <input type="hidden" name="per_no" value="<?=$pertanyaanlatihan_no?>">
       <input type="hidden" name="per_id" value="<?=$title_id?>">
       <input type="hidden" name="latihan_title" value="<?=$latihan_title?>">  
             
             <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right"> Pertanyaan</label>
            <div class="col-sm-9">
             <?php 
                    $data=array(
                        'name'        => 'pertanyaanlatihan',
                        'placeholder' => 'Pertanyaan',
                        'id'          => 'pertanyaanlatihan',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'col-xs-10 col-sm-5',
                     
                      );
                   ?>
                   <?=form_textarea($data)?>
            </div>
          </div>
           <div class="form-group" id="media-choose">
             <label class="col-sm-3 control-label no-padding-right" for="upload-gambar"> Upload Gambar</label>
            <div class="col-sm-9">
              <a href="#" class="btn btn-app btn-primary no-radius" id="upload-gambar"><i class="ace-icon fa fa-camera"></i>
</a>
            </div>
            </div>
            <div class="form-group">
            <div id="media-option"></div>
          <div id="media-field"></div>
          </div>

<div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="upload-gambar"> Type Jawaban</label>
            <div class="col-sm-9">
            
              <input type="radio" id="radio1" name="jaw_type" required="required" value="Radio" onclick="add_form(this.value)"> <span>Tambahkan Jawaban </span>&nbsp;&nbsp;&nbsp;&nbsp;
           
            </div>
            </div>

            <div class="form-group">
              
              <div id="options"></div>
            
            </div>

            <div class="form-group">
            <div class="col-sm-9">
              <div id="progressBar" style="display: none;"><br> <img src="<?=base_url('assets/images/loading.gif')?>"></div>
            </div>
            </div>
           

          <div class="form-group">
                      <div class="col-sm-9">
                       <button type="submit" onclick="$('#progressBar').show();" class="btn btn-primary"> simpan dan tambah</button>
            <button type="submit" onclick="$('#progressBar').show();" name="done" value="done" class="btn btn-primary"> Simpan dan Selesai</button>
                      </div>
                    </div>
        <?=form_close()?>
                           
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>

<script type="text/javascript">
$('#upload-gambar').click(function(){
    var type = '<div class="form-group">'
                +'<label for="media_type" class="control-label col-md-3">Media Type: </label>'
                +'<div class="col-sm-9">'
                        //+'<input type="radio" value="youtube" name="media_type" required="required" onclick="add_media_field(this.value)"> <span>YouTube </span>&nbsp;&nbsp;&nbsp;&nbsp;'
                       // +'<input type="radio" value="video" name="media_type" required="required" onclick="add_media_field(this.value)"> <span>Video </span>&nbsp;&nbsp;&nbsp;&nbsp;'
                        +'<input type="radio" value="image" name="media_type" required="required" onclick="add_media_field(this.value)" > <span>Image </span>'
                        //+'<input type="radio" value="audio" name="media_type" required="required" onclick="add_media_field(this.value)"> <span>Audio </span>'
                +'</div>'
            +'</div>';
    $('#media-choose').hide();
    $('#media-option').append(type);
})

//Add media fields
function add_media_field(val) {
    var field = '<div class="form-group">'
                +'<label for="media_field" class="control-label col-md-3">Add Media: </label>'
                +'<div class="col-sm-9"><input type="hidden" name="media_type" value="'+val+'">';
    if (val == 'video') {
            var types = 'mp4 | webm | ogg';
    }else if (val == 'audio') {
            var types = 'ogg | mp3 | wav';        
    }else if (val == 'image') {
            var types = 'gif | jpg | png';
    };

    switch(val){
        case 'youtube':
            field += '<input type="text" class="col-xs-10 col-sm-5" name="media">';
            break;
        case 'video':
        case 'image':
        case 'audio':
            field += '<input type="file" id="media" name="media" style="margin-top:10px;" class="col-xs-10 col-sm-5">';
            field += '<p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Allowed types = '+ types +'.</p>';
            break;
    }
    field +='</div></div>';

    $('#media-option').hide();
    $('#media-field').append(field);
}
</script>
<script type="text/javascript">
//Add basic 4 fields initially
var i = 5, s;
function add_form(val) {
  //  alert(val);
    i = 5;
    var opt = '<div class=form-group><div class="col-sm-9">';
        opt += '<p class="text-primary"><i class="glyphicon glyphicon-flash"></i><b> Input Jawaban</b></p>';
        opt += '</div></div>';

    for (q = 1; q <= 4; q++) {
        opt += '<div class="form-group">';
        opt += '<label for="Pilihan[' + q + ']" class="col-sm-3 control-label no-padding-right">Pilihan ' + q + ': </label>';
        
        opt += '<div class="col-sm-9">';
        opt += '<span class="control-label no-padding-left">'
        if (val == 'Radio') {
            opt += '<input type="' + val + '" name="jaw" onclick="put_right_jaw(' + q + ')" required="required"> Pilihan Benar <br>';
        } 
        opt += '</span>';
        if (q <= 2) {
            opt += '<input name="options[' + q + ']" class="col-xs-10 col-sm-5" type="text" required="required"><br>';
        }
        if (q > 2) {
            opt += '<input name="options[' + q + ']" class="col-xs-10 col-sm-5" type="text"><br>';
        }
        opt += '</div>';
    }
    opt += '<div id="add_more_field-5"></div>';
    opt += '<div class="control-group">';
    opt += '<label class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">&nbsp;</label><div class="col-lg-5 col-sm-8 col-xs-7 col-mb">';
  //  opt += '<button type="button" class="btn btn-info" id="add_btn" onclick="add_field()"><icon class="icon-plus"></icon> Tambah Pilihan Jawaban</button>'c;
    opt += '</div></div>';
    document.getElementById('options').innerHTML = opt;
}

//Add more fields
/* function add_field() {
    var type;
    if (document.getElementById('radio1').checked) {
        type = 'radio';
    } else if (document.getElementById('checkbox1').checked) {
        type = 'checkbox';
    }
    if (i <= 8) {
        var str = '<div class="form-group"><label for="options[' + i + ']" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobil">Option ' + i + ': </label>';
        str += '<div class="col-lg-5 col-sm-8 col-xs-7 col-mb">';
        str += '<div class="input-group">';
        str += '<span class="input-group-addon">';
        if (type === 'radio') {
            str += '<input type="' + type + '" name="jaw" onclick="put_right_jaw(' + i + ')" required="required">  <span class="invisible-on-sm"> Jawaban Benar.</span>';
        } else if (type === 'checkbox') {
            str += '<input type="' + type + '" name="right_jaw[' + i + ']">  <span class="invisible-on-sm"> Correct Ans.</span>';
        }    
        str += '</span>';
        str += '<input name="options[' + i + ']" class="form-control" type="text">';
        str += '</div></div></div><div id="add_more_field-' + (i + 1) + '"></div>';

        document.getElementById('add_more_field-' + i).innerHTML = str;
        i++;
    } else {
        alert('You added maximum number of options!');
    }
} */

//Pick the righ answers and set the value to hidden fieldv
function put_right_jaw(val) {
    var ryt = '<input type="hidden" name="right_jaw[' + val + ']" value="on">';
    document.getElementById('hidden_fields').innerHTML = ryt;
}

</script>