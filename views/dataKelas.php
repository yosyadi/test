<?php 
include "config/koneksi.php";

if(@$_GET['act'] == ''){
?>
<div class="row">
    <div class="col-lg-12">
         <h1>Kelas <small>Data Kelas</small></h1>
         <ol class="breadcrumb">
             <li><a href="index.html"><i class="icon-dashboard"></i> Kelas</a></li>
      	</ol>
	</div>
</div>

<!-- tampilkan data Kelas -->
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<th>No</th>
					<th>Kode Kelas</th>
					<th>Lokasi</th>
					<th>Kapasitas</th>
					<th>Opsi</th>
				</tr>
				<?php 
					$koneksi = mysqli_query($connect,"SELECT * FROM tb_kelas");
					$no = 1;
					foreach ($koneksi as $data){
				?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data['kd_kelas']; ?></td>
					<td><?php echo $data['lokasi']; ?></td>
					<td><?php echo $data['kapasitas']; ?></td>>
					<td align="center">
						<a id="edit_Kelas" data-toggle="modal" data-target="#edit" data-id="<?php echo $data['kd_kelas']; ?>" data-lokasi="<?php echo $data['lokasi']; ?>" data-kapasitas="<?php echo $data['kapasitas']; ?>">
						<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
						<a href="?page=Kelas&act=del&kd_kelas=<?php echo $data['kd_kelas']; ?>" onclick="return confirm('Yakin menghapus data ini?')">
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
						<h4 class="modal-title">Tambah Data Kelas</h4>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="kd_kelas">Kode Kelas</label>
								<input type="text" name="kd_kelas" class="form-control" id="kd_kelas" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="lokasi">lokasi</label>
								<input type="text" name="lokasi" class="form-control" id="lokasi" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="kapasitas">kapasitas</label>
								<input type="text" name="kapasitas" class="form-control" id="kapasitas" required>
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
						$kd_kelas = $_POST['kd_kelas'];
						$lokasi = $_POST['lokasi'];
						$kapasitas = $_POST['kapasitas'];
						mysqli_query($connect, "INSERT INTO tb_kelas (kd_kelas, lokasi, kapasitas) VALUES ('$kd_kelas','$lokasi','$kapasitas')");
						 echo "<script>window.location='?page=Kelas';</script>";
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
						<h4 class="modal-title">Edit Data Kelas</h4>
					</div>
					<form id="form" enctype="multipart/form-data">
						<div class="modal-body" id="modal-edit">
							<div class="form-group">
								<label class="control-label" for="lokasi">lokasi</label>
								<input type="hidden" id="kd_kelas" name="kd_kelas">
								<input type="text" name="lokasi" class="form-control" id="lokasi" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="kapasitas">kapasitas</label>
								<input type="text" name="kapasitas" class="form-control" id="kapasitas" required>
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
			$(document).on("click", "#edit_Kelas", function(){
				var kodeKelas = $(this).data('id');
				var lokasiKelas = $(this).data('lokasi');
				var kapasitasKelas = $(this).data('kapasitas');
				$("#modal-edit #kd_kelas").val(kodeKelas);
				$("#modal-edit #lokasi").val(lokasiKelas);
				$("#modal-edit #kapasitas").val(kapasitasKelas);
			})
			// Proses Edit
			$(document).ready(function(e){
				$("#form").on("submit", function(e){
					e.preventDefault();
					$.ajax({
						url : 'models/proses_edit_kelas.php',
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
	$kd_kelas = $_GET['kd_kelas'];
	mysqli_query($connect, "DELETE FROM tb_kelas WHERE kd_kelas='$kd_kelas'");
	header('location: ?page=Kelas');
}
 ?>