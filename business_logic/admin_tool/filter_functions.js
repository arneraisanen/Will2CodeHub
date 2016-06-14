var xmlHttp

function GetXmlHttpObject()
{ 
	var objXMLHttp=null
	if (window.XMLHttpRequest)
	{
		objXMLHttp=new XMLHttpRequest()
	}
	else if (window.ActiveXObject)
	{
		objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
	}
	return objXMLHttp
}

function set_number_lines()
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	}
	
	line_limit = document.getElementById('line_section').value;
	hour_limit = document.getElementById('hour_section').value;

	var url = "limit_num_lines.php";
	var params = "line_limit="+line_limit+"&hour_limit="+hour_limit;
	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=set_number_lines_response;
	xmlHttp.send(params);
}


function set_number_lines_response()
{
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		window.location.reload();
	}
}