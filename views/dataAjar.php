<?php 
include "config/koneksi.php";

if(@$_GET['act'] == ''){
?>

<div class="row">
    <div class="col-lg-12">
         <h1>Jadwal <small>Data Jadwal</small></h1>
         <ol class="breadcrumb">
             <li><a href="index.html"><i class="icon-dashboard"></i> Jadwal</a></li>
      	</ol>
	</div>
</div>

<!-- tampilkan data Ajar -->
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<th>No</th>
					<th>Kode Ajar</th>
					<th>Profesor</th>
					<th>Matkul</th>
					<th>Ruang</th>
					<th>Waktu</th>
					<th>Opsi</th>
				</tr>
				<?php 
					$query = "SELECT * FROM tb_ajar
					INNER JOIN tb_profesor ON tb_ajar.nik = tb_profesor.nik
					INNER JOIN tb_matkul ON tb_ajar.kd_mk = tb_matkul.kd_mk
					INNER JOIN tb_kelas ON tb_ajar.kd_kelas = tb_kelas.kd_kelas";
					$koneksi = mysqli_query($connect, $query);
					$no = 1;
					while($data = mysqli_fetch_array($koneksi)){?>
						<tr>
							<td align="center"><?php echo $no++; ?></td>
							<td><?php echo $data['kd_ajar']; ?></td>
							<td><?php echo $data['nama']; ?></td>
							<td><?php echo $data['nama_mk']; ?></td>
							<td align="center"><?php echo $data['lokasi']; ?></td>
							<td><?php echo $data['waktu']; ?></td>
							<td align="center">
								<a id="edit_Ajar" data-toggle="modal" data-target="#edit" data-id="<?php echo $data['kd_ajar']; ?>" data-nik="<?php echo $data['nik']; ?>" data-kd_mk="<?php echo $data['kd_mk']; ?>" data-kd_kelas="<?php echo $data['kd_kelas']; ?>" data-waktu="<?php echo $data['waktu']; ?>">
								<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
								<a href="?page=Ajar&act=del&kd_ajar=<?php echo $data['kd_ajar']; ?>" onclick="return confirm('Yakin menghapus data ini?')">
								<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
								</a>
							</td>
						</tr>
					<?php } ?>
			</table>
		</div>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
		<!-- Tambah data -->
		<div id="tambah" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Tambah Data Jadwal</h4>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="kd_ajar">Kode Ajar</label>
								<input type="text" name="kd_ajar" class="form-control" id="kd_ajar" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="nik">NIK</label>
								<input type="text" name="nik" class="form-control" id="nik" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="kd_mk">Kode Matkul</label>
								<input type="text" name="kd_mk" class="form-control" id="kd_mk" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="kd_kelas">Kode Kelas</label>
								<input type="text" name="kd_kelas" class="form-control" id="kd_kelas" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="waktu">Waktu</label>
								<select name="waktu" class="form-control" id="waktu" required>
									<option value="07:00 - 12.30">07:00 - 12.30</option>
									<option value="12:30 - 16.30">12:30 - 16.30</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-denger">Reset</button>
							<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
						</div>
						
						<!-- proses tambah data -->
					</form>
					<?php
					if(@$_POST['tambah']){
						$kd_ajar = $_POST['kd_ajar'];
						$nik = $_POST['nik'];
						$kd_mk = $_POST['kd_mk'];
						$kd_kelas = $_POST['kd_kelas'];
						$waktu = $_POST['waktu'];
						mysqli_query($connect, "INSERT INTO tb_ajar (kd_ajar, nik, kd_mk,kd_kelas,waktu) VALUES ('$kd_ajar','$nik','$kd_mk','$kd_kelas','$waktu')");
						 echo "<script>window.location='?page=Ajar';</script>";
					}
					?>
				</div>
			</div>
		</div>

		<div id="edit" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Jadwal</h4>
					</div>
					<form id="form" enctype="multipart/form-data">
						<div class="modal-body" id="modal-edit">
							<div class="form-group">
								<label class="control-label" for="nik">nik</label>
								<input type="hidden" id="kd_ajar" name="kd_ajar">
								<input type="text" name="nik" class="form-control" id="nik" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="kd_mk">kd_mk</label>
								<input type="text" name="kd_mk" class="form-control" id="kd_mk" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="kd_kelas">kd_kelas</label>
								<input type="text" name="kd_kelas" class="form-control" id="kd_kelas" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="waktu">Waktu</label>
								<select name="waktu" class="form-control" id="waktu" required>
									<option value="07:00 - 12.30">07:00 - 12.30</option>
									<option value="12:30 - 16.30">12:30 - 16.30</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-success" name="edit" value="Simpan">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery-1.10.2.js"></script>
		<script type="text/javascript">
			$(document).on("click", "#edit_Ajar", function(){
				var kodeAjar = $(this).data('id');
				var nikAjar = $(this).data('nik');
				var kd_mkAjar = $(this).data('kd_mk');
				var kd_kelasAjar = $(this).data('kd_kelas');
				var jamtugasAjar = $(this).data('waktu');
				$("#modal-edit #kd_ajar").val(kodeAjar);
				$("#modal-edit #nik").val(nikAjar);
				$("#modal-edit #kd_mk").val(kd_mkAjar);
				$("#modal-edit #kd_kelas").val(kd_kelasAjar);
				$("#modal-edit #waktu").val(jamtugasAjar);
			})
			// Proses Edit
			$(document).ready(function(e){
				$("#form").on("submit", function(e){
					e.preventDefault();
					$.ajax({
						url : 'models/proses_edit_Ajar.php',
						type : 'POST',
						data : new FormData(this),
						contentType : false,
						cache : false,
						processData : false,
						success : function(msg){
							$('.table').html(msg);
						}
					});
				});
			})
		</script>
	</div>
</div>

<?php 
}else if(@$_GET['act'] == del){
	$kd_ajar = $_GET['kd_ajar'];
	mysqli_query($connect, "DELETE FROM tb_ajar WHERE kd_ajar='$kd_ajar'");
	header('location: ?page=Ajar');
}
 ?>