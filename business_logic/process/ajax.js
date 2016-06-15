var xmlHttp
var search_display_mode = 1;
var install_folder = '/arbco_master';
//var install_folder = '';

function get_js_version ()
{
    this.jsv = {
            versions: [
                "1.1", "1.2", "1.3", "1.4", "1.5", "1.6", "1.7", "1.8", "1.9", "2.0"
            ],
            version: ""
        };

    var d = document;

    for (i = 0; i < jsv.versions.length; i++) {
        var g = d.createElement('script'),
            s = d.getElementsByTagName('script')[0];

            g.setAttribute("language", "JavaScript" + jsv.versions[i]);
            g.text = "this.jsv.version='" + jsv.versions[i] + "';";
            s.parentNode.insertBefore(g, s);
    }

    alert("Javascript Version: "+jsv.version);
}


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

function validateEmail(email_str) 
{  
	var mailformat = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;  
	if(email_str.match(mailformat))  
	{   
		return true;  
	}  
	else  
	{   
		return false;  
	}  
}

function launchIntoFullscreen(element)
{
	  if(element.requestFullscreen) {
	    element.requestFullscreen();
	  } else if(element.mozRequestFullScreen) {
	    element.mozRequestFullScreen();
	  } else if(element.webkitRequestFullscreen) {
	    element.webkitRequestFullscreen();
	  } else if(element.msRequestFullscreen) {
	    element.msRequestFullscreen();
	  }
	  
	  document.getElementById("exit_fullscreen_item").style.display = 'block';
	  document.getElementById("enter_fullscreen_item").style.display = 'none';
	  document.getElementById("fullscreen_block_menu_hide").style.display = 'none';
	  document.getElementById("fullscreen_block").style.width = '100%';
	  document.getElementById("fullscreen_block").style.margin = 'auto';
}

function exitFullscreen()
{
	  if(document.exitFullscreen) {
	    document.exitFullscreen();
	  } else if(document.mozCancelFullScreen) {
	    document.mozCancelFullScreen();
	  } else if(document.webkitExitFullscreen) {
	    document.webkitExitFullscreen();
	  }
	  
	  document.getElementById("exit_fullscreen_item").style.display = 'none';
	  document.getElementById("enter_fullscreen_item").style.display = 'block';
	  document.getElementById("fullscreen_block_menu_hide").style.display = 'block';
	  document.getElementById("fullscreen_block").style.width = '';
	  document.getElementById("fullscreen_block").style.margin = '';
}

function launchIntoFullwidth(element)
{  
	  document.getElementById("exit_fullwidth_item").style.display = 'block';
	  document.getElementById("enter_fullwidth_item").style.display = 'none';
	  document.getElementById("fullscreen_block_menu_hide").style.display = 'none';
	  document.getElementById("fullscreen_block").style.width = '100%';
	  document.getElementById("fullscreen_block").style.margin = 'auto';
}

function exitFullwidth()
{  
	  document.getElementById("exit_fullwidth_item").style.display = 'none';
	  document.getElementById("enter_fullwidth_item").style.display = 'block';
	  document.getElementById("fullscreen_block_menu_hide").style.display = 'block';
	  document.getElementById("fullscreen_block").style.width = '';
	  document.getElementById("fullscreen_block").style.margin = '';
}

function GetMultiSelectItems()
{
  var multi_select = document.forms.teacherRegForm;
  var SelBranchVal = "";
  var x = 0;

  var count = 0;
  for (x=0;x<multi_select.preferredLocations.length;x++)
  {
     if (multi_select.preferredLocations[x].selected)
     {
      //alert(InvForm.SelBranch[x].value);
      if (count == 0)
    	  SelBranchVal = multi_select.preferredLocations[x].value;
      else
    	  SelBranchVal = SelBranchVal + "," + multi_select.preferredLocations[x].value;
      
      count++;
     }
  }
  //alert(SelBranchVal);
  return SelBranchVal;
}

function doctor_registration_save()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

    var firstname  = encodeURIComponent(document.getElementById('firstName').value);
    var surname  = encodeURIComponent(document.getElementById('lastName').value);
    var gender  = encodeURIComponent(document.getElementById('gender').value);
    var dob  = document.getElementById('inputdobJqxWidget').value;
    var email  = document.getElementById('email').value;
    var mobile  = encodeURIComponent(document.getElementById('mobileNumber').value);
    var password  = document.getElementById('password').value;
    var password_repeated  = document.getElementById('password_check').value;
    var subject  = encodeURIComponent(document.getElementById('subject').value);
    var fresher  = document.getElementById('fresher').checked;
    if (fresher)
    	fresher = 1;
    var salary  = encodeURIComponent(document.getElementById('expectedSalary').value);
    var experience  = encodeURIComponent(document.getElementById('experience').value);
    var state  = document.getElementById('district').value;
    var preferred_state  = document.getElementById('preferredLocations').value;
    var address1  = encodeURIComponent(document.getElementById('addressLine1').value);
    var address2  = encodeURIComponent(document.getElementById('addressLine2').value);
    var address3  = encodeURIComponent(document.getElementById('addressLine3').value);
    var pincode  = encodeURIComponent(document.getElementById('pincode').value);
    
    var e1_ed_c = encodeURIComponent(document.getElementById('ugDegCollName').value);
    var e1_ed_p = encodeURIComponent(document.getElementById('ugDegPercentage').value);
    var e1_ed_y = document.getElementById('ugDegYear').value;
    var e2_ed_c = encodeURIComponent(document.getElementById('pgDegCollName').value);
    var e2_ed_p = encodeURIComponent(document.getElementById('pgDegPercentage').value);
    var e2_ed_y = document.getElementById('pgDegYear').value;
    var e3_ed_c = encodeURIComponent(document.getElementById('bEdColName').value);
    var e3_ed_p = encodeURIComponent(document.getElementById('bEdPercentage').value);
    var e3_ed_y = document.getElementById('bEdYear').value;
    var e4_ed_c = encodeURIComponent(document.getElementById('mEdColName').value);
    var e4_ed_p = encodeURIComponent(document.getElementById('mEdPercentage').value);
    var e4_ed_y = document.getElementById('mEdYear').value;

    preferred_state = GetMultiSelectItems();
	
    if ( firstname == '' )
    {
		alert ('Please enter your first name');
	}
	else if ( surname == '' )
    {
		alert ('Please enter your surname');
	}
	else if ( gender == '' )
    {
		alert ('Please provide your gender');
	}
	else if ( dob == '' )
    {
		alert ('Please enter your date of birth');
	}
	else if ( !validateEmail(email) )
    {
		alert ('Please enter a valid email address');
	}
	else if ( mobile == '' )
    {
		alert ('Please enter your phone number');
	}
	else if ( password == '' )
    {
		alert ('Please enter your password');
	}
	else if ( password.length < 8 )
    {
		alert ('Please enter at least 8 digits for your password');
	}
	else if ( password != password_repeated)
	{
		alert ('Passwords do not match - please retype');
	}
	else if ( subject == '' )
    {
		alert ('Please enter your subject of expertise');
	}
	else if ( address1 == '' )
    {
		alert ('Please enter your address');
	}
	else if ( state == '' )
    {
		alert ('Please enter your district');
	}
	else
	{				
		var url = "../process/user_registration_save.php";
		var params = "firstname="+firstname+"&surname="+surname+"&gender="+gender+"&dob="+dob+"&email="+email+"&mobile="+mobile+"&password="+password+"&subject="+subject+"&fresher="+fresher+"&salary="+salary+"&experience="+experience+"&state="+state+"&preferred_state="+preferred_state+"&e1_ed_c="+e1_ed_c+"&e1_ed_p="+e1_ed_p+"&e1_ed_y="+e1_ed_y+"&e2_ed_c="+e2_ed_c+"&e2_ed_p="+e2_ed_p+"&e2_ed_y="+e2_ed_y+"&e3_ed_c="+e3_ed_c+"&e3_ed_p="+e3_ed_p+"&e3_ed_y="+e3_ed_y+"&e4_ed_c="+e4_ed_c+"&e4_ed_p="+e4_ed_p+"&e4_ed_y="+e4_ed_y+"&address1="+address1+"&address2="+address2+"&address3="+address3+"&pincode="+pincode;
	
		xmlHttp.open("POST", url, true);
		
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", params.length);
		xmlHttp.setRequestHeader("Connection", "close");
	
		xmlHttp.onreadystatechange=doctor_registration_save_response;
		xmlHttp.send(params);
	}
}

function doctor_registration_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			window.location.href = "http://www.yourteachers.in/";
		}
	}
}


function school_registration_save()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

    var firstname  = encodeURIComponent(document.getElementById('firstName').value);
    var surname  = encodeURIComponent(document.getElementById('lastName').value);
    var school_name  = encodeURIComponent(document.getElementById('school_name').value);
    var email  = document.getElementById('email').value;
    var mobile  = encodeURIComponent(document.getElementById('mobileNumber').value);
    var password  = document.getElementById('password').value;
    var password_repeated  = document.getElementById('password_check').value;
    var state  = document.getElementById('district').value;
    var address1  = encodeURIComponent(document.getElementById('addressLine1').value);
    var address2  = encodeURIComponent(document.getElementById('addressLine2').value);
    var address3  = encodeURIComponent(document.getElementById('addressLine3').value);
    var pincode  = encodeURIComponent(document.getElementById('pincode').value);

	
    if ( firstname == '' )
    {
		alert ('Please enter your first name');
	}
	else if ( surname == '' )
    {
		alert ('Please enter your surname');
	}
	else if ( !validateEmail(email) )
    {
		alert ('Please enter a valid email address');
	}
	else if ( mobile == '' )
    {
		alert ('Please enter your phone number');
	}
	else if ( password == '' )
    {
		alert ('Please enter your password');
	}
	else if ( password.length < 8 )
    {
		alert ('Please enter at least 8 digits for your password');
	}
	else if ( password != password_repeated)
	{
		alert ('Passwords do not match - please retype');
	}
	else if ( school_name == '' )
    {
		alert ('Please enter the name of your school');
	}
	else if ( address1 == '' )
    {
		alert ('Please enter your address');
	}
	else if ( state == '' )
    {
		alert ('Please enter your district');
	}
	else
	{				
		var url = "../process/school_registration_save.php";
		var params = "firstname="+firstname+"&surname="+surname+"&school_name="+school_name+"&email="+email+"&mobile="+mobile+"&password="+password+"&state="+state+"&address1="+address1+"&address2="+address2+"&address3="+address3+"&pincode="+pincode;
	
		xmlHttp.open("POST", url, true);
		
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", params.length);
		xmlHttp.setRequestHeader("Connection", "close");
	
		xmlHttp.onreadystatechange=school_registration_save_response;
		xmlHttp.send(params);
	}
}

function school_registration_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			window.location.href = "http://www.yourteachers.in/";
		}
	}
}


function cancel_healthcare_professional_edit()
{
	window.location.href = "http://www.yourteachers.in.com/business_logic/admin/healthcare_professionals_database.php";
}

