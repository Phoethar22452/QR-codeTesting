
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sample QR Data Center</title>
<!-- 	<link rel="icon" href="demo_icon.gif" type="image/gif" sizes="16x16">
 -->	
 	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

 	

	<table id="dtable">
    <thead>
        <tr>
            <th>col 1</th>
            <th>col 2</th>
        </tr>
    </thead>
    <tbody>
        <td>data 1</td>
        <td>data 2</td>
    </tbody>
</table>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
        var dTable = $('#dtable');
        dTable.DataTable({
            'order': [[ 0, 'desc' ]],
            'aoColumns': [
                null,
                {
                    'bSortable': false
                }
            ]
        });
</script>
	<br><br><br>
	<!-- data table plugin -->
	


</script>
</body>
</html>
