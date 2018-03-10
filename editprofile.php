 <?php 
include ("dashboard.php");
 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <title> Edit User Pofile </title>
 </head>
 
 <body>
 
 <!-- Edit Profile -->
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
            <div class="col-lg-12">
            <h2 class="page-header"><center>Edit Profile</center></h2>
            </div>
            </div> 
        </div>

                    <ol class="breadcrumb">
                            <li>
                                    <i class="fa fa-arrow-right"></i> You are here:</a>
                            </li>    
                            <li>
                                    <i class="fa fa-file"></i><a href="admin.php"> Admin Profile</a>
                            </li>
                            <li class="active">
                                    <i class="fa fa-file"></i><a href="editprofile.php"> Edit Profile</a>
                            </li>
                    </ol>

               
                
    <!-- Edit --> 
    <form class="form-signin" action="#" method="post" action="post">
    <div class="container">
    <div class="row">
    <div class="col-md-7 col-md-offset-2">
    <div class="panel panel-default">
    <div class="panel panel-primary">
        
    <h3 class="text-center"> Update </h3>
        
    <div class="panel-body">   
        
            <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text" name="firstname" class="form-control" placeholder="First Name" autofocus>
                    </div>
            </div>
                    
            <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" />
                    </div>
            </div>
            <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                            <input type="text" name="department" class="form-control" placeholder="Department" />
                    </div>
            </div>
            <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                            <input type="text" name="position" class="form-control" placeholder="Position" />
                    </div>
            </div>     
            <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="gender" class="form-control" placeholder="Gender" />
                    </div>
            </div>     
            <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="text" name="email" class="form-control" placeholder="Email" />
                    </div>
            </div> 
            <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="username" class="form-control" placeholder="Username" />
                    </div>
            </div>
            <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                    </div>
            </div>
            <button class="btn btn-lg btn-primary btn2 btn-block" value="submit" name="submitform" type="submit">Save</button>
              
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

</form>
</div> 

</body>
</html>