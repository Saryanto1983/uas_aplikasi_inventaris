<section class="content-header">
      <h1>
      SMA Negeri 1 Bandung
        <small>SMANSA BERSATU "BERiman, Santun, Agamis, Tekun Unggul" </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Merk</a></li>
        <li class="active"><?php echo $button ?> Merk</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
			<!-- Form input dan edit Merk -->
			<legend><?php echo $button ?> Merk</legend>	   
			<form action="<?php echo $action; ?>" method="post">
				<div class="form-group">
					<label for="varchar">Kode Merk <?php echo form_error('kodemerk') ?></label>
					<input type="text" class="form-control" name="kodemerk" id="kodemerk" placeholder="Kode Merk" value="<?php echo $kodemerk; ?>" />
				</div>
				<div class="form-group">
					<label for="varchar">Nama Merk <?php echo form_error('namamerk') ?></label>
					<input type="text" class="form-control" name="namamerk" id="namamerk" placeholder="Nama Merk" value="<?php echo $namamerk; ?>" />
				</div>
				
				<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
				<a href="<?php echo site_url('merk') ?>" class="btn btn-default">Cancel</a>
			</form>  
			<!--// Form Merk -->