function user_registration_update(id_var)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

    var firstname  = encodeURIComponent(document.getElementById('firstName').value);
    var surname  = encodeURIComponent(document.getElementById('lastName').value);
    var gender  = encodeURIComponent(document.getElementById('gender').value);
    var dob  = document.getElementById('dob').value;
    var email  = document.getElementById('email').value;
    var mobile  = encodeURIComponent(document.getElementById('mobileNumber').value);
    var password  = document.getElementById('password').value;
    var password_repeated  = document.getElementById('password_check').value;
    var subject  = encodeURIComponent(document.getElementById('subject').value);
    var fresher  = document.getElementById('fresher').checked;
    if (fresher)
    	fresher = 1;
    var authenticated_user  = document.getElementById('authenticated_user').checked;
    if (authenticated_user)
    	authenticated_user = 1;
    var published_user  = document.getElementById('published_user').checked;
    if (published_user)
    	published_user = 1;
    var salary  = encodeURIComponent(document.getElementById('expectedSalary').value);
    var experience  = encodeURIComponent(document.getElementById('experience').value);
    var state  = document.getElementById('district').value;
    var preferred_state  = document.getElementById('preferredLocations').value;
    var address1  = encodeURIComponent(document.getElementById('addressLine1').value);
    var address2  = encodeURIComponent(document.getElementById('addressLine2').value);
    var address3  = encodeURIComponent(document.getElementById('addressLine3').value);
    var pincode  = encodeURIComponent(document.getElementById('pincode').value);
    
    var e1_ed_c = encodeURIComponent(document.getElementById('ugDegCollName').value);
    var e1_ed_p = encodeURIComponent(document.getElementById('ugDegPercentage').value);
    var e1_ed_y = document.getElementById('ugDegYear').value;
    var e2_ed_c = encodeURIComponent(document.getElementById('pgDegCollName').value);
    var e2_ed_p = encodeURIComponent(document.getElementById('pgDegPercentage').value);
    var e2_ed_y = document.getElementById('pgDegYear').value;
    var e3_ed_c = encodeURIComponent(document.getElementById('bEdColName').value);
    var e3_ed_p = encodeURIComponent(document.getElementById('bEdPercentage').value);
    var e3_ed_y = document.getElementById('bEdYear').value;
    var e4_ed_c = encodeURIComponent(document.getElementById('mEdColName').value);
    var e4_ed_p = encodeURIComponent(document.getElementById('mEdPercentage').value);
    var e4_ed_y = document.getElementById('mEdYear').value;

    preferred_state = GetMultiSelectItems();
	
    if ( firstname == '' )
    {
		alert ('Please enter your first name');
	}
	else if ( surname == '' )
    {
		alert ('Please enter your surname');
	}
	else if ( gender == '' )
    {
		alert ('Please provide your gender');
	}
	else if ( dob == '' )
    {
		alert ('Please enter your date of birth');
	}
	else if ( !validateEmail(email) )
    {
		alert ('Please enter a valid email address');
	}
	else if ( mobile == '' )
    {
		alert ('Please enter your phone number');
	}
	else if ( password == '' )
    {
		alert ('Please enter your password');
	}
	else if ( password.length < 8 )
    {
		alert ('Please enter at least 8 digits for your password');
	}
	else if ( password != password_repeated)
	{
		alert ('Passwords do not match - please retype');
	}
	else if ( subject == '' )
    {
		alert ('Please enter your subject of expertise');
	}
	else if ( address1 == '' )
    {
		alert ('Please enter your address');
	}
	else if ( state == '' )
    {
		alert ('Please enter your district');
	}
	else
	{				
		var url = "../process/user_registration_update.php";
		var params = "id="+id_var+"&firstname="+firstname+"&surname="+surname+"&gender="+gender+"&dob="+dob+"&email="+email+"&mobile="+mobile+"&password="+password+"&subject="+subject+"&fresher="+fresher+"&salary="+salary+"&experience="+experience+"&state="+state+"&preferred_state="+preferred_state+"&e1_ed_c="+e1_ed_c+"&e1_ed_p="+e1_ed_p+"&e1_ed_y="+e1_ed_y+"&e2_ed_c="+e2_ed_c+"&e2_ed_p="+e2_ed_p+"&e2_ed_y="+e2_ed_y+"&e3_ed_c="+e3_ed_c+"&e3_ed_p="+e3_ed_p+"&e3_ed_y="+e3_ed_y+"&e4_ed_c="+e4_ed_c+"&e4_ed_p="+e4_ed_p+"&e4_ed_y="+e4_ed_y+"&address1="+address1+"&address2="+address2+"&address3="+address3+"&pincode="+pincode+"&authenticated_user="+authenticated_user+"&published_user="+published_user;
	
		xmlHttp.open("POST", url, true);
		
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", params.length);
		xmlHttp.setRequestHeader("Connection", "close");
	
		xmlHttp.onreadystatechange=user_registration_update_response;
		xmlHttp.send(params);
	}
}

function user_registration_update_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			window.location.href = "http://www.yourteachers.in/business_logic/admin/professionals_database.php";
		}
	}
}

function school_registration_update(id_var)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var id_user = id_var;
    var firstname  = encodeURIComponent(document.getElementById('firstName').value);
    var surname  = encodeURIComponent(document.getElementById('lastName').value);
    var school_name  = encodeURIComponent(document.getElementById('school_name').value);
    var email  = document.getElementById('email').value;
    var mobile  = encodeURIComponent(document.getElementById('mobileNumber').value);
    var password  = document.getElementById('password').value;
    var password_repeated  = document.getElementById('password_check').value;
    var state  = document.getElementById('district').value;
    var address1  = encodeURIComponent(document.getElementById('addressLine1').value);
    var address2  = encodeURIComponent(document.getElementById('addressLine2').value);
    var address3  = encodeURIComponent(document.getElementById('addressLine3').value);
    var pin  = encodeURIComponent(document.getElementById('pincode').value);
    var authenticated_user  = document.getElementById('authenticated_user').checked;
    if (authenticated_user)
    	authenticated_user = 1;
    var published_user  = document.getElementById('published_user').checked;
    if (published_user)
    	published_user = 1;

	
    if ( firstname == '' )
    {
		alert ('Please enter your first name');
	}
	else if ( surname == '' )
    {
		alert ('Please enter your surname');
	}
	else if ( !validateEmail(email) )
    {
		alert ('Please enter a valid email address');
	}
	else if ( mobile == '' )
    {
		alert ('Please enter your phone number');
	}
	else if ( password == '' )
    {
		alert ('Please enter your password');
	}
	else if ( password.length < 8 )
    {
		alert ('Please enter at least 8 digits for your password');
	}
	else if ( password != password_repeated)
	{
		alert ('Passwords do not match - please retype');
	}
	else if ( school_name == '' )
    {
		alert ('Please enter the name of your school');
	}
	else if ( address1 == '' )
    {
		alert ('Please enter your address');
	}
	else if ( state == '' )
    {
		alert ('Please enter your district');
	}
	else
	{				
		var url = "../process/school_registration_update.php";
		var params = "firstname="+firstname+"&surname="+surname+"&id="+id_user+"&school_name="+school_name+"&email="+email+"&mobile="+mobile+"&password="+password+"&state="+state+"&address1="+address1+"&address2="+address2+"&address3="+address3+"&pin="+pin+"&authenticated_user="+authenticated_user+"&published_user="+published_user;
	
		xmlHttp.open("POST", url, true);
		
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", params.length);
		xmlHttp.setRequestHeader("Connection", "close");
	
		xmlHttp.onreadystatechange=school_registration_update_response;
		xmlHttp.send(params);
	}
}

function school_registration_update_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			window.location.href = "http://www.yourteachers.in/business_logic/admin/school_database.php";
		}
	}
}

function user_registration_delete(id_var)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	var id_user = id_var;
	var firstname  = encodeURIComponent(document.getElementById('firstName').value);
    var surname  = encodeURIComponent(document.getElementById('lastName').value);
	
	var url = "../process/user_registration_delete.php";
	var params = "firstname="+firstname+"&id="+id_user+"&surname="+surname;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=doctor_registration_delete_response;
	xmlHttp.send(params);
}

function doctor_registration_delete_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			window.location.href = "http://www.yourteachers.in/business_logic/admin/professionals_database.php";
		}
	}
}

function school_registration_delete(id_var)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	var id_user = id_var;
	var firstname  = encodeURIComponent(document.getElementById('firstName').value);
    var surname  = encodeURIComponent(document.getElementById('lastName').value);
	
	var url = "../process/school_registration_delete.php";
	var params = "firstname="+firstname+"&id="+id_user+"&surname="+surname;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=school_registration_delete_response;
	xmlHttp.send(params);
}

function school_registration_delete_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			window.location.href = "http://www.yourteachers.in/business_logic/admin/school_database.php";
		}
	}
}

function edit_specialisation_show(type_flag)
{
	var specialisation_old = document.getElementById("specialisation_old").value;
	document.getElementById("specialisation").value = specialisation_old;
	document.getElementById("edit_field").style.display = 'block';
}

function edit_users_show(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	var username = document.getElementById("specialisation_old").value;
	
	var url = "../admin/get_users_details.php";
	var params = "username="+username;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_users_show_response;
	xmlHttp.send(params);
}

function edit_users_show_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			document.getElementById("edit_user_details_field").innerHTML = display_text;	
			document.getElementById("edit_field").style.display = 'block';
		}
	}
}

function edit_specialisation_hide(type_flag)
{
	document.getElementById("edit_field").style.display = 'none';
	
}

function edit_specialisation_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var specialisation_old  = document.getElementById('specialisation_old').value;
	var specialisation  = document.getElementById('specialisation').value;
	
	var url = "../admin/edit_specialisation_save.php";
	var params = "specialisation_old="+specialisation_old+"&specialisation="+specialisation+"&type_flag="+type_flag;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_specialisation_save_response;
	xmlHttp.send(params);
}

function edit_specialisation_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function edit_user_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var username = document.getElementById("specialisation_old").value;
	var new_username = document.getElementById("csr_username").value;
	var password  = document.getElementById('csr_password').value;
	var firstname  = document.getElementById('csr_firstname').value;
	var surname  = document.getElementById('csr_surname').value;
	var role  = document.getElementById('csr_role').value;
	var project  = document.getElementById('csr_project').value;
	
	var url = "../admin/edit_user_save.php";
	var params = "username="+username+"&new_username="+new_username+"&password="+password+"&firstname="+firstname+"&surname="+surname+"&role="+role+"&project="+project+"&type_flag="+type_flag;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_user_save_response;
	xmlHttp.send(params);
}

function edit_user_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function add_user_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var username = document.getElementById("csr_username_add").value;
	var password  = document.getElementById('csr_password_add').value;
	var firstname  = document.getElementById('csr_firstname_add').value;
	var surname  = document.getElementById('csr_surname_add').value;
	var role  = document.getElementById('csr_role_add').value;
	var project  = document.getElementById('csr_project_add').value;
	
	var url = "../admin/add_user_save.php";
	var params = "username="+username+"&password="+password+"&firstname="+firstname+"&surname="+surname+"&role="+role+"&project="+project+"&type_flag="+type_flag;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_user_save_response;
	xmlHttp.send(params);
}

