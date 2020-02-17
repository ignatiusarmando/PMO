<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Perpanjangan STNK Online</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="<?php echo base_url('/assets/css/bootstrap.css'); ?>" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="<?php echo base_url('/assets/css/font-awesome.css'); ?>" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Support: </strong>+021345543
					<a href="<?php echo base_url('/Pajak_ctrl/logout'); ?>" class="btn btn-danger btn-sm">Logout</a>
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <img src="<?php echo base_url('/assets/img/logo.png'); ?>" />

            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                           <li><a  href="<?php echo base_url('/Pajak_ctrl/menu/cshome'); ?>">Home</a></li>
                            <li><a class="menu-top-active" href="<?php echo base_url('/Pajak_ctrl/menu/cscari'); ?>">Cari</a></li>
                            <li><a href="<?php echo base_url('/Pajak_ctrl/menu/csupload'); ?>">Upload</a></li>
							<li><a href="<?php echo base_url('/Pajak_ctrl/menu/cscetak'); ?>">Cetak Dokumen dan STNK</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Data Tables</h1>
                    </div>
                </div>
                <div class="table">
                <div class="col-md">
                  <!--   Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Masukkan nomor STNK atau nomor KTP dibawah
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
							 <input type="text" class="form-control search" placeholder="search"/>
                                <table class="table table-striped table-bordered table-hover" id="userTbl">
								<br>
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>No KTP</th>
                                            <th>No Kendaraan</th>
                                            <th>Total tagihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($user as $row){?>
                                        <tr>
                                            <td><?php echo $row['Nama'];?></td>
                                            <td><?php echo $row['No_KTP'];?></td>
                                            <td><?php echo $row['No_Kendaraan'];?></td>
                                            <td><?php echo $row['totaltagihan'];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!-- End  Table -->
                </div>
            </div>
                
                </div>
            </div>

        
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2019
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="<?php echo base_url('/assets/js/jquery-1.11.1.js'); ?>"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url('/assets/js/bootstrap.js'); ?>"></script>
	<script>
	$(document).ready(function(){
	 $('.search').on('keyup',function(){
	  var searchTerm = $(this).val().toLowerCase();
	  $('#userTbl tbody tr').each(function(){
	   var lineStr = $(this).text().toLowerCase();
	   if(lineStr.indexOf(searchTerm) === -1){
	    $(this).hide();
		}else{
		 $(this).show();
		 }
	  });
	 });
	});
	</script>
	
</body>
</html>
