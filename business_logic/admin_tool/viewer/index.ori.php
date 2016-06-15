<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
include($doc_root.'/admin/viewer/get_log_data.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>NHRDA Access Log Viewer</title>
	<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="examples/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="examples/resources/demo.css">
	<style type="text/css" class="init">

	</style>
	<script type="text/javascript" language="javascript" src="filter_functions.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="examples/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="examples/resources/demo.js"></script>
	<script type="text/javascript" src="/media/js/site.js?_=c15b4a384d5ae52f7f3a5cc40ffe0394"></script>
	<script type="text/javascript" src="/media/js/dynamic.php?comments-page=examples%2Fplug-ins%2Frange_filtering.html" async=""></script>
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" class="init">

/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min_status').val(), 10 );
        var max = parseInt( $('#max_status').val(), 10 );
        var age = parseFloat( data[3] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min_size').val(), 10 );
        var max = parseInt( $('#max_size').val(), 10 );
        var age = parseFloat( data[4] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min_time').val(), 10 );
        var max = parseInt( $('#max_time').val(), 10 );
        var age = parseFloat( data[0] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {		
        var client_request_string = data[2];
		
		if ( ($('#ignore_cr').val().length == 0) && ($('#include_cr').val().length == 0) )
		{
			return true;
		}
        
		var ignore_str_flag = -2;
		var include_str_flag = -2;
		
		if ( $('#ignore_cr').val().length >= 3 )
		{
			ignore_str_flag = client_request_string.indexOf($('#ignore_cr').val());
		}
		if ( $('#include_cr').val().length >= 3 )
		{
			include_str_flag = client_request_string.indexOf($('#include_cr').val());
		}
		
		if ( ( ignore_str_flag == -2 ) && ( include_str_flag == -2 ) )
		{
			return true;
		}
		else if ( ( ignore_str_flag == -2 ) && ( include_str_flag >= -1 ) )
		{
			if ( include_str_flag == -1 )
				return false;
			else
				return true;
		}
		else if ( ( ignore_str_flag >= -1 ) && ( include_str_flag == -2 ) )
		{
			if ( ignore_str_flag == -1 )
				return true;
			else
				return false;
		}
		else
		{
			if ( ( ignore_str_flag == -1 ) && ( include_str_flag > -1 ) )
				return true;
		}

        return false;
    }
);

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {		
        var client_request_string = data[5];
		
		if ( ($('#ignore_referrer').val().length == 0) && ($('#include_referrer').val().length == 0) )
		{
			return true;
		}
        
		var ignore_str_flag = -2;
		var include_str_flag = -2;
		
		if ( $('#ignore_referrer').val().length > 0 )
		{
			ignore_str_flag = client_request_string.indexOf($('#ignore_referrer').val());
		}
		if ( $('#include_referrer').val().length > 0 )
		{
			include_str_flag = client_request_string.indexOf($('#include_referrer').val());
		}
		
		if ( ( ignore_str_flag == -2 ) && ( include_str_flag == -2 ) )
		{
			return true;
		}
		else if ( ( ignore_str_flag == -2 ) && ( include_str_flag >= -1 ) )
		{
			if ( include_str_flag == -1 )
				return false;
			else
				return true;
		}
		else if ( ( ignore_str_flag >= -1 ) && ( include_str_flag == -2 ) )
		{
			if ( ignore_str_flag == -1 )
				return true;
			else
				return false;
		}
		else
		{
			if ( ( ignore_str_flag == -1 ) && ( include_str_flag > -1 ) )
				return true;
		}

        return false;
    }
);

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {		
        var client_request_string = data[1];
		
		if ( ($('#ignore_ip').val().length == 0) && ($('#include_ip').val().length == 0) )
		{
			return true;
		}
        
		var ignore_str_flag = -2;
		var include_str_flag = -2;
		
		if ( $('#ignore_ip').val().length > 0 )
		{
			ignore_str_flag = client_request_string.indexOf($('#ignore_ip').val());
		}
		if ( $('#include_ip').val().length > 0 )
		{
			include_str_flag = client_request_string.indexOf($('#include_ip').val());
		}
		
		if ( ( ignore_str_flag == -2 ) && ( include_str_flag == -2 ) )
		{
			return true;
		}
		else if ( ( ignore_str_flag == -2 ) && ( include_str_flag >= -1 ) )
		{
			if ( include_str_flag == -1 )
				return false;
			else
				return true;
		}
		else if ( ( ignore_str_flag >= -1 ) && ( include_str_flag == -2 ) )
		{
			if ( ignore_str_flag == -1 )
				return true;
			else
				return false;
		}
		else
		{
			if ( ( ignore_str_flag == -1 ) && ( include_str_flag > -1 ) )
				return true;
		}

        return false;
    }
);

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {		
        var client_request_string = data[6];
		
		if ( ($('#ignore_ua').val().length == 0) && ($('#include_ua').val().length == 0) )
		{
			return true;
		}
        
		var ignore_str_flag = -2;
		var include_str_flag = -2;
		
		if ( $('#ignore_ua').val().length > 0 )
		{
			ignore_str_flag = client_request_string.indexOf($('#ignore_ua').val());
		}
		if ( $('#include_ua').val().length > 0 )
		{
			include_str_flag = client_request_string.indexOf($('#include_ua').val());
		}
		
		if ( ( ignore_str_flag == -2 ) && ( include_str_flag == -2 ) )
		{
			return true;
		}
		else if ( ( ignore_str_flag == -2 ) && ( include_str_flag >= -1 ) )
		{
			if ( include_str_flag == -1 )
				return false;
			else
				return true;
		}
		else if ( ( ignore_str_flag >= -1 ) && ( include_str_flag == -2 ) )
		{
			if ( ignore_str_flag == -1 )
				return true;
			else
				return false;
		}
		else
		{
			if ( ( ignore_str_flag == -1 ) && ( include_str_flag > -1 ) )
				return true;
		}

        return false;
    }
);
	