function add_user_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

/**** company */
function add_company_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = encodeURIComponent(document.getElementById("field_1_add").value);
	var field_2_add = encodeURIComponent(document.getElementById('field_2_add').value);
	var field_3_add = encodeURIComponent(document.getElementById('field_3_add').value);
	var field_4_add = encodeURIComponent(document.getElementById('field_4_add').value);
	var field_5_add = encodeURIComponent(document.getElementById('field_5_add').value);
	var field_6_add = 'ffffff';
	
	var url = "../admin_tool/add_company.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_company_save_response;
	xmlHttp.send(params);
}

function add_company_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

/**************/

/**** company matrix */
function add_company_matrix(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	if (document.getElementById('optradio1').checked)
		field_6_add = 1;
	else
		field_6_add = 0;

	var field_1_add = document.getElementById("field_1_add").value;
	var field_2_add  = document.getElementById('field_2_add').value;
	var field_3_add  = document.getElementById('field_3_add').value;
	var field_4_add  = document.getElementById('field_4_add').value;
	var field_5_add  = document.getElementById('field_5_add').value;
	
	var url = "../admin_tool/add_company_matrix.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_company_matrix_response;
	xmlHttp.send(params);
}

function add_company_matrix_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

/**************/

function add_quantity_to_proposal(quantity_val)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var quantity_value = 'quantity_value_' + quantity_val;
	var field_1_add = quantity_val;
	var field_2_add = document.getElementById(quantity_value).value;
	
	var url = "../sales_tool/update_material_quantity.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_quantity_to_proposal_response;
	xmlHttp.send(params);
}

function add_quantity_to_proposal_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;
		}
	}
}

/**** company materials */
function add_company_materials(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	if (type_flag == 1)
	{
		var field_1_add = document.getElementById("text_1_add").value;
		var field_2_add = document.getElementById('text_2_add').value;
		var field_3_add = '';
	}
	else if (type_flag == 2)
	{
		var field_1_add = document.getElementById("text_2_desc").value;
		var field_2_add = document.getElementById('text_2_cost').value;
		var field_3_add = document.getElementById('text_2_ska').value;
	}
	else if (type_flag == 3)
	{
		var field_1_add = document.getElementById("text_3_desc").value;
		var field_2_add = document.getElementById('text_3_cost').value;
		var field_3_add = document.getElementById('text_3_ska').value;
	}
	else if (type_flag == 4)
	{
		var field_1_add = document.getElementById("text_4_desc").value;
		var field_2_add = document.getElementById('text_4_cost').value;
		var field_3_add = document.getElementById('text_4_ska').value;
	}
	
	var url = "../admin_tool/add_company_materials.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_company_matrix_response;
	xmlHttp.send(params);
}

function add_company_materials_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function choose_materials(type)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	if (type == 1)
	{
		var field_1_add = document.getElementById("materials_proposal_platinum_id").value;
		var field_2_add = 'platinum';
	}
	if (type == 2)
	{
		var field_1_add = document.getElementById("materials_proposal_gold_id").value;
		var field_2_add = 'gold';
	}
	if (type == 3)
	{
		var field_1_add = document.getElementById("materials_proposal_basic_id").value;
		var field_2_add = 'basic';
	}
	
	if (field_1_add == '')
	{
		exit;
	}
	
	var url = "../sales_tool/save_materials_proposal.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=choose_materials_response;
	xmlHttp.send(params);
}

function choose_materials_table(type, id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	if (type == 1)
	{
		var field_1_add = id;
		var field_2_add = 'platinum';
		document.getElementById("search_materials_sales_1").value = '';
		document.getElementById("materials_table_1").style.display = 'none';
	}
	if (type == 2)
	{
		var field_1_add = id;
		var field_2_add = 'gold';
		document.getElementById("search_materials_sales_2").value = '';
		document.getElementById("materials_table_2").style.display = 'none';
	}
	if (type == 3)
	{
		var field_1_add = id;
		var field_2_add = 'basic';
		document.getElementById("search_materials_sales_3").value = '';
		document.getElementById("materials_table_3").style.display = 'none';
	}
	
	if (field_1_add == '')
	{
		exit;
	}
	
	var url = "../sales_tool/save_materials_proposal.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=choose_materials_response;
	xmlHttp.send(params);
}

function choose_materials_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			var SplitResult = display_text.split("<<<!separator!>>>");
			row_id = SplitResult[0];
			description = SplitResult[1];
			cost = SplitResult[2];
			type_field = SplitResult[3];
			quantity = SplitResult[4];
			
			if (type_field == 'platinum')
			{
				var table = document.getElementById("materials_proposal_add_table_platinum");
			}
			if (type_field == 'gold')
			{
				var table = document.getElementById("materials_proposal_add_table_gold");
			}
			if (type_field == 'basic')
			{
				var table = document.getElementById("materials_proposal_add_table_basic");
			}

			// Create an empty <tr> element and add it to the 1st position of the table:
			var row = table.insertRow(1);
			row.id = 'material_proposal_row_' + row_id;

			// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			var cell4 = row.insertCell(3);
			var cell5 = row.insertCell(4);

			// Add some text to the new cells:
			cell1.innerHTML = '';
			cell2.innerHTML = row_id;
			cell3.innerHTML = description;
			cell4.innerHTML = '<input style="width:70%;" id="quantity_value_' + row_id + '" onchange="add_quantity_to_proposal(\'' + row_id + '\')" name="field_6_add" class="form-control" data-trigger="focus" type="text" value="1"/>';
			cell5.innerHTML = '<button onclick="delete_material_proposal(\'' + row_id + '\')" type="button" class="btn btn-danger">Delete</button>';
		}
	}
}

function show_sales_materials()
{
	;
}

function delete_material_proposal($material_id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	var field_1_add = $material_id;
	var row_to_delete = 'material_proposal_row_' + $material_id;
	document.getElementById(row_to_delete).style.display = 'none';
	
	var url = "../sales_tool/delete_materials_proposal.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=delete_material_proposal_response;
	xmlHttp.send(params);
}

function delete_material_proposal_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;//alert(display_text);
		}
	}
}

/**************/

/**** salesperson */
function add_salesperson_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("field_1_add").value;
	var field_2_add  = document.getElementById('field_2_add').value;
	var field_3_add  = document.getElementById('field_3_add').value;
	var field_4_add  = document.getElementById('field_4_add').value;
	var field_5_add  = document.getElementById('field_5_add').value;
	var field_6_add  = document.getElementById('field_6_add').value;
	var field_7_add  = document.getElementById('field_7_add').value;
	
	if (field_1_add == '')
	{
		alert("Please enter a name");
		exit;
	}
	if (field_2_add == '')
	{
		alert("Please enter a phone number");
		exit;
	}
	if (field_3_add == '')
	{
		alert("Please enter an email address");
		exit;
	}
	if (field_4_add == '')
	{
		alert("Please enter a password");
		exit;
	}
	
	if (field_4_add != field_5_add)
	{
		alert("Error: passwords do not match");
		exit;
	}
	

	if (field_6_add == '')
	{
		alert("Please enter the salesperson's commission");
		exit;
	}
	
	if (field_7_add == '')
	{
		alert("Please enter the salesperson's initial proposal ID number");
		exit;
	}
	
	var url = "../admin_tool/add_salesperson.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_6_add="+field_6_add+"&field_7_add="+field_7_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_salesperson_save_response;
	xmlHttp.send(params);
}

function add_salesperson_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function edit_salesperson_get()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("salesperson_id").value;
	if (field_1_add == '')
	{
		document.getElementById("edit_salesperson_form").style.display = 'none';
		document.getElementById("registerBtn2").style.display = 'none';
		document.getElementById("cancelBtn2").style.display = 'none';
		exit;
	}
		
	
	var url = "../admin_tool/get_salesperson.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_salesperson_get_response;
	xmlHttp.send(params);
}

function edit_salesperson_get_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			var SplitResult = display_text.split("<<<!separator!>>>");
			document.getElementById('field_1_update').value = SplitResult[0];
			document.getElementById('field_2_update').value = SplitResult[1];
			document.getElementById('field_3_update').value = SplitResult[2];
			document.getElementById('field_7_update').value = SplitResult[3];
			document.getElementById('field_4_update').value = SplitResult[4];
			document.getElementById('field_8_update').value = SplitResult[5];
			
			document.getElementById("edit_salesperson_form").style.display = 'block';
			document.getElementById("registerBtn2").style.display = 'block';
			document.getElementById("cancelBtn2").style.display = 'block';
			document.getElementById("deleteBtn3").style.display = 'block';
		}
	}
}


function update_salesperson_cancel()
{
	document.getElementById("edit_salesperson_form").style.display = 'none';
	document.getElementById("registerBtn2").style.display = 'none';
	document.getElementById("cancelBtn2").style.display = 'none';
	document.getElementById("deleteBtn3").style.display = 'none';
}

function update_salesperson()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("field_1_update").value;
	var field_2_add  = document.getElementById('field_2_update').value;
	var field_3_add  = document.getElementById('field_3_update').value;
	var field_4_add  = document.getElementById('field_4_update').value;
	var field_6_add  = document.getElementById('field_6_update').value;
	var field_7_add  = document.getElementById('field_7_update').value;
	var field_8_add  = document.getElementById('field_8_update').value;
	var field_5_add = document.getElementById("salesperson_id").value;
	
	if (field_4_add != field_6_add)
	{
		alert("Error: passwords do not match");
		exit;
	}
	
	var url = "../admin_tool/update_salesperson.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_7_add="+field_7_add+"&field_8_add="+field_8_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=update_salesperson_response;
	xmlHttp.send(params);
}

function update_salesperson_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}


function delete_salesperson()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("salesperson_id").value;
	
	var url = "../admin_tool/delete_salesperson.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=delete_salesperson_response;
	xmlHttp.send(params);
}

function delete_salesperson_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}
/**************/

function clear_proposal_id()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var url = "../sales_tool/clear_proposal_id.php";
	var params = "";

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=clear_proposal_id_response;
	xmlHttp.send(params);
}

function clear_proposal_id_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;
		}
	}
}

function set_proposal_id()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var url = "../sales_tool/set_proposal_id.php";
	var params = "";
	play_sound(this);

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=set_proposal_id_response;
	xmlHttp.send(params);
}

function set_proposal_id_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'success')
		{
			window.location.href = "/business_logic/sales_tool/index3.php";
		}
		else
		{
			alert('Please enter a name for the client and click the "Save" button');
		}
	}
}

