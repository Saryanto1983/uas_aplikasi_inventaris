<section class="content-header">
      <h1>
	  SMA Negeri 1 Bandung
        <small>SMANSA BERSATU "BERiman, Santun, Agamis, Tekun Unggul" </small>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo $back ?>">Barang</a></li>
        <li class="active"><?php echo $button ?> Barang</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
			<!-- Tampil Data Barang -->  
			<legend><?php echo $button ?> Barang</legend>
			<!-- Button untuk melakukan update -->
			<a href="<?php echo site_url('barang/update/'.$no) ?>" class="btn btn-primary">Update</a>	
			<!-- Button cancel untuk kembali ke halaman barang list -->	
			<a href="<?php echo site_url('barang') ?>" class="btn btn-warning">Cancel</a>
			<p></p>
			 <!-- Menampilkan data barang secara detail -->
			 <table class="table table-striped table-bordered">
				
				
				<tr><td>Kode Barang</td><td><?php echo $kodebarang; ?></td></tr>
				<tr><td>Nama Barang</td><td><?php echo $namabarang; ?></td></tr>
				<tr><td>Kode Merk</td><td><?php echo $kodemerk; ?></td></tr>
				<tr><td>Kode Jenis</td><td><?php echo $kodejenis; ?></td></tr>
				<tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
				<tr><td>Harga</td><td><?php echo $harga; ?></td></tr>
				<tr><td>Kondisi</td><td><?php echo $kondisi; ?></td></tr>
				
			 </table>
