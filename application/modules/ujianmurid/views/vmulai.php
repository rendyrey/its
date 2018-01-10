<?php
    $num_of_per = count($pertanyaan);
    $count = 1;
?>

<div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <div class="row">
              <div class="col-xs-12">
               
                    <div>
                     
             <form id="anserForm" action="<?= site_url('ujianmurid'); ?>" method="post"> 
           <div class="question_content">   
           <input type="hidden" name="ujian_id" value="<?= $ujian->title_id; ?>">
           <input type="hidden" name="token" value="<?= time(); ?>">
            <div id="Carousel" class="carousel" data-interval="false" data-wrap="false" >
              <div class="carousel-inner">
              <?php 
foreach ($pertanyaan as $per): $type = ($per->option_type == 'Radio') ? 'radio' : 'checkbox'; ?>
<div class="item <?= ($count == $num_of_per) ? 'active' : '' ?>">
           <div class="col-xs-9">
<h3><?= $per->pertanyaan ?></h3><br/>
<?php if (!empty($per->media_type) AND ($per->media_type != '')  AND ($per->media_link != '')) {
                                                        switch ($per->media_type) {
                                                            
                                                           
                                                            
                                                            case 'image':
                                                                echo '<img src="'.base_url("assets/upload/pertanyaan-media/".$per->media_link).'" alt="image" style="width: 70%;height: 70%"  href="'.base_url("assets/upload/pertanyaan-media/".$per->media_link).'" ';
                                                                break;                                    
                                                            default:
                                                                break;
                                                        }
                                                        echo "<br/><br/>";
                                                    }
                                                    ?>
                                                      <?php
                                                    foreach ($jawaban[$per->per_id][0] as $jaw) { ?>
                                                        <div class="<?= $type ?>" style="margin-left: 23px; margin-top:10px;">
                                                            <label><input type="<?= $type ?>" name="jaw[<?= $per->per_id; ?>]<?= ($type == 'checkbox') ? '[]' : '' ?>" value="<?=$jaw->jaw_id; ?>"> 
                                                                <?=form_prep($jaw->jawaban); ?>
                                                            </label>
                                                        </div>
                                                    <?php 
                                                    } ?>

              </div>

              <div class="col-xs-3">
             
              <p>
<span class="pull-right">Pertanyaan <?= ($num_of_per - $count + 1) . ' Dari ' . $num_of_per; ?><br>WAKTU: 

</span>
<span class="time-duration"></span>
</p>
<p id="submit_button" style="margin: 30px 30px;"></p>

              </div>

              </div>
                 <?php $count++;
                                    endforeach;
                                    ?>
              </div>
              </div>
            
                                <div class=" me-control-btn">
                                    <a class="btn btn-lg btn-info col-xs-5 col-xs-offset-0 me-prev" href="#Carousel" data-slide="next" disabled> &laquo; Pertanyaan Sebelumnya<span class="hidden-xxs"></span></a>
                                    <a class="btn btn-lg btn-info col-xs-5 col-xs-offset-2 me-next" href="#Carousel" data-slide="prev">  <span class="hidden-xxs">Pertanyaan Selanjutnya</span> &raquo; </a>

                                </div>

                           
              </div>
              <div class="row">
                            
                        </div>
            </form>

             

                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
</div>
<script language="JavaScript"><!--
javascript:window.history.forward(1);
//--></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Set Time

        var count = <?= ($duration) ?>;
        var h, m, s, newTime;

        var counter = setInterval(timer, 1000);
        function timer() {
            count = count - 1;
            if (count < 0) {
                clearInterval(counter);
                return;
            }
            h = Math.floor(count / 3600);
            m = Math.floor(count / 60) - (h * 60);
            s = count % 60;
            if (m.toString().length == 1)
                m = '0' + m;
            if (s.toString().length == 1)
                s = '0' + s;
            if (h) {
                if (h.toString().length == 1)
                    h = '0' + h;
                newTime = '<h1><font size="50"><strong>' + h + ':' + m + ':' + s + '</strong></font></h1> <small class="text-muted"></small>';
            } else {
                newTime = '<h1><font size="50"><strong>' + m + ':' + s + '</strong></font></h1> <small class="text-muted"></small>';
            }
           
            //Update timer cookie
            var now = new Date();
            var time = now.getTime();
            time += count * 1000;
            now.setTime(time);
            document.cookie="UjianTimeDuration="+count+"; expires="+now.toUTCString()+"; path=/";
            
            //Update time to HTML
            $('.time-duration').html(newTime);
        }

        // Coltrol Buttons    
        var submit_btn = '<button type="submit" class="btn btn-primary btn-large" > <i class="fa fa-check-square-o"></i>  <span class="hidden-xxs">Selesai </span></a>';
        var slide_count = 1;
        var num_of_per = "<?php echo $num_of_per; ?>";
        $('.me-next').click(function() {
            $('.me-prev').removeAttr('disabled');
            slide_count++;
            if (slide_count >= num_of_per) {
                $('.me-next').attr('disabled', 'disabled');      //disable Nest button for last question.
                if (!$("#submit_button > button").length) {          //Check if the submit button already placed add if not.
                    $("#submit_button").append(submit_btn);
                }
            }
        });
        $('.me-prev').click(function() {
            $('.me-next').removeAttr('disabled');
            slide_count--;
            if (slide_count == 1) {
                $('.me-prev').attr('disabled', 'disabled');   //disable Prev button for fast question.
            }
        });

        //Sumbit after time out
        var timeout = <?= ($duration * 1000) ?>;
        setTimeout(function() {
            alert('WAKTU ANDA HABIS!');
            $('#anserForm').submit();
        }, timeout);

    });

</script>