function get_client_proposal_details()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("client_proposal_id").value;
	
	if (field_1_add == '')
	{
		document.getElementById('optradio1').checked = 'false';
		document.getElementById('optradio2').checked = 'true';
		
		document.getElementById('field_1_add').value = '';
		document.getElementById('field_2_add').value = '';
		document.getElementById('field_3_add').value = '';
		document.getElementById('field_4_add').value = '';
		document.getElementById('field_5_add').value = '';
		document.getElementById('field_12_add').value = '';
		document.getElementById('field_6_add').value = '';
		document.getElementById('field_7_add').value = '';
		document.getElementById('field_8_add').value = '';
		document.getElementById('field_13_add').value = '';
		document.getElementById('field_14_add').value = '';
		//$("#field_9_add").jqxDateTimeInput({ formatString: '' });
		//$("#field_11_add").jqxDateTimeInput({ formatString: '' });
		return;
	}
	
	var url = "../sales_tool/get_client_proposal_details.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=get_client_proposal_details_response;
	xmlHttp.send(params);
}

function get_client_proposal_details_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			//SELECT `id`, `name1`, `name2`, `address`, `city`, `state`, `zip`, `phone1`, `phone2`, `email`, `email2`, `date`, `rental`, `install`, `best`, `better`, `good`, `company_id`, `salesperson_id
			var SplitResult = display_text.split("<<<!separator!>>>");
			document.getElementById('field_1_add').value = SplitResult[1];
			document.getElementById('field_2_add').value = SplitResult[2];
			document.getElementById('field_3_add').value = SplitResult[3];
			document.getElementById('field_4_add').value = SplitResult[4];
			document.getElementById('field_5_add').value = SplitResult[5];
			document.getElementById('field_12_add').value = SplitResult[6];
			document.getElementById('field_6_add').value = SplitResult[7];
			document.getElementById('field_7_add').value = SplitResult[8];
			document.getElementById('field_8_add').value = SplitResult[9];
			document.getElementById('field_13_add').value = SplitResult[10];
			document.getElementById('field_14_add').value = SplitResult[19];
			//document.getElementById('field_9_add').value = SplitResult[11];
			//document.getElementById('field_11_add').value = SplitResult[13];
			
			//$("#field_9_add").jqxDateTimeInput({ 'setDate', SplitResult[11] });
			//$("#field_11_add").jqxDateTimeInput({ 'setDate', SplitResult[13] });
			
			var result_array = SplitResult[11].split("-");
			var result_array_month = result_array[0] - 1;
			var date = new Date();
            date.setFullYear(result_array[2], result_array_month, result_array[1]);
            $('#field_9_add').jqxDateTimeInput('setDate', date);
            
            var result_array = SplitResult[13].split("-");
			var result_array_month = result_array[0] - 1;
			var date = new Date();
            date.setFullYear(result_array[2], result_array_month, result_array[1]);
            $('#field_11_add').jqxDateTimeInput('setDate', date);
			
			if (SplitResult[12])
				document.getElementById('optradio1').checked = 'true';
			else
				document.getElementById('optradio2').checked = 'true';
		}
	}
}

/**** quote sheet */
function add_quote_sheet_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("field_1_add").value;
	var field_2_add  = document.getElementById('field_2_add').value;
	var field_3_add  = document.getElementById('field_3_add').value;
	
	var url = "../admin_tool/add_quote_sheet.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_quote_sheet_save_response;
	xmlHttp.send(params);
}

function add_quote_sheet_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function add_pdf_titles(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = encodeURIComponent(document.getElementById("field_1_add").value);
	var field_2_add = encodeURIComponent(document.getElementById('field_2_add').value);
	var field_3_add = encodeURIComponent(document.getElementById('field_3_add').value);
	var field_4_add = encodeURIComponent(document.getElementById("field_4_add").value);
	var field_5_add = encodeURIComponent(document.getElementById('field_5_add').value);
	var field_6_add = encodeURIComponent(document.getElementById('field_6_add').value);
	var field_7_add = encodeURIComponent(document.getElementById("field_7_add").value);
	
	var url = "../admin_tool/add_pdf_titles.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add+"&field_7_add="+field_7_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_pdf_titles_response;
	xmlHttp.send(params);
}

function add_pdf_titles_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function add_pdf_email(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = encodeURIComponent(document.getElementById("field_1_add").value);
	
	var url = "../admin_tool/add_pdf_email.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_pdf_email_response;
	xmlHttp.send(params);
}

function add_pdf_email_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}


/**************/

function play_sound(el)
{
	soundfile = 'http://www.arbco.org/business_logic/process/notification.mp3';
	
	if (el.mp3) {
        if(el.mp3.paused) el.mp3.play();
        else el.mp3.pause();
    } else {
        el.mp3 = new Audio(soundfile);
        el.mp3.play();
    }
}

/**** client */
function add_client_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
		
	if (document.getElementById('optradio1').checked)
		field_10_add = 1;
	else
		field_10_add = 0;

	var field_1_add = document.getElementById("field_1_add").value;
	var field_2_add  = document.getElementById('field_2_add').value;
	var field_3_add  = document.getElementById('field_3_add').value;
	var field_4_add  = document.getElementById('field_4_add').value;
	var field_5_add  = document.getElementById('field_5_add').value;
	var field_6_add  = document.getElementById('field_6_add').value;
	var field_7_add  = document.getElementById('field_7_add').value;
	var field_8_add  = document.getElementById('field_8_add').value;
	var field_9_add  = document.getElementById('field_9_add').value;
	var field_11_add  = document.getElementById('field_11_add').value;
	var field_12_add  = document.getElementById('field_12_add').value;
	var field_13_add  = document.getElementById('field_13_add').value;
	var field_14_add  = document.getElementById('field_14_add').value;

	if ($('#show_matrix_box').length)
	{
		var field_1_matrix  = document.getElementById('field_1_matrix').value;
		var field_2_matrix  = document.getElementById('field_2_matrix').value;
		var field_3_matrix  = document.getElementById('field_3_matrix').value;
		var field_4_matrix  = document.getElementById('field_4_matrix').value;
		
		
		if ( (field_1_matrix != '') || (field_2_matrix != '') || (field_3_matrix != '') || (field_4_matrix != '') )
		{
			field_5_matrix = 1;
		}
		else
			field_5_matrix = 0;

		var url = "../sales_tool/add_client.php";
		var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add+"&field_7_add="+field_7_add+"&field_8_add="+field_8_add+"&field_9_add="+field_9_add+"&field_10_add="+field_10_add+"&field_11_add="+field_11_add+"&field_12_add="+field_12_add+"&field_13_add="+field_13_add+"&field_14_add="+field_14_add+"&type_flag="+type_flag+"&field_1_matrix="+field_1_matrix+"&field_2_matrix="+field_2_matrix+"&field_3_matrix="+field_3_matrix+"&field_4_matrix="+field_4_matrix+"&field_5_matrix="+field_5_matrix;
	}
	else
	{
		if (field_2_add == '')
		{
			alert('Please enter a client name and click "Save"');
			return;
		}
		
		var field_1_matrix  = '';
		var field_2_matrix  = '';
		var field_3_matrix  = '';
		var field_4_matrix  = '';
		var field_5_matrix  = '0';
		
		var url = "../sales_tool/add_client.php";
		var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add+"&field_7_add="+field_7_add+"&field_8_add="+field_8_add+"&field_9_add="+field_9_add+"&field_10_add="+field_10_add+"&field_11_add="+field_11_add+"&field_12_add="+field_12_add+"&field_13_add="+field_13_add+"&field_14_add="+field_14_add+"&type_flag="+type_flag+"&field_1_matrix="+field_1_matrix+"&field_2_matrix="+field_2_matrix+"&field_3_matrix="+field_3_matrix+"&field_4_matrix="+field_4_matrix+"&field_5_matrix="+field_5_matrix;
	}
	
	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_client_save_response;
	xmlHttp.send(params);
}

function add_client_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'Client Deleted')
		{
			alert(display_text);
			//location.reload();
			window.location.href = "../sales_tool/index2.php";
		}
		else
		{
			alert(display_text);
			play_sound(this);
		}
	}
}

function choose_client()
{	
	var client_id = document.getElementById('client_proposal_id').value;
	
	if ( client_id == '')
	{
		alert ('Please choose an existing client from the list above');
		return;
	}
	
	var url = "../sales_tool/choose_client.php";

    $.post(url,
    {
    	client_id: client_id
    },
    function(data,status){
    	alert(data);
    });
}

/**************/

/**** job info */
function add_job_info_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("field_1_add").value;
	var field_2_add  = document.getElementById('field_2_add').value;
	var field_3_add  = document.getElementById('field_3_add').value;
	
	var url = "../sales_tool/add_job_info.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_client_save_response;
	xmlHttp.send(params);
}

function add_job_info_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			play_sound(this);
		}
	}
}

/**************/

/******* permit save *****************/
function add_permit_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	if (document.getElementById('optradio1').checked)
		field_1_add = 1;
	else
		field_1_add = 0;

	var field_2_add  = document.getElementById('field_2_add').value;
	var field_3_add  = document.getElementById('field_3_add').value;
	var field_4_add = document.getElementById("field_4_add").value;
	var field_5_add  = document.getElementById('field_5_add').value;
	var field_6_add  = document.getElementById('field_6_add').value;
	var field_7_add = document.getElementById("field_7_add").value;
	var field_8_add  = document.getElementById('field_8_add').value;
	var field_9_add  = document.getElementById('field_9_add').value;
	var field_10_add = document.getElementById("field_10_add").value;
	var field_11_add  = document.getElementById('field_11_add').value;
	var field_12_add  = document.getElementById('field_12_add').value;
	
	var url = "../sales_tool/add_permit_save.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add+"&field_7_add="+field_7_add+"&field_8_add="+field_8_add+"&field_9_add="+field_9_add+"&field_10_add="+field_10_add+"&field_11_add="+field_11_add+"&field_12_add="+field_12_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_permit_save_response;
	xmlHttp.send(params);
}

function add_permit_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			play_sound(this);
		}
	}
}


/**** job info */
function add_materials_save(type_id)
{
	alert('Data Saved');
}


function add_employee_hours(employee_id, package_id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var employee_hours = 'employee_value_' + employee_id + '_' + package_id;
	var field_1_add = employee_id;
	var field_2_add = document.getElementById(employee_hours).value;
	
	var url = "../sales_tool/add_contractor_proposal_hours.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&package_id="+package_id;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_employee_hours_response;
	xmlHttp.send(params);
}

function add_employee_hours_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			//alert(display_text);
			play_sound(this);
		}
	}
}

/**************/

function add_contractor_desc(employee_id, package_type)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	if (package_type == 1)
	{
		var field_3_add = 'platinum';
		var field_2_add = 'field_4_1_' + employee_id;
		var field_4_add = 'field_1_1_' + employee_id;
		var field_5_add = 'field_2_1_' + employee_id;
		var field_6_add = 'field_3_1_' + employee_id;
	}
	else if (package_type == 2)
	{
		var field_3_add = 'gold';
		var field_2_add = 'field_4_2_' + employee_id;
		var field_4_add = 'field_1_2_' + employee_id;
		var field_5_add = 'field_2_2_' + employee_id;
		var field_6_add = 'field_3_2_' + employee_id;
	}
	else if (package_type == 3)
	{
		var field_3_add = 'basic';
		var field_2_add = 'field_4_3_' + employee_id;
		var field_4_add = 'field_1_3_' + employee_id;
		var field_5_add = 'field_2_3_' + employee_id;
		var field_6_add = 'field_3_3_' + employee_id;
	}
	
	var field_1_add = employee_id;
	var field_2_add = document.getElementById(field_2_add).value;
	var field_4_add = document.getElementById(field_4_add).value;
	var field_5_add = document.getElementById(field_5_add).value;
	var field_6_add = document.getElementById(field_6_add).value;
	
	var url = "../sales_tool/add_contractor_desc.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_contractor_desc_response;
	xmlHttp.send(params);
}

