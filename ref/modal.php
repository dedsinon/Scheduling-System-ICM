<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
 
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          
          <form method="POST" action="server/p_update_useraccount.php">

                        <div hidden> <input type="number" name="update_user_id" class="form-control" value="<?php echo $info_result['user_id']; ?>" readonly>
                        </div>

                        <div class="form-group col-md-12">
                          <div class="input-group"> 
                            <span class="input-group-addon">
                             <span class="glyphicon glyphicon-user"> 
                                <label style="width: 70px;">Firstname:
                                </label>
                              </span>
                            </span>
                            <input type="text" name="update_firstname" class="form-control" placeholder="First Name" value="<?php echo $info_result['user_fname']; ?>" required>
                          </div>
                        </div>


          








        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>
