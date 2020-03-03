<?php 
include "config/koneksi.php";

if(@$_GET['act'] == ''){
?>


<div class="row">
    <div class="col-lg-12">
         <h1>matkul <small>Data matkul</small></h1>
         <ol class="breadcrumb">
             <li><a href="index.html"><i class="icon-dashboard"></i> matkul</a></li>
      	</ol>
	</div>
</div><!-- /.row -->

<!-- tampilkan data matkul -->
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<th>No</th>
					<th>Kode Makul</th>
					<th>Matkul</th>
					<th>SKS</th>
					<th>Opsi</th>
				</tr>
				<?php 
					$koneksi = mysqli_query($connect,"SELECT * FROM tb_matkul");
					$no = 1;
					foreach ($koneksi as $data){
				?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data['kd_mk']; ?></td>
					<td><?php echo $data['nama_mk']; ?></td>
					<td><?php echo $data['sks']; ?></td>
					<td align="center">
						<a id="edit_matkul" data-toggle="modal" data-target="#edit" data-id="<?php echo $data['kd_mk']; ?>" data-nama_mk="<?php echo $data['nama_mk']; ?>" data-sks="<?php echo $data['sks']; ?>">
						<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
						<a href="?page=MataKuliah&act=del&kd_mk=<?php echo $data['kd_mk']; ?>" onclick="return confirm('Yakin menghapus data ini?')">
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
						<h4 class="modal-title">Tambah Data matkul</h4>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="kd_mk">ID</label>
								<input type="text" name="kd_mk" class="form-control" id="kd_mk" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="nama_mk">nama_mk</label>
								<input type="text" name="nama_mk" class="form-control" id="nama_mk" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="sks">sks</label>
								<input type="text" name="sks" class="form-control" id="sks" required>
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
						$kd_mk = $_POST['kd_mk'];
						$nama_mk = $_POST['nama_mk'];
						$sks = $_POST['sks'];
						mysqli_query($connect, "INSERT INTO tb_matkul (kd_mk, nama_mk, sks) VALUES ('$kd_mk','$nama_mk','$sks')");
						 echo "<script>window.location='?page=MataKuliah';</script>";
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
						<h4 class="modal-title">Edit Data matkul</h4>
					</div>
					<form id="form" enctype="multipart/form-data">
						<div class="modal-body" id="modal-edit">
							<div class="form-group">
								<label class="control-label" for="nama_mk">nama_mk</label>
								<input type="hidden" id="kd_mk" name="kd_mk">
								<input type="text" name="nama_mk" class="form-control" id="nama_mk" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="sks">sks</label>
								<input type="text" name="sks" class="form-control" id="sks" required>
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
			$(document).on("click", "#edit_matkul", function(){
				var kodematkul = $(this).data('id');
				var nama_mkmatkul = $(this).data('nama_mk');
				var sksmatkul = $(this).data('sks');
				$("#modal-edit #kd_mk").val(kodematkul);
				$("#modal-edit #nama_mk").val(nama_mkmatkul);
				$("#modal-edit #sks").val(sksmatkul);
			})
			// Proses Edit
			$(document).ready(function(e){
				$("#form").on("submit", function(e){
					e.preventDefault();
					$.ajax({
						url : 'models/proses_edit_matkul.php',
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
	$kd_mk = $_GET['kd_mk'];
	mysqli_query($connect, "DELETE FROM tb_matkul WHERE kd_mk='$kd_mk'");
	header('location: ?page=MataKuliah');
}
 ?>