$(document).ready(function() {
	$('#example').dataTable( {
		"ajax": "arrays.txt",
		"deferRender": true,
		"order": [[ 0, "desc" ]],
		//"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
		"aoColumns": [
			{ "orderSequence": [ "desc", "asc" ] },
            null,
            null,
            null,
            null,
            null,
			null
        ]
	} );
	
	var table = $('#example').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min_status, #max_status').keyup( function() {
        table.draw();
    } );
    $('#min_size, #max_size').keyup( function() {
        table.draw();
    } );
    $('#min_time, #max_time').keyup( function() {
        table.draw();
    } );
    $('#ignore_cr, #include_cr').keyup( function() {
        table.draw();
    } );
    $('#ignore_referrer, #include_referrer').keyup( function() {
        table.draw();
    } );
    $('#ignore_ip, #include_ip').keyup( function() {
        table.draw();
    } );
    $('#ignore_ua, #include_ua').keyup( function() {
        table.draw();
    } );
	
	$('#showmenu').click(function() {
        $('.menu').slideToggle("fast");
    });
} );

// shows the slickbox DIV on clicking the link with an ID of "slick-show"
  $('#slick-show').click(function() {
    $('#slickbox').show('slow');
    return false;
  });
	</script>
</head>

<body class="dt-example">
	<div class="container">
		<section>
			<h1>Apache Access Log Viewer<span style="margin-left:20px">(last <?php echo $num_of_lines_db ?> lines from the log)</span></h1>

			<div class="info">
				<p>This tool analyses the last x number of lines from the server Apache access log file.</p>

				<p>Using a cron job, the apache access log is copied to an accessible location (under .htaccess protection). This file is then parsed using PHP and the Bash command line tool 'tail' 
				(so as to avoid trying to load the entire file, which is very large). The cron job to copy the apache file is run every 30 mins, so the data has at most 30 mins lag time.
				</p>

				<p>Note that the table below is both capable of being ordered via any column and also searchable.</p>
			</div>

			<div id="showmenu" style="margin-bottom:20px;margin-top:10px; float:right;font-weight:bold;cursor: pointer;">[Click Here To Toggle Filter]</div><br /><br />
			<div class="menu" style="display:none;width:100%;height:100px;margin-bottom:20px;margin-top:10px;">
				<div>
					<fieldset style="float:left;clear:right;">
                    <legend>Log Duration</legend>
						<table border="0" cellspacing="3" cellpadding="3" style="float:left;">
							<tbody>
								<tr>
									<td>Lines:</td>
									<td>
									<select style="width:65px;" id="line_section" onchange="set_number_lines();">
										<option value=""></option>
										<option value="1000">1,000</option>
										<option value="1000">2,000</option>
										<option value="5000">5,000</option>
										<option value="10000">10,000</option>
										<option value="20000">20,000</option>
										<option value="30000">30,000</option>
									</select></td>
								</tr>
								<tr>
									<td>Hours:</td>
									<td><input type="text" id="hour_section" name="hour_section" maxlength="10" size="4" onchange="set_number_lines();"></td>
								</tr>
							</tbody>
						</table>
					</fieldset><br /><br />
					<fieldset style="float:left;clear:left">
                    <legend>Timestamp</legend>
						<table border="0" cellspacing="3" cellpadding="3" style="float:left;">
							<tbody>
								<tr>
									<td>Min:</td>
									<td><input type="text" id="min_time" name="min_time" maxlength="10" size="4"></td>
								</tr>
								<tr>
									<td>Max:</td>
									<td><input type="text" id="max_time" name="max_time" maxlength="10" size="4"></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					
					<fieldset style="float:left;">
                    <legend>IP</legend>
						<table border="0" cellspacing="3" cellpadding="3" style="float:left;">
							<tbody>
								<tr>
									<td>Ignore:</td>
									<td><input type="text" id="ignore_ip" name="ignore_ip" maxlength="50" size="10"></td>
								</tr>
								<tr>
									<td>Include:</td>
									<td><input type="text" id="include_ip" name="include_ip" maxlength="50" size="10"></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					
					<fieldset style="float:left;">
                    <legend>Client Request</legend>
						<table border="0" cellspacing="3" cellpadding="3" style="float:left;">
							<tbody>
								<tr>
									<td>Ignore:</td>
									<td><input type="text" id="ignore_cr" name="ignore_cr" maxlength="50" size="10"></td>
								</tr>
								<tr>
									<td>Include:</td>
									<td><input type="text" id="include_cr" name="include_cr" maxlength="50" size="10"></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					
					<fieldset style="float:left;">
                    <legend>Status</legend>
						<table border="0" cellspacing="3" cellpadding="3" style="float:left;">
							<tbody>
								<tr>
									<td>Min:</td>
									<td><input type="text" id="min_status" name="min_status" maxlength="3" size="2"></td>
								</tr>
								<tr>
									<td>Max:</td>
									<td><input type="text" id="max_status" name="max_status" maxlength="3" size="2"></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					
					<fieldset style="float:left;">
                    <legend>Size</legend>
						<table border="0" cellspacing="3" cellpadding="3" style="float:left;">
							<tbody>
								<tr>
									<td>Min:</td>
									<td><input type="text" id="min_size" name="min_size" maxlength="10" size="3"></td>
								</tr>
								<tr>
									<td>Max:</td>
									<td><input type="text" id="max_size" name="max_size" maxlength="10" size="3"></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					
					<fieldset style="float:left;">
                    <legend>Referrer</legend>
						<table border="0" cellspacing="3" cellpadding="3" style="float:left;">
							<tbody>
								<tr>
									<td>Ignore:</td>
									<td><input type="text" id="ignore_referrer" name="ignore_referrer" maxlength="50" size="10"></td>
								</tr>
								<tr>
									<td>Include:</td>
									<td><input type="text" id="include_referrer" name="include_referrer" maxlength="50" size="10"></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					
					<fieldset style="float:left;">
                    <legend>User Agent</legend>
						<table border="0" cellspacing="3" cellpadding="3" style="float:left;">
							<tbody>
								<tr>
									<td>Ignore:</td>
									<td><input type="text" id="ignore_ua" name="ignore_ua" maxlength="50" size="10"></td>
								</tr>
								<tr>
									<td>Include:</td>
									<td><input type="text" id="include_ua" name="include_ua" maxlength="50" size="10"></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
				</div>
			</div>
			<br /><br />
			
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Timestamp</th>
						<th>IP</th>
						<th>Client Request Line</th>
						<th>Status</th>
						<th>Size</th>
						<th>Referrer</th>
						<th>User Agent</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th>Timestamp</th>
						<th>IP</th>
						<th>Client Request Line</th>
						<th>Status</th>
						<th>Size</th>
						<th>Referrer</th>
						<th>User Agent</th>
					</tr>
				</tfoot>
			</table>
			<br /><br /><br /><br />
			<ul class="tabs">
				<li class="active">How To</li>
				<li>What Next</li>
				<li>Resources</li>
			</ul>

			<div class="tabs">
				<div class="js">
					<p>The Javascript shown below is used to initialise the table shown in this example:</p>

					<p>In addition to the above code, the following Javascript library files are loaded for use in this example:</p>

					<ul>
						<li><a href="../../media/js/jquery.js">../../media/js/jquery.js</a></li>
						<li><a href="../../media/js/jquery.dataTables.js">../../media/js/jquery.dataTables.js</a></li>
					</ul>
				</div>

				<div class="table">
					<p>The HTML shown below is the raw HTML table element, before it has been enhanced by DataTables:</p>
				</div>

				<div class="css">
					<div>
						<p>This example uses a little bit of additional CSS beyond what is loaded from the library files (below), in order to correctly display the table. The
						additional CSS used is shown below:</p><code class="multiline language-css"></code>
					</div>

					<p>The following CSS library files are loaded for use in this example to provide the styling of the table:</p>

					<ul>
						<li><a href="../../media/css/jquery.dataTables.css">../../media/css/jquery.dataTables.css</a></li>
					</ul>
				</div>
			</div>
		</section>
	</div>

	<section>
		<div class="footer">
			<div class="gradient"></div>

			</div>
		</div>
	</section>
</body>
</html>