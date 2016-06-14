<?php
//<td style="text-align:right; float:right;" rowspan="4"><img src="../../images/logo.png" /></td>

$html_var = <<<EOD
<br /><br />
<table>
<tr><td width="200px"><b>Customer:</b></td><td width="200px">$project</td></tr>
<tr><td><b>Type:</b></td><td>$sub_project</td></tr>			
<tr><td><b>CSR:</b></td><td>$fullname</td></tr>
<tr><td><b>Date/Time:</b></td><td>$timestamp</td></tr>
</table>
<br />
<br />

<table>

<tr><td bgcolor="#E5E5E5"><b>Name</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_name</td></tr>

</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Address</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_address</td></tr>

</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>City/Zip Code</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_city</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Job Location</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_job</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Email</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_email</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Cell Phone</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_cell_phone</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Home Phone</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_home_phone</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Salesperson</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_salesperson</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Appointment Date</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_appointment_date</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Appointment Time</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_appointment_time</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Referred By</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_referred_by</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Interested in Quote on</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_quote</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Special Instructions</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_instruction</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Complaint About</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_complaint</td></tr>
</table><br />
</td></tr>
<tr></tr>

<tr><td bgcolor="#E5E5E5"><b>Notes</b><br /></td></tr>
<tr><td>
<table>
<tr><td width="250px" bgcolor="#F5F5F5">$cust_notes</td></tr>
</table><br />
</td></tr>
<tr></tr>
		
</table>
EOD;

echo $html_var;

?>