function add_contractor_desc_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;//alert(display_text);
		}
	}
}


function add_contractor_hours(employee_id, package_type)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	if (package_type == 1)
	{

	}
	else if (package_type == 2)
	{

	}
	else if (package_type == 3)
	{

	}
	
	var field_1_add = employee_id;
	var field_2_add = radio_checked;
	
	var url = "../sales_tool/add_contractor_hours.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_contractor_hours_response;
	xmlHttp.send(params);
}

function add_contractor_hours_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;//alert(display_text);
		}
	}
}

/**** add sub contractors to porposal */
function add_subcontractors_proposal_save(type_flag)
{
	alert('Data Saved');
}


/**** employees update */
function employees_update(id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var employ_name  = document.getElementById('name').value;
	var employ_rate  = document.getElementById('rate').value;
	
	var url = "../admin_tool/employee_update.php";
	var params = "id="+id+"&name="+employ_name+"&rate="+employ_rate;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=employees_update_response;
	xmlHttp.send(params);
}

function employees_update_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			play_sound(this);
			window.location.href = "../admin_tool/employee_management.php";
		}
	}
}

/**************/

/**** subcontractors update */
function subcontractors_update(id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var employ_name  = document.getElementById('name').value;
	var trade_name  = document.getElementById('trade_name').value;
	var employ_rate  = document.getElementById('rate').value;
	
	var url = "../admin_tool/subcontractor_update.php";
	var params = "id="+id+"&name="+employ_name+"&trade_name="+trade_name+"&rate="+employ_rate;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=subcontractors_update_response;
	xmlHttp.send(params);
}

function subcontractors_update_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);

			window.location.href = "../admin_tool/subcontractor_management.php";
		}
	}
}

/**************/

/**** guarantee and agreement update */
function add_guarantee_save(id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add  = encodeURIComponent(document.getElementById('field_1_add').value);
	var field_2_add  = encodeURIComponent(document.getElementById('field_2_add').value);
	var field_3_add  = encodeURIComponent(document.getElementById('field_3_add').value);
	var field_4_add  = encodeURIComponent(document.getElementById('field_4_add').value);
	var field_5_add  = encodeURIComponent(document.getElementById('field_5_add').value);
	var field_6_add  = encodeURIComponent(document.getElementById('field_6_add').value);
	
	var url = "../admin_tool/guarantee_update.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_guarantee_save_response;
	xmlHttp.send(params);
}

function add_guarantee_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);

			window.location.href = "../admin_tool/guarantees.php";
		}
	}
}

function add_agreement_save(id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add  = encodeURIComponent(document.getElementById('field_1_add').value);
	
	var url = "../admin_tool/agreement_update.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_agreement_save_response;
	xmlHttp.send(params);
}

function add_agreement_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);

			window.location.href = "../admin_tool/agreement.php";
		}
	}
}


function add_terms_save(id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add  = encodeURIComponent(document.getElementById('field_1_add').value);
	
	var url = "../admin_tool/payment_terms_update.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_terms_save_response;
	xmlHttp.send(params);
}

function add_terms_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);

			window.location.href = "../admin_tool/payment_terms.php";
		}
	}
}

function save_payment_options()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add  = document.getElementById('payment_option_id').value;
	
	var url = "../admin_tool/payment_options_update.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=save_payment_options_response;
	xmlHttp.send(params);
}

function save_payment_options_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);

			window.location.href = "../admin_tool/payment_options.php";
		}
	}
}


function remove_payment_type(option_id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add  = option_id;
	
	var url = "../admin_tool/payment_options_remove.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=remove_payment_type_response;
	xmlHttp.send(params);
}

function remove_payment_type_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);

			window.location.href = "../admin_tool/payment_options.php";
		}
	}
}

function add_license_save(id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add  = document.getElementById('field_1_add').value;
	
	var url = "../admin/license_update.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+id;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_license_save_response;
	xmlHttp.send(params);
}

function add_license_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);

			window.location.href = "../admin/license.php";
		}
	}
}

/**************/

/**************/

/**** employee */
function add_employee_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("field_1_add").value;
	var field_2_add  = document.getElementById('field_2_add').value;
	
	var url = "../admin_tool/add_employee.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_salesperson_save_response;
	xmlHttp.send(params);
}

function add_employee_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

/**************/

/**** subcontractor */
function add_subcontractor_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("field_1_add").value;
	var field_2_add  = document.getElementById('field_2_add').value;
	var field_3_add  = document.getElementById('field_3_add').value;
	var field_4_add  = document.getElementById('field_4_add').value;
	
	var url = "../sales_tool/add_subcontractor.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_subcontractor_save_response;
	xmlHttp.send(params);
}

function add_subcontractor_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

/**************/

function edit_specialisation_delete(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var specialisation_old  = document.getElementById('specialisation_old').value;
	var specialisation  = document.getElementById('specialisation').value;
	
	var url = "../admin/edit_specialisation_delete.php";
	var params = "specialisation_old="+specialisation_old+"&specialisation="+specialisation+"&type_flag="+type_flag;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_specialisation_delete_response;
	xmlHttp.send(params);
}

function edit_specialisation_delete_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}
function edit_user_delete(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var username  = document.getElementById('csr_username').value;
	
	var url = "../admin/edit_user_delete.php";
	var params = "username="+username+"&type_flag="+type_flag;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_user_delete_response;
	xmlHttp.send(params);
}

function edit_user_delete_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}


function add_specialisation_show(type_flag)
{
	document.getElementById("add_field").style.display = 'block';
}

function add_specialisation_hide(type_flag)
{
	document.getElementById("add_field").style.display = 'none';
	
}

function add_specialisation_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var specialisation  = document.getElementById('add_specialisation').value;
	
	var url = "../admin/add_specialisation_save.php";
	var params = "specialisation="+specialisation+"&type_flag="+type_flag;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_specialisation_save_response;
	xmlHttp.send(params);
}

function add_specialisation_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

/*********************************** Feature Demos  ***************************************/

function view_csr_projects()
{
	project_name = document.getElementById("project_name_scripts").value;
	subproject_name = document.getElementById("subproject_name_scripts").value;
	window.open(install_folder+"/business_logic/admin/csr_scripts/project_scripts_tmp.php?project_name="+project_name+"&sub_project="+subproject_name);
}

function edit_csr_projects_show(type_flag)
{
	var csr_projects = document.getElementById("project_name").value;
	document.getElementById("csr_projects").value = csr_projects;
	document.getElementById("edit_field").style.display = 'block';
}

function edit_csr_projects_hide(type_flag)
{
	document.getElementById("edit_field").style.display = 'none';
	
}

function insert_next_script(id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	var url = install_folder+"/business_logic/admin/csr_scripts/insert_next_script.php";
	var params = "id="+id;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=insert_next_script_response;
	xmlHttp.send(params);
}


function add_intro_text(project_name)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	var csr_input_introtext = document.getElementById("csr_input_introtext").value;
	var url = install_folder+"/business_logic/admin/csr_scripts/add_intro_text.php";
	var params = "project_name="+project_name+'&introtext='+csr_input_introtext;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_intro_text_response;
	xmlHttp.send(params);
}


function add_intro_text_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert('Project introduction text saved');
		}
	}
}

function insert_next_script_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			$cust_name = document.getElementById("csr_input_name").value;
			$cust_notes = document.getElementById("csr_input_notes").value;
			$cust_address = document.getElementById("csr_input_address").value;
			$cust_city = document.getElementById("csr_input_city").value;
			$cust_job = document.getElementById("csr_input_job").value;
			$cust_email = document.getElementById("csr_input_email").value;
			$cust_cell_phone = document.getElementById("csr_input_cell_phone").value;
			$cust_home_phone = document.getElementById("csr_input_home_phone").value;
			$cust_salesperson = document.getElementById("csr_input_salesperson").value;
			$cust_referred_by = document.getElementById("csr_input_referred_by").value;
			$cust_appointment_date = document.getElementById("csr_input_appointment_date").value;
			$cust_appointment_time = document.getElementById("csr_input_appointment_time").value;
			$cust_quote = document.getElementById("csr_input_quote").value;
			$cust_instruction = document.getElementById("csr_input_instructions").value;
			$cust_complaint = document.getElementById("csr_input_complaint").value;
			
			if (display_text.indexOf("!name!") != -1)
				document.getElementById("name").style.display = 'block';
			if (display_text.indexOf("!notes!") != -1)
				document.getElementById("notes").style.display = 'block';
			if (display_text.indexOf("!address!") != -1)
				document.getElementById("address").style.display = 'block';
			if (display_text.indexOf("!city!") != -1)
				document.getElementById("city").style.display = 'block';
			if (display_text.indexOf("!job!") != -1)
				document.getElementById("job").style.display = 'block';
			if (display_text.indexOf("!email!") != -1)
				document.getElementById("email").style.display = 'block';
			if (display_text.indexOf("!cell_phone!") != -1)
				document.getElementById("cell_phone").style.display = 'block';
			if (display_text.indexOf("!home_phone!") != -1)
				document.getElementById("home_phone").style.display = 'block';
			if (display_text.indexOf("!salesperson!") != -1)
				document.getElementById("salesperson").style.display = 'block';
			if (display_text.indexOf("!referred_by!") != -1)
				document.getElementById("referred_by").style.display = 'block';
			if (display_text.indexOf("!appointment_date!") != -1)
				document.getElementById("appointment_date").style.display = 'block';
			if (display_text.indexOf("!appointment_time!") != -1)
				document.getElementById("appointment_time").style.display = 'block';
			if (display_text.indexOf("!quote!") != -1)
				document.getElementById("quote").style.display = 'block';
			if (display_text.indexOf("!instructions!") != -1)
				document.getElementById("instructions").style.display = 'block';
			if (display_text.indexOf("!complaint!") != -1)
				document.getElementById("complaint").style.display = 'block';
			
			display_text = display_text.replace("!name!", '');
			display_text = display_text.replace("!notes!", '');
			display_text = display_text.replace("!address!", '');
			display_text = display_text.replace("!city!", '');
			display_text = display_text.replace("!job!", '');
			display_text = display_text.replace("!email!", '');
			display_text = display_text.replace("!cell_phone!", '');
			display_text = display_text.replace("!home_phone!", '');
			display_text = display_text.replace("!salesperson!", '');
			display_text = display_text.replace("!referred_by!", '');
			display_text = display_text.replace("!appointment_date!", '');
			display_text = display_text.replace("!appointment_time!", '');
			display_text = display_text.replace("!quote!", '');
			display_text = display_text.replace("!instructions!", '');
			display_text = display_text.replace("!complaint!", '');
			
			display_text = display_text.replace("$name$", $cust_name);
			display_text = display_text.replace("$notes$", $cust_notes);
			display_text = display_text.replace("$address$", $cust_address);
			display_text = display_text.replace("$city$", $cust_city);
			display_text = display_text.replace("$job$", $cust_job);
			display_text = display_text.replace("$email$", $cust_email);
			display_text = display_text.replace("$cell_phone$", $cust_cell_phone);
			display_text = display_text.replace("$home_phone$", $cust_home_phone);
			display_text = display_text.replace("$salesperson$", $cust_salesperson);
			display_text = display_text.replace("$referred_by$", $cust_referred_by);
			display_text = display_text.replace("$appointment_date$", $cust_appointment_date);
			display_text = display_text.replace("$appointment_time$", $cust_appointment_time);
			display_text = display_text.replace("$quote$", $cust_quote);
			display_text = display_text.replace("$instructions$", $cust_instruction);
			display_text = display_text.replace("$complaint$", $cust_complaint);
			
			document.getElementById("project_scripts_display_box").innerHTML = display_text;
		}
	}
}

