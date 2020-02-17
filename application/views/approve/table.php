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
                           <li><a  href="<?php echo base_url('/Pajak_ctrl/menu/approvehome'); ?>">Home</a></li>
                            <li><a class="menu-top-active" href="<?php echo base_url('/Pajak_ctrl/menu/approvetable'); ?>">Approve</a></li>
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
                                            <th>No</th>
                                            <th>No_KTP</th>
                                            <th>Scan_STNK</th>
                                            <th>Scan_KTP</th>
											<th>Scan_No_Rangka</th>
											<th>Approve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1 ;foreach ($pengajuan as $row){?>
                                        <tr> 
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $row['No_KTP'];?></td>
                                            <td><a href="<?php echo base_url('/Pajak_ctrl/download/'.$row['Scan_STNK']);?>"><?php echo $row['Scan_STNK'];?></a></td>
                                            <td><a href="<?php echo base_url('/Pajak_ctrl/download/'.$row['Scan_KTP']);?>"><?php echo $row['Scan_KTP'];?></a></td>
											<td><a href="<?php echo base_url('/Pajak_ctrl/download/'.$row['Scan_No_Rangka']);?>"><?php echo $row['Scan_No_Rangka'];?></a></td>
											<td>
											<a href="<?php echo base_url('/Pajak_ctrl/approve/'.$row['id_pengajuan']);?>"><button type="button" class="btn btn-info">Approve</button></a>
											<a href="<?php echo base_url('/Pajak_ctrl/reject/'.$row['id_pengajuan']);?>"><button type="button" class="btn btn-danger">Reject</button></a>
											</td>
                                        </tr>
                                       <?php $i++;}?>
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
