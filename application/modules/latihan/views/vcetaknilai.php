
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" http-equiv="Content-Type">
</head>
<body style="width:100%">
	<div style="width: 100%; border-bottom: 2px solid black;" >
		<table style="width: 100%;vertical-align: middle;">
			<tr>
					<td style="width: 35px; border:0px;">
						<center>Laporan Hasil Latihan Persiswa</center>
					</td>
			</tr>
			<tr>
				<td style=""><center><img style="width:500%;" src="<?=site_url().'assets/images/logo.png'?>"></center></td>
			</tr>
		</table>
	</div>
	<br/>
	<br/>
	<div style="padding: 5px 0; width: 100%;">
		<div>
				<table style="width: 100%;border-radius: 3px;">
					<tr>
						<td style="width: 150px;">
							<table style="border: 1px solid-grey;">
								<tr>
									<td style="background-color: lightgray;border-radius: 2px;">
										<?php if(!empty($hasilslatihan->image)) { ?>
					
										<img style="width: 50px;height: 50px" src="<?=base_url().'assets/upload/user/'.$hasilslatihan->image?>">
					<?php }else{?>
										<img style="width: 50px;height: 50px" src="<?=base_url().'assets/upload/user/noimage.jpg'?>">
										<?php	} ?>
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table style="width: 300px;margin-left: 10px; margin-bottom: 10px;font-size: 13px;">
								<tr>
									<td>
										<td colspan="2"><h2><?=$hasilslatihan->nama?></h2>
											
										</td>
									</td>
								</tr>
								<tr>
									<td style="width: 100px;"><strong>Username :</strong></td>
									<td colspan="2"><?=$hasilslatihan->username?></td>
								</tr>
								<tr>
									<td style="width: 100px;"><strong>Email :</strong></td>
									<td colspan="2"><?=$hasilslatihan->email?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
		</div>
	</div>
	<div style="width: 100%;margin-top: 55px">
	<div>
		<div style="width: 100%;background: #E3E3E3;padding: 1px 0px 1px 10px;color: black;vertical-align: middle; ">
			<p style="margin-left: 10px;font-size: 15px;font-weight: lighter;width: 100%"><strong><center>Hasil Latihan</center></strong></p>
		</div>
		<br/>
		<table style="width: 100%;">
			<tr>
				<td>
					<table style="width: 100% ;font-size:13px;">
						<tr>
							<td style="text-align: left"><strong>Latihan:</strong></td>
							<td style=""><?=$hasilslatihan->judul_latihan?></td>
						</tr>
						<tr>
							<td style="text-align: left;"><strong>Total Pertanyaan:</strong></td>
							<td style=""><?=$hasilslatihan->pertanyaanlatihan_dijawablatihan?></td>
						</tr>
						<tr>
							<td style="text-align: left;"><strong>Tanggal Latihan:</strong></td>
							<td style=""><?php echo date('d M Y h:i:s',strtotime($hasilslatihan->latihan_taken_date)) ?></td>
						</tr>
						<tr>
							<td style="text-align: left;"><strong>Status:</strong></td>
							<td style="font-size: 20px;"><?=($hasilslatihan->result_persen >= $hasilslatihan->nilai)? '++BERHASIL++':'++GAGAL++'?> dengan Nilai 
 <span class="label <?=($hasilslatihan->result_persen >= $hasilslatihan->nilai)?'label-success':'label-primary'?> "> (<?=$hasilslatihan->result_persen?>)</span></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>	
	</div>
		
	</div>
	<div style="width: 100%;margin-top: 55px">
	<div>
		<div style="width: 100%;background: #E3E3E3;padding: 1px 0px 1px 10px;color: black;vertical-align: middle; ">
			<p style="margin-left: 10px;font-size: 15px;font-weight: lighter;width: 100%"><strong><center><?=($hasilslatihan->result_persen >= $hasilslatihan->nilai)? 'SELAMAT ! PERTAHANKAN':'TINGKATKAN LAGI'?></center></strong></p>
		</div>
		<br/>
		
	</div>
		
	</div>
	<div style="width: 100%;margin-top: 20px">
	<div>
		<table style="width: 100%;">
			<tr>
				<td>
					<table style="width: 100% ;font-size:13px;">
						<tr>
							<td style="text-align: right;"><strong>Guru:</strong></td>
						
						</tr>

						
					</table>
				</td>
			</tr>
		</table>	
		
	</div>
		
	</div>
	<div style="width: 100%;margin-top: 50px">
	<div>
		<table style="width: 100%;">
			<tr>
				<td>
					<table style="width: 100% ;font-size:13px;">
						
						<tr>
							
							<td style="font-size: 20px; text-align: right;">Anton Joni Saputra</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>	
		
	</div>
		
	</div>
</body>
</html>