function edit_csr_projects_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var project_name_old  = document.getElementById('project_name').value;
	var project_name  = document.getElementById('csr_projects').value;
	
	var url = install_folder+"/business_logic/admin/csr_scripts/edit_csr_projects_save.php";
	var params = "project_name_old="+project_name_old+"&project_name="+project_name+"&type_flag="+type_flag;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_csr_projects_save_response;
	xmlHttp.send(params);
}

function edit_csr_projects_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}


function csr_projects_gen_report()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	
	var url = install_folder+"/business_logic/admin/create_pdf.php";
	
	$cust_name = document.getElementById("csr_input_name").value;
	$cust_notes = document.getElementById("csr_input_notes").value;
	$cust_address = document.getElementById("csr_input_address").value;
	$cust_city = document.getElementById("csr_input_city").value;
	$cust_job = document.getElementById("csr_input_job").value;
	$cust_email = document.getElementById("csr_input_email").value;
	$cust_cell_phone = document.getElementById("csr_input_cell_phone").value;
	$cust_home_phone = document.getElementById("csr_input_home_phone").value;
	$cust_salesperson = document.getElementById("csr_input_salesperson").value;
	$cust_referred_by = document.getElementById("csr_input_referred_by").value;
	$cust_appointment_date = document.getElementById("csr_input_appointment_date").value;
	$cust_appointment_time = document.getElementById("csr_input_appointment_time").value;
	$cust_quote = document.getElementById("csr_input_quote").value;
	$cust_instruction = document.getElementById("csr_input_instructions").value;
	$cust_complaint = document.getElementById("csr_input_complaint").value;
	
	var params = "cust_name=" +$cust_name+
			"&cust_notes=" +$cust_notes+
			"&cust_address=" +$cust_address+
			"&cust_city=" +$cust_city+
			"&cust_job=" +$cust_job+
			"&cust_email=" +$cust_email+
			"&cust_cell_phone=" +$cust_cell_phone+
			"&cust_home_phone=" +$cust_home_phone+
			"&cust_salesperson=" +$cust_salesperson+
			"&cust_referred_by=" +$cust_referred_by+
			"&cust_appointment_date=" +$cust_appointment_date+
			"&cust_appointment_time=" +$cust_appointment_time+
			"&cust_quote=" +$cust_quote+
			"&cust_instruction=" +$cust_instruction+
			"&cust_complaint=" +$cust_complaint;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=csr_projects_gen_report_response;
	xmlHttp.send(params);
}

function csr_projects_gen_report_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert('Report generated - click link below to view report');
			var pdf_link = '<a href="'+install_folder+'/business_logic/admin/'+display_text+'" download="order.pdf">Download Order PDF</a>';
			document.getElementById('report_pdf_link').innerHTML = pdf_link;
		}
	}
}

function edit_csr_projects_delete(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var project_name_old  = document.getElementById('project_name').value;
	var csr_projects  = document.getElementById('csr_projects').value;
	
	var url = install_folder+"/business_logic/admin/csr_scripts/edit_csr_projects_delete.php";
	var params = "project_name_old="+project_name_old+"&project_name="+project_name+"&type_flag="+type_flag;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_csr_projects_delete_response;
	xmlHttp.send(params);
}

function edit_csr_projects_delete_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}



function input_script_row_show()
{
	document.getElementById("input_script_row").style.display = 'block';
	document.getElementById("registerBtn3").style.display = 'none';
}

function input_script_row_hide()
{
	document.getElementById("input_script_row").style.display = 'none';
	document.getElementById("registerBtn3").style.display = 'block';
	document.getElementById("script_text_input_field").value = "";
}

function add_new_script(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var script_text  = document.getElementById('script_text_input_field').value;
	var first_script  = document.getElementById('first_script').checked;
    if (first_script)
    	first_script = 1;
	var project_name  = document.getElementById('project_name_scripts').value;
	var subproject_name  = document.getElementById('subproject_name_scripts').value;

	
	var url = install_folder+"/business_logic/admin/csr_scripts/add_new_script.php";
	var params = "project_name="+project_name+"&subproject_name="+subproject_name+"&type_flag="+type_flag+"&first_script="+first_script+"&script_text="+script_text;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_new_script_response;
	xmlHttp.send(params);
}

function add_new_script_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			input_script_row_hide();
			location.reload();
		}
	}
}

function csr_project_scripts(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var project_name  = document.getElementById('project_name_scripts').value;
	var subproject_name  = document.getElementById('subproject_name_scripts').value;
	
	var url = install_folder+"/business_logic/admin/csr_scripts/csr_get_scripts.php";
	var params = "project_name="+project_name+"&type_flag="+type_flag+"&subproject_name="+subproject_name;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=csr_project_scripts_response;
	xmlHttp.send(params);
}

function csr_project_scripts_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			document.getElementById("script_field").innerHTML = display_text;
			document.getElementById("project_scripts_box").style.display = 'block';
		}
	}
}

function csr_project_scripts_update_firstscript_placeholder(count)
{
	document.getElementById("project_name_scripts_firstscript_placeholder_"+count).style.display = 'none';
	document.getElementById("project_name_scripts_firstscript_"+count).style.display = 'block';
}


function csr_project_scripts_update_scripttext_placeholder(count)
{
	document.getElementById("script_text_input_field_edit_placeholder_"+count).style.display = 'none';
	document.getElementById("script_text_input_field_edit_textarea_div_"+count).style.display = 'block';
}


function add_csr_scripttext_hide(count)
{
	document.getElementById("script_text_input_field_edit_placeholder_"+count).style.display = 'block';
	document.getElementById("script_text_input_field_edit_textarea_div_"+count).style.display = 'none';
}


function csr_project_scripts_update_nexttext_placeholder(count)
{
	document.getElementById("nextscript_input_field_edit_"+count).style.display = 'block';
	//document.getElementById("nextscript_input_field_edit__placerholder"+count).style.display = 'none';
}


function csr_nextscript_show_add(count)
{
	document.getElementById("add_nextscript_input_box_"+count).style.display = 'block';
	document.getElementById("add_nextscript_input_button_"+count).style.display = 'none';
}

function csr_nextscript_cancel(count)
{
	document.getElementById("add_nextscript_input_box_"+count).style.display = 'none';
	document.getElementById("add_nextscript_input_button_"+count).style.display = 'block';
}

function csr_nextscript_add(count, script_id)
{	
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	var nextscript_button_text = document.getElementById("add_nextscript_input_id_"+count).value;
	var nextscript_id = document.getElementById("project_scripts_list_"+count).value;
	
	
	
	var url = install_folder+"/business_logic/admin/csr_scripts/csr_nextscript_add.php";
	var params = "button_text="+nextscript_button_text+"&script_id="+script_id+"&next_script_id="+nextscript_id+"&button_count="+count;
	document.getElementById("add_nextscript_input_box_"+count).style.display = 'none';
	document.getElementById("add_nextscript_input_button_"+count).style.display = 'block';

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=csr_nextscript_add_response;
	xmlHttp.send(params);
}

function csr_nextscript_add_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			csr_nextscript_cancel(display_text);
		}
	}
}

function csr_nextscript_delete(count, script_id, next_script_id)
{	
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	var url = install_folder+"/business_logic/admin/csr_scripts/csr_nextscript_delete.php";
	var params = "script_id="+script_id+"&next_script_id="+next_script_id;
	document.getElementById("nextscript_table_delete_row_"+count).style.display = 'none';

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=csr_nextscript_delete_response;
	xmlHttp.send(params);
}

function csr_nextscript_delete_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;
		}
	}
}

function add_csr_scripttext_save(count)
{	
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var id = document.getElementById("project_name_scripts_firstscript_id_"+count).innerHTML;
	var script_text = document.getElementById("script_text_input_field_edit_"+count).value;
	
	var url = install_folder+"/business_logic/admin/csr_scripts/add_csr_scripttext_save.php";
	var params = "id="+id+"&script_text="+script_text;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_csr_scripttext_save_response;
	xmlHttp.send(params);
	
	document.getElementById("script_text_input_field_edit_placeholder_"+count).innerHTML = document.getElementById("script_text_input_field_edit_"+count).value;;
	document.getElementById("script_text_input_field_edit_textarea_div_"+count).style.display = 'none';
	document.getElementById("script_text_input_field_edit_placeholder_"+count).style.display = 'block';
}

function add_csr_scripttext_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;
		}
	}
}

function add_csr_scripttext_delete(count)
{	
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var id = document.getElementById("project_name_scripts_firstscript_id_"+count).innerHTML;
	var script_text = document.getElementById("script_text_input_field_edit_"+count).value;
	
	var url = install_folder+"/business_logic/admin/csr_scripts/add_csr_scripttext_delete.php";
	var params = "id="+id+"&script_text="+script_text;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_csr_scripttext_delete_response;
	xmlHttp.send(params);
	
	document.getElementById("script_text_input_field_edit_placeholder_"+count).innerHTML = document.getElementById("script_text_input_field_edit_"+count).value;;
	document.getElementById("script_text_input_field_edit_textarea_div_"+count).style.display = 'none';
	document.getElementById("script_text_input_field_edit_placeholder_row_"+count).style.display = 'none';
}

function add_csr_scripttext_delete_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;
		}
	}
}

function csr_project_scripts_update_firstscript(count)
{
	var new_count = 0;
	var test_node = document.getElementById("project_name_scripts_firstscript_placeholder_"+new_count);
	
	while (test_node != null)
	{
		if (new_count != count)
			test_node.innerHTML = 'No';
		new_count++;
		test_node = document.getElementById("project_name_scripts_firstscript_placeholder_"+new_count);
	}
	
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var id = document.getElementById("project_name_scripts_firstscript_id_"+count).innerHTML;
	var project_name  = document.getElementById('project_name_scripts').value;
	
	var url = install_folder+"/business_logic/admin/csr_scripts/csr_set_firstscript.php";
	var params = "id="+id+"&project_name="+project_name;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=csr_project_scripts_update_firstscript_response;
	xmlHttp.send(params);
	
	document.getElementById("project_name_scripts_firstscript_placeholder_"+count).innerHTML = document.getElementById("project_name_scripts_firstscript_"+count).value;;
	document.getElementById("project_name_scripts_firstscript_"+count).style.display = 'none';
	document.getElementById("project_name_scripts_firstscript_placeholder_"+count).style.display = 'block';
}

