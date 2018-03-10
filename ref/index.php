 body {
    background-image: url("images/bg4.jpg");
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-clip: border-box;
    background-size: cover;
  } 

  #box{
    border: 1px solid;
    margin-top: 40px;
    margin-left: 50px;
    margin-right: 50px;
    margin-bottom: 20px;
    height: 440px;
    border-radius: 30px;
  }

form input:focus { 
  background-color: black;
  color: white;
 }

  #panelhead{
    background-color: black;
    border-top-right-radius: 30px;
    border-top-left-radius: 30px;
  }

#login{
  font-family: georgia Extrabold;
}

#Submit{
  background-color: white;
  color: black;
  border: 2px solid black;  
  font-family: Arial bold; 
}

#Submit:focus{
  background-color: black;
  color: white;

}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
        <meta http-equiv="X-AU-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
			
    <!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

    <!-- JQuery -->
		<script type="text/javascript" src="../bootstrap/jquery-3.1.1.min.js"></script>

    <!--  JavaScript -->
		 <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/sb-admin.css">

    <!-- Custom Fonts -->
    <link href="../fa/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<title>PHP and MySQL CRUD Operations Demo</title>

<!-- Bootstrap CSS File -->
<link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css" />
</head>
<style type="text/css">
 body{
 	background-color: white;
 }
</style>
<body>

<!-- Content Section -->
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>PHP and MySQL CRUD Operations</h2>
<div class="pull-right">
<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Record</button>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<h4>Records:</h4>
<div class="records_content"></div>
</div>
</div>
</div>
<!-- /Content Section -->

<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Add New Record</h4>
</div>
<div class="modal-body">

<div class="form-group">
<label for="first_name">First Name</label>
<input type="text" id="first_name" placeholder="First Name" class="form-control" />
</div>

<div class="form-group">
<label for="last_name">Last Name</label>
<input type="text" id="last_name" placeholder="Last Name" class="form-control" />
</div>

<div class="form-group">
<label for="email">Email Address</label>
<input type="text" id="email" placeholder="Email Address" class="form-control" />
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
</div>
</div>
</div>
</div>

<!-- Jquery JS file -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<!-- Bootstrap JS file -->
<script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

<!-- Custom JS file -->
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>