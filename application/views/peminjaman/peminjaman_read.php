<section class="content-header">
      <h1>
	  SMA Negeri 1 Bandung
        <small>SMANSA BERSATU "BERiman, Santun, Agamis, Tekun Unggul" </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo $back ?>">Peminjaman</a></li>
        <li class="active"><?php echo $button ?> Peminjaman</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
			<!-- Tampil Data Peminjaman -->  
			<legend><?php echo $button ?> Peminjaman</legend>
			<!-- Button untuk melakukan update -->
			<a href="<?php echo site_url('peminjaman/update/'.$no) ?>" class="btn btn-primary">Update</a>	
			<!-- Button cancel untuk kembali ke halaman peminjaman list -->	
			<a href="<?php echo site_url('peminjaman') ?>" class="btn btn-warning">Cancel</a>
			<p></p>
			 <!-- Menampilkan data peminjaman secara detail -->
			 <table class="table table-striped table-bordered">
				
				
				<tr><td>Nama Peminjam</td><td><?php echo $namapeminjam; ?></td></tr>
				<tr><td>Id Peminjam</td><td><?php echo $idpeminjam; ?></td></tr>
				<tr><td>Kode Barang</td><td><?php echo $kodebarang; ?></td></tr>
				<tr><td>Tanggal Peminjaman</td><td><?php echo $tanggalpeminjaman; ?></td></tr>
				<tr><td>Kondisi Sebelum</td><td><?php echo $kondisisebelum; ?></td></tr>
				<tr><td>Kondisi Sesudah</td><td><?php echo $kondisisesudah; ?></td></tr>
				<tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
				
			 </table>