function csr_project_scripts_update_firstscript_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;
		}
	}
}


function add_csr_projects_show(type_flag)
{
	document.getElementById("add_field").style.display = 'block';
}

function add_csr_projects_hide(type_flag)
{
	document.getElementById("add_field").style.display = 'none';
	
}

function add_csr_projects_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var csr_projects  = document.getElementById('add_csr_projects').value;
	
	var url = install_folder+"/business_logic/admin/csr_scripts/add_csr_projects_save.php";
	var params = "csr_projects="+csr_projects+"&type_flag="+type_flag;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_csr_projects_save_response;
	xmlHttp.send(params);
}

function add_csr_projects_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}


/*********************************** End of Feature Demos *********************************/

function banner_advert_update(id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var ad_name  = document.getElementById('title').value;
	var ad_image  = document.getElementById('image_url').value;
	var ad_link  = document.getElementById('url_link').value;
	
	var url = "../admin/banner_advert_update.php";
	var params = "id="+id+"&ad_name="+ad_name+"&ad_image="+ad_image+"&ad_link="+ad_link;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=banner_advert_update_response;
	xmlHttp.send(params);
}

function banner_advert_update_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);

			window.location.href = "../admin/banner_adverts_management.php";
		}
	}
}

function testimonials_update(id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var ad_name  = document.getElementById('title').value;
	var ad_image  = document.getElementById('image_url').value;
	var ad_link  = document.getElementById('url_link').value;
	
	var url = "../admin/testimonials_update.php";
	var params = "id="+id+"&testimonial_name="+ad_name+"&testimonial_image="+ad_image+"&testimonial_text="+ad_link;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=testimonials_update_response;
	xmlHttp.send(params);
}

function testimonials_update_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);

			window.location.href = "../admin/testimonials_management.php";
		}
	}
}


function set_region()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var region_name  = document.getElementById('state_list').value;
	
	var url = "/business_logic/process/set_region.php";
	var params = "region="+region_name;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=set_region_response;
	xmlHttp.send(params);
}

function set_region_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			location.reload();
		}
	}
}

function search_results_update(page_number, search_type, display_type)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}
	
	if (display_type != 1 && display_type != 2)
		display_type = search_display_mode;
	else
		search_display_mode = display_type;
	
	var url = "../paginate/get_search_results.php";
	var params = "page_number="+page_number+"&search_type="+search_type+"&display_type="+display_type;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=search_results_update_response;
	xmlHttp.send(params);
}

function search_results_update_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			document.getElementById('search_results_data').innerHTML = display_text;
		}
	}
}


function print_proposal(event, package_type, action, pdf_path_tmp)
{
	var pdf_path = pdf_path_tmp;

	event.stopPropagation();

	
	if (action == 1)
	{			
		var wnd = window.open(pdf_path);
		wnd.print();
	}
	else if (action == 2)
	{
		var wnd = window.open(pdf_path);
		wnd.print();
	}
	else if ( (action == 3) || (action == 4) )
	{
		var url = "../sales_tool/email_proposal.php";
		//alert('Test Alert');

	    $.post(url,
	    {
	    	pdf_path: pdf_path
	    },
	    function(data,status){
	    	alert(data);
	    });
	}
}


/**** salesperson */
function add_companies_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById('field_1_add').value;
	var field_2_add = document.getElementById('field_2_add').value;
	var field_3_add = document.getElementById('field_3_add').value;
	var field_4_add = document.getElementById('field_4_add').value;
	var field_5_add = document.getElementById('field_5_add').value;
	var field_6_add = document.getElementById('field_6_add').value;
	
	if (field_1_add == '')
	{
		alert('Please enter a company name');
		return;
	}
		
	
	var url = "../admin/add_companies.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_companies_save_response;
	xmlHttp.send(params);
}

function add_companies_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function edit_companies_get()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("companies_id").value;
	if (field_1_add == '')
	{
		document.getElementById("edit_companies_form").style.display = 'none';
		document.getElementById("registerBtn2").style.display = 'none';
		document.getElementById("cancelBtn2").style.display = 'none';
		exit;
	}
		
	
	var url = "../admin/get_companies.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_companies_get_response;
	xmlHttp.send(params);
}

function edit_companies_get_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			var SplitResult = display_text.split("<<<!separator!>>>");
			document.getElementById('field_1_update').value = SplitResult[0];
			document.getElementById('field_2_update').value = SplitResult[1];
			document.getElementById('field_3_update').value = SplitResult[2];
			document.getElementById('field_4_update').value = SplitResult[3];
			document.getElementById('field_5_update').value = SplitResult[4];
			document.getElementById('field_6_update').value = SplitResult[5];
			
			document.getElementById("edit_companies_form").style.display = 'block';
			document.getElementById("registerBtn2").style.display = 'block';
			document.getElementById("cancelBtn2").style.display = 'block';
		}
	}
}


function edit_material_lists_get()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("material_lists_id").value;
	if (field_1_add == '')
	{
		document.getElementById("edit_material_lists_form").style.display = 'none';
		document.getElementById("cancelBtn2").style.display = 'none';
		document.getElementById("cancelBtn3").style.display = 'none';
		exit;
	}
		
	
	var url = "../admin/get_material_list_edit.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_material_lists_get_response;
	xmlHttp.send(params);
}

function edit_material_lists_get_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			var SplitResult = display_text.split("<<<!separator!>>>");
			document.getElementById('field_1_update').value = SplitResult[1];
			document.getElementById('field_2_update').value = SplitResult[0];
			
			document.getElementById("edit_material_lists_form").style.display = 'block';
			document.getElementById("cancelBtn2").style.display = 'block';
			document.getElementById("cancelBtn3").style.display = 'block';
		}
	}
}


function update_material_lists_delete()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("material_lists_id").value;
	if (field_1_add == '')
	{
		document.getElementById("edit_material_lists_form").style.display = 'none';
		document.getElementById("cancelBtn2").style.display = 'none';
		document.getElementById("cancelBtn3").style.display = 'none';
		exit;
	}
		
	
	var url = "../admin/update_material_lists_delete.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=update_material_lists_delete_response;
	xmlHttp.send(params);
}

function update_material_lists_delete_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function add_default_materials()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("default_material_lists_id").value;
	if (field_1_add == '')
	{
		alert("Please choose a default list to load");
		exit;
	}
		
	
	var url = "../admin/PHPExcel/Documentation/Examples/Reader/enter_company_material_items.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_default_materials_response;
	xmlHttp.send(params);
}

function add_default_materials_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			location.reload();
		}
	}
}

function update_material_lists_cancel()
{
	document.getElementById("edit_material_lists_form").style.display = 'none';
	document.getElementById("cancelBtn2").style.display = 'none';
	document.getElementById("cancelBtn3").style.display = 'none';
}

function update_companies_cancel()
{
	document.getElementById("edit_companies_form").style.display = 'none';
	document.getElementById("cancelBtn2").style.display = 'none';
}

function update_companies()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("field_1_update").value;
	var field_2_add = document.getElementById('field_2_update').value;
	var field_3_add = document.getElementById('field_3_update').value;
	var field_4_add = document.getElementById('field_4_update').value;
	var field_5_add = document.getElementById("field_5_update").value;
	var field_6_add = document.getElementById("field_6_update").value;
	var field_7_add = document.getElementById("companies_id").value;
	
	var url = "../admin/update_companies.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add+"&field_6_add="+field_6_add+"&field_7_add="+field_7_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=update_companies_response;
	xmlHttp.send(params);
}

function update_companies_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}


function set_companies_session_license()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("companies_list_id").value;
	
	var url = "../admin/set_companies_session.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=set_companies_session_license_response;
	xmlHttp.send(params);
}

function set_companies_session_license_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			document.getElementById("companies_list_item").innerHTML = display_text;
			get_companies_session_license();
		}
	}
}

function get_companies_session_license()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	
	var url = "../admin/get_license.php";
	var params = "";

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=get_companies_session_license_response;
	xmlHttp.send(params);
}

function get_companies_session_license_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			document.getElementById("license_field").innerHTML = display_text;
		}
	}
}
/**************/

function set_companies_session_administrator()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("companies_list_id").value;
	
	var url = "../admin/set_companies_session.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=set_companies_session_administrator_response;
	xmlHttp.send(params);
}

function set_companies_session_administrator_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			document.getElementById("companies_list_item").innerHTML = display_text;
			get_companies_session_administrator();
		}
	}
}

function get_companies_session_administrator()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	
	var url = "../admin/get_administrator_details.php";
	var params = "";

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=get_companies_session_administrator_response;
	xmlHttp.send(params);
}

function get_companies_session_administrator_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			document.getElementById("administrator_field").innerHTML = display_text;
		}
	}
}

/********************************/

function add_admins_save(type_flag)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById('field_1_add').value;
	var field_2_add = document.getElementById('field_2_add').value;
	var field_3_add = document.getElementById('field_3_add').value;
	var field_4_add = document.getElementById('field_4_add').value;
	var field_5_add = document.getElementById('field_5_add').value;
	
	if (field_1_add == '')
	{
		alert('Please enter the administrators name');
		return;
	}
	if (field_2_add == '')
	{
		alert('Please enter the administrators surname');
		return;
	}
	if (field_3_add == '')
	{
		alert('Please enter an administrators email');
		return;
	}
	if (field_4_add == '')
	{
		alert('Please enter an administrators password');
		return;
	}
	if (field_4_add != field_5_add)
	{
		alert('Error: passwords do not match');
		return;
	}
		
	
	var url = "../admin/add_admins.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_admins_save_response;
	xmlHttp.send(params);
}

function add_admins_save_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function edit_admins_get()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("admins_id").value;
	if (field_1_add == '')
	{
		document.getElementById("edit_admins_form").style.display = 'none';
		document.getElementById("registerBtn2").style.display = 'none';
		document.getElementById("cancelBtn2").style.display = 'none';
		exit;
	}
		
	
	var url = "../admin/get_admins.php";
	var params = "field_1_add="+field_1_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=edit_admins_get_response;
	xmlHttp.send(params);
}

function edit_admins_get_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			var SplitResult = display_text.split("<<<!separator!>>>");
			document.getElementById('field_1_update').value = SplitResult[0];
			document.getElementById('field_2_update').value = SplitResult[1];
			document.getElementById('field_3_update').value = SplitResult[2];
			document.getElementById('field_4_update').value = SplitResult[3];
			
			document.getElementById("edit_admins_form").style.display = 'block';
			document.getElementById("registerBtn2").style.display = 'block';
			document.getElementById("cancelBtn2").style.display = 'block';
		}
	}
}


function update_admins_cancel()
{
	document.getElementById("edit_admins_form").style.display = 'none';
	document.getElementById("registerBtn2").style.display = 'none';
	document.getElementById("cancelBtn2").style.display = 'none';
}

