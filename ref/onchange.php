<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Filter</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
</head>
<body>
     <table id="table_format" class="table table-bordered table-striped table-hover table-list-search">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Married
							<select id='filterText' style='display:inline-block' onchange='filterText()'>
								<option disabled selected>Select</option>
								<option value='yes'>Yes</option>
								<option value='no'>No</option>
								<option value='all'>All</option>
							</select>
							</th>
                        </tr>
                    </thead>
                    <tbody  id="myTable">
                        <tr class="content">
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>yes</td>
                        </tr>
                        
                        <tr class="content">
                            <td>3</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>no</td>
                        </tr>
                        <tr class="content">
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>yes</td>
                        </tr>
                        <tr class="content">
                            <td>2</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>no</td>
                        </tr>
                        <tr class="content">
                            <td>3</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>no</td>
                        </tr>
                    </tbody>
                </table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>
function filterText()
	{  
		var rex = new RegExp($('#filterText').val());
		if(rex =="/all/"){clearFilter()}else{
			$('.content').hide();
			$('.content').filter(function() {
			return rex.test($(this).text());
			}).show();
	}
	}
	
function clearFilter()
	{
		$('.filterText').val('');
		$('.content').show();
	}
</script>
</body>
</html>