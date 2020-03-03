<?php 
include "../../config/koneksi.php";

if(@$_GET['act'] == ''){
?>
<div class="row">
    <div class="col-lg-12">
         <h1>Buku <small>Data Buku</small></h1>
         <ol class="breadcrumb">
             <li><a href="index.html"><i class="icon-dashboard"></i> Buku</a></li>
      	</ol>
	</div>
</div>

<!-- tampilkan data buku -->
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<th>No</th>
					<th>Kode Buku</th>
					<th>Judul</th>
					<th>Penulis</th>
					<th>Penerbit</th>
					<th>Tahun Terbit</th>
					<th>Opsi</th>
				</tr>
				<?php 
					$koneksi = mysqli_query($connect,"SELECT * FROM tb_buku");
					$no = 1;
					foreach ($koneksi as $data){
				?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data['kode_buku']; ?></td>
					<td><?php echo $data['judul']; ?></td>
					<td><?php echo $data['penulis']; ?></td>
					<td><?php echo $data['penerbit']; ?></td>
					<td align="center"><?php echo $data['tahun_terbit']; ?></td>
					<td align="center">
						<a id="edit_buku" data-toggle="modal" data-target="#edit" data-id="<?php echo $data['kode_buku']; ?>" data-judul="<?php echo $data['judul']; ?>" data-penulis="<?php echo $data['penulis']; ?>" data-penerbit="<?php echo $data['penerbit']; ?>" data-tahun_terbit="<?php echo $data['tahun_terbit']; ?>">
						<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
						<a href="?page=buku&act=del&kode_buku=<?php echo $data['kode_buku']; ?>" onclick="return confirm('Yakin menghapus data ini?')">
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
						<h4 class="modal-title">Tambah Data Buku</h4>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="kode_buku">Kode Buku</label>
								<input type="text" name="kode_buku" class="form-control" id="kode_buku" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="judul">judul</label>
								<input type="text" name="judul" class="form-control" id="judul" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="penulis">penulis</label>
								<input type="text" name="penulis" class="form-control" id="penulis" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="penerbit">Penerbit</label>
								<input type="text" name="penerbit" class="form-control" id="penerbit" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="tahun_terbit">Tahun Terbit</label>
								<input type="text" name="tahun_terbit" class="form-control" id="tahun_terbit" required>
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
						$kode_buku = $_POST['kode_buku'];
						$judul = $_POST['judul'];
						$penulis = $_POST['penulis'];
						$penerbit = $_POST['penerbit'];
						$tahun_terbit = $_POST['tahun_terbit'];
						mysqli_query($connect, "INSERT INTO tb_buku (kode_buku, judul, penulis,penerbit,tahun_terbit) VALUES ('$kode_buku','$judul','$penulis','$penerbit','$tahun_terbit')");
						 echo "<script>window.location='?page=buku';</script>";
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
						<h4 class="modal-title">Edit Data Buku</h4>
					</div>
					<form id="form" enctype="multipart/form-data">
						<div class="modal-body" id="modal-edit">
							<div class="form-group">
								<label class="control-label" for="judul">judul</label>
								<input type="hidden" id="kode_buku" name="kode_buku">
								<input type="text" name="judul" class="form-control" id="judul" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="penulis">penulis</label>
								<input type="text" name="penulis" class="form-control" id="penulis" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="penerbit">Penerbit</label>
								<input type="text" name="penerbit" class="form-control" id="penerbit" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="tahun_terbit">Tahun Terbit</label>
								<input type="text" name="tahun_terbit" class="form-control" id="tahun_terbit" required>
							</div>
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-success" name="edit" value="Simpan">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="../../assets/js/jquery-1.10.2.js"></script>
		<script type="text/javascript">
			$(document).on("click", "#edit_buku", function(){
				var kodebuku = $(this).data('id');
				var judulbuku = $(this).data('judul');
				var penulisbuku = $(this).data('penulis');
				var penerbitbuku = $(this).data('penerbit');
				var tahuterbitbuku = $(this).data('tahun_terbit');
				$("#modal-edit #kode_buku").val(kodebuku);
				$("#modal-edit #judul").val(judulbuku);
				$("#modal-edit #penulis").val(penulisbuku);
				$("#modal-edit #penerbit").val(penerbitbuku);
				$("#modal-edit #tahun_terbit").val(tahuterbitbuku);
			})
			// Proses Edit
			$(document).ready(function(e){
				$("#form").on("submit", function(e){
					e.preventDefault();
					$.ajax({
						url : '../../models/proses_edit_buku.php',
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
	$kode_buku = $_GET['kode_buku'];
	mysqli_query($connect, "DELETE FROM tb_buku WHERE kode_buku='$kode_buku'");
	header('location: ?page=buku');
}
 ?>