function update_admins()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("field_1_update").value;
	var field_2_add = document.getElementById('field_2_update').value;
	var field_3_add = document.getElementById('field_3_update').value;
	var field_4_add = document.getElementById('field_4_update').value;
	var field_6_add = document.getElementById('field_6_update').value;
	var field_5_add = document.getElementById("admins_id").value;
	

	if (field_4_add != field_6_add)
	{
		alert('Error: passwords do not match');
		return;
	}
	
	var url = "../admin/update_admins.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=update_admins_response;
	xmlHttp.send(params);
}

function update_admins_response() 
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}

function add_edit_materials(action, id)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = action;
	var field_2_add = id;
	var tmp_var1 = "field_3_update_"+id;
	var tmp_var2 = "field_4_update_"+id;
	var tmp_var3 = "field_5_update_"+id;
	
	if (action == 0)
	{
		var field_3_add = document.getElementById(tmp_var1).value;
		var field_4_add = document.getElementById(tmp_var2).value;
		var field_5_add = document.getElementById(tmp_var3).value;
	}
	else
	{
		var field_3_add = '';
		var field_4_add = '';
		var field_5_add = '';
	}
	
	var url = "../admin_tool/add_edit_materials.php";
	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add+"&field_5_add="+field_5_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=add_edit_materials_response;
	xmlHttp.send(params);
}

function add_edit_materials_response()
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			var SplitResult = display_text.split("<<<!separator!>>>");
			var action = SplitResult[0];
			var material_id = SplitResult[1];
			var row_id = "material_row_id_"+material_id;
			
			if (action == 1)
			{
				document.getElementById(row_id).style.display = 'none';
			}
		}
	}
}

function choose_license_type()
{
	var license_type = document.getElementById("license_type_id").value;
	
	if (license_type == '')
	{
		document.getElementById("paypal-info1").style.display="none";
		document.getElementById("paypal-info2").style.display="none";
		document.getElementById("paypal-info3").style.display="none";
		document.getElementById("paypal-info4").style.display="none";
	}
	else if (license_type == 1)
	{
		document.getElementById("paypal-info1").style.display="block";
		document.getElementById("paypal-info2").style.display="none";
		document.getElementById("paypal-info3").style.display="none";
		document.getElementById("paypal-info4").style.display="none";
	}
	else if (license_type == 3)
	{
		document.getElementById("paypal-info1").style.display="none";
		document.getElementById("paypal-info2").style.display="block";
		document.getElementById("paypal-info3").style.display="none";
		document.getElementById("paypal-info4").style.display="none";
	}
	else if (license_type == 6)
	{
		document.getElementById("paypal-info1").style.display="none";
		document.getElementById("paypal-info2").style.display="none";
		document.getElementById("paypal-info3").style.display="block";
		document.getElementById("paypal-info4").style.display="none";
	}
	else if (license_type == 12)
	{
		document.getElementById("paypal-info1").style.display="none";
		document.getElementById("paypal-info2").style.display="none";
		document.getElementById("paypal-info3").style.display="none";
		document.getElementById("paypal-info4").style.display="block";
	}
}

function save_recurring_var()
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var recurring  = document.getElementById('optradio1').checked;
    if (recurring)
    	recurring = 1;
    else
    	recurring = 0;
	
	var url = "../admin_tool/save_recurring_var.php";
	var params = "field_1_add="+recurring;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=save_recurring_var_response;
	xmlHttp.send(params);
}

function save_recurring_var_response()
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			;
		}
	}
}


function delete_subcontractor(id_var)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	
	var url = "../sales_tool/delete_subcontractor.php";
	var params = "field_1_add="+id_var;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=delete_subcontractor_response;
	xmlHttp.send(params);
}

function delete_subcontractor_response()
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
			location.reload();
		}
	}
}


function update_subscriptions(id_var)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
 	{
  		alert ("Browser does not support HTTP Request")
  		return
  	}

	var field_1_add = document.getElementById("field_1_add").value;
	var field_2_add = document.getElementById('field_2_add').value;
	var field_3_add = document.getElementById('field_3_add').value;
	var field_4_add = document.getElementById('field_4_add').value;

	var url = "../admin/update_subscriptions.php";

	var params = "field_1_add="+field_1_add+"&field_2_add="+field_2_add+"&field_3_add="+field_3_add+"&field_4_add="+field_4_add;

	xmlHttp.open("POST", url, true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.onreadystatechange=update_subscriptions_response;
	xmlHttp.send(params);
}

function update_subscriptions_response()
{ 
	if (xmlHttp.readyState==4 && xmlHttp.status == 200)
	{
		var display_text = xmlHttp.responseText;
		
		if (display_text == 'ERROR')
		{
			;
		}
		else
		{
			alert(display_text);
		}
	}
}

function removeHighlighting(highlightedElements){
    highlightedElements.each(function(){
        var element = $(this);
        element.replaceWith(element.html());
    })
}

function addHighlighting(element, textToHighlight){
    var text = element.text();
    var highlightedText = '<em>' + textToHighlight + '</em>';
    var newText = text.replace(textToHighlight, highlightedText);
    
    element.html(newText);
}


function search_materials_list()
{
	var search_term = document.getElementById('search_materials').value;
	
	//var search_term_var = ":contains(" + search_term + ")";
	//var rows = $('table tr').hide().filter(search_term_var).show();

	var value = search_term;
	value = value.toLowerCase();
	
	//removeHighlighting($("table tr em"));

    $("table tr").each(function(index) {
        if (index !== 0) {
            $row = $(this);
            
            var $tdElement = $row.find("td:nth-child(3)");
            var target_string = $tdElement.context.cells[2].innerHTML;
            var target_string=target_string.substring(target_string.lastIndexOf("value=\"")+7, target_string.lastIndexOf("\">"));
            var matchedIndex1 = target_string.toLowerCase().indexOf(value);
            
            $tdElement = $row.find("td:nth-child(4)");
            target_string = $tdElement.context.cells[3].innerHTML;
            target_string=target_string.substring(target_string.lastIndexOf("value=\"")+7, target_string.lastIndexOf("\">"));
            var matchedIndex2 = target_string.toLowerCase().indexOf(value);
            
            if (matchedIndex1 == -1 && matchedIndex2 == -1) {
                $row.hide();
            }
            else {
                //addHighlighting($tdElement, value);
                $row.show();
            }
        }
    });
}

function search_materials_list_sales()
{
	var value1 = document.getElementById('search_materials_sales_1').value;
	value1 = value1.toLowerCase();
	var value2 = document.getElementById('search_materials_sales_2').value;
	value2 = value2.toLowerCase();
	var value3 = document.getElementById('search_materials_sales_3').value;
	value3 = value3.toLowerCase();
	
	if (value1 !== '')
		document.getElementById("materials_table_1").style.display = "block";
	else
		document.getElementById("materials_table_1").style.display = "none";
	
	if (value2 !== '')
		document.getElementById("materials_table_2").style.display = "block";
	else
		document.getElementById("materials_table_2").style.display = "none";
	
	if (value3 !== '')
		document.getElementById("materials_table_3").style.display = "block";
	else
		document.getElementById("materials_table_3").style.display = "none";


    $("#materials_table_1 tr").each(function(index) {
        if (index !== 0) {
            $row = $(this);
            
            var value = value1;
            var $tdElement = $row.find("td:nth-child(3)");
            var target_string = $tdElement.context.cells[2].innerHTML;
            var target_string=target_string.substring(target_string.lastIndexOf("value=\"")+7, target_string.lastIndexOf("\">"));
            var matchedIndex1 = target_string.toLowerCase().indexOf(value);
            
            $tdElement = $row.find("td:nth-child(4)");
            target_string = $tdElement.context.cells[3].innerHTML;
            target_string=target_string.substring(target_string.lastIndexOf("value=\"")+7, target_string.lastIndexOf("\">"));
            var matchedIndex2 = target_string.toLowerCase().indexOf(value);
            
            if (matchedIndex1 == -1 && matchedIndex2 == -1) {
                $row.hide();
            }
            else {
                //addHighlighting($tdElement, value);
                $row.show();
            }
        }
    });
    
    $("#materials_table_2 tr").each(function(index) {
        if (index !== 0) {
            $row = $(this);

            var value = value2;
            var $tdElement = $row.find("td:nth-child(3)");
            var target_string = $tdElement.context.cells[2].innerHTML;
            var target_string=target_string.substring(target_string.lastIndexOf("value=\"")+7, target_string.lastIndexOf("\">"));
            var matchedIndex1 = target_string.toLowerCase().indexOf(value);
            
            $tdElement = $row.find("td:nth-child(4)");
            target_string = $tdElement.context.cells[3].innerHTML;
            target_string=target_string.substring(target_string.lastIndexOf("value=\"")+7, target_string.lastIndexOf("\">"));
            var matchedIndex2 = target_string.toLowerCase().indexOf(value);
            
            if (matchedIndex1 == -1 && matchedIndex2 == -1) {
                $row.hide();
            }
            else {
                //addHighlighting($tdElement, value);
                $row.show();
            }
        }
    });
    
    $("#materials_table_3 tr").each(function(index) {
        if (index !== 0) {
            $row = $(this);

            var value = value3;
            var $tdElement = $row.find("td:nth-child(3)");
            var target_string = $tdElement.context.cells[2].innerHTML;
            var target_string=target_string.substring(target_string.lastIndexOf("value=\"")+7, target_string.lastIndexOf("\">"));
            var matchedIndex1 = target_string.toLowerCase().indexOf(value);
            
            $tdElement = $row.find("td:nth-child(4)");
            target_string = $tdElement.context.cells[3].innerHTML;
            target_string=target_string.substring(target_string.lastIndexOf("value=\"")+7, target_string.lastIndexOf("\">"));
            var matchedIndex2 = target_string.toLowerCase().indexOf(value);
            
            if (matchedIndex1 == -1 && matchedIndex2 == -1) {
                $row.hide();
            }
            else {
                //addHighlighting($tdElement, value);
                $row.show();
            }
        }
    });
}

function sales_search_materials_list()
{
	var search_term = document.getElementById('search_materials').value;
	
	//var search_term_var = ":contains(" + search_term + ")";
	//var rows = $('table tr').hide().filter(search_term_var).show();

	var value = search_term;
	value = value.toLowerCase();
	
	//removeHighlighting($("table tr em"));
	//select id=materials_proposal_platinum_id

	$(function() {
        $('input.search_materials').on('change', function() {
             $(this).prev('select.term').find('option:not(:containsi(' + this.value + '))').hide();
         }).on('keyup', function() {
             $(this).prev('select.term').find('option:containsi(' + this.value + ')').show().attr('selected', true);
         }).extend($.expr[':'], {
         'containsi' : function(elem, i, match, array) {
             return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || '').toLowerCase()) >= 0;
         }
     });
 });
}

function toggle_edit_matrix()
{
	//document.getElementById('show_matrix_box').style.display = 'block';
	$("#show_matrix_box").toggle();
}
