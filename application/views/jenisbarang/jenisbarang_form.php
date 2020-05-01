<section class="content-header">
      <h1>
      SMA Negeri 1 Bandung
        <small>SMANSA BERSATU "BERiman, Santun, Agamis, Tekun Unggul" </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Jenis Barang</a></li>
        <li class="active"><?php echo $button ?> Jenis Barang</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
			<!-- Form input dan edit Jenis Barang -->
			<legend><?php echo $button ?> Jenis Barang</legend>	   
			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="varchar">Kode Jenis <?php echo form_error('kodejenis') ?></label>
					<input type="text" class="form-control" name="kodejenis" id="kodejenis" placeholder="Kode Jenis" value="<?php echo $kodejenis; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Nama Jenis <?php echo form_error('namajenis') ?></label>
					<input type="text" class="form-control" name="namajenis" id="namajenis" placeholder="Nama Jenis" value="<?php echo $namajenis; ?>" />
				</div>
				
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
				<a href="<?php echo site_url('jenisbarang') ?>" class="btn btn-default">Cancel</a>
			</form>  
			<!--// Form Jenis Barang-->