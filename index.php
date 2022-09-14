<HTML>
<HEAD>
	<link rel="icon" href="images/mainlogo.gif">

	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<SCRIPT LANGUAGE="JAVASCRIPT" TYPE="text/javascript">
<!-- Begin

// Created and Copyrighted by Benjamin Leow
// Please go to http://www.surf7.net for latest version and more freeware

function copy() {
textRange = document.extractor.output.createTextRange();
textRange.execCommand("RemoveFormat");
textRange.execCommand("Copy");
}

function paste() {
textRange = document.extractor.input.createTextRange();
textRange.execCommand("RemoveFormat");
textRange.execCommand("Paste");
}

function help(){

var imgwid = 450;
var imghgt = 360;

content = ('<html><head><title>Email Extractor Lite : Help</title>');
content += ('<STYLE TYPE="text/css">');
content += ('BODY,td,th,ul,p       { font: normal normal normal 8pt/1em Verdana; color: #000; }');
content += ('</STYLE>');
content += ('</head><body onload="window.focus();">');
content += ('<B>Quick and dirty</B>');
content += ('<OL>');
content += ('<LI>Copy all text from any webpages, documents, files, etc...');
content += ('<LI>Paste it into <B>Input Window</B>.');
content += ('<LI>Click "<I>Extract</I>" button.');
content += ('<LI>Copy the result from <B>Output Window</B> to somewhere and save it.');
content += ('<LI>Click "<I>Reset</I>" button to start all over again.');
content += ('</OL>');
content += ('<P><B>More Controls</B>');
content += ('<OL>');
content += ('<LI>Click "<I>Paste Input</I>" link to paste any text you copied elsewhere into <B>Input Window</B>.');
content += ('<LI>Click "<I>Copy Output</I>" link to copy whatever text inside <B>Output Window</B>.');
content += ('<LI>Choose different separator from the dropdown menu or specify your own. Default is comma.');
content += ('<LI>You can group a number of emails together. Each group is separated by a new line. Please enter number only.');
content += ('<LI>Check "<I>Sort Alphabetically</I>" checkbox to arrange extracted emails well... alphabetically.');
content += ('<LI>You can extract or exclude emails containing certain string (text). Useful if you only want to get email from a particular domain.');
content += ('<LI>You can choose to extract web addresses instead of email addresses.');
content += ('</OL>');
content += ('<DIV ALIGN="CENTER"><INPUT TYPE="button" VALUE="Close" onClick="javascript:window.close();"></DIV>');
content += ('</body></html>');

var winl = (screen.width - imgwid) / 2;
var wint = (screen.height - imghgt) / 2;
helpwindow = window.open('','help','width=' + imgwid + ',height=' + imghgt + ',resizable=0,scrollbars=0,top=' + wint + ',left=' + winl + ',toolbar=0,location=0,directories=0,status=0,menubar=0,copyhistory=0');
helpwindow.document.write(content);
helpwindow.document.close();
}

function checksep(value){
if (value) document.extractor.sep.value = "other";
}

function numonly(value){
if (isNaN(value)) {
	window.alert("Please enter a number or else \nleave blank for no grouping.");
	document.extractor.groupby.focus();
}
}

function findEmail() {
var email = "none";
var a = 0;
var ingroup = 0;
var separator = document.extractor.sep.value;
var string = document.extractor.string.value;
var groupby = Math.round(document.extractor.groupby.value);
var address_type = document.extractor.address_type.value;

if (separator == "new") separator = "\n";
if (separator == "other") separator = document.extractor.othersep.value;
if (address_type == "web") var rawemail = document.extractor.input.value.match(/(http:\/\/+[a-zA-Z0-9]+[a-zA-Z0-9-]+\.[a-zA-Z0-9._/-]+)/gi);
else var rawemail = document.extractor.input.value.toLowerCase().match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
var norepeat = new Array();
var filtermail = new Array();
if (rawemail) {
	if (string){
		x = 0;
		for (var y=0; y<rawemail.length; y++) {
			if (document.extractor.filter_type.value == 1) {
				if (rawemail[y].search(string) >= 0) {
					filtermail[x] = rawemail[y];
					x++;
				}
			} else {
				if (rawemail[y].search(string) < 0) {
					filtermail[x] = rawemail[y];
					x++;
				}
			}
		}
		rawemail = filtermail;
	}

	for (var i=0; i<rawemail.length; i++) {
		var repeat = 0;
		
		// Check for repeated emails routine
		for (var j=i+1; j<rawemail.length; j++) {
			if (rawemail[i] == rawemail[j]) {
				repeat++;
			}
		}
		
		// Create new array for non-repeated emails
		if (repeat == 0) {
			norepeat[a] = rawemail[i];
			a++;
		}
	}
	if (document.extractor.sort.checked) norepeat = norepeat.sort(); // Sort the array
	email = "";
	// Join emails together with separator
	for (var k = 0; k < norepeat.length; k++) {
		if (ingroup != 0) email += separator;
		email += norepeat[k];
		ingroup++;
		
		// Group emails if a number is specified in form. Each group will be separate by new line.
		if (groupby) {
			if (ingroup == groupby) {
				email += '\n\n';
				ingroup = 0;
			}
		}
	}
}

// Return array length
var count = norepeat.length;

// Print results
document.extractor.count.value = count;
document.extractor.output.value = email;
}
//  End -->
</SCRIPT>




<STYLE TYPE="text/css">
BODY                  { background:#222 ;opacity:0.8;}
BODY,td,th,ul,p       { font: normal normal normal 8pt/1em monospace; color: #fff; }
textarea,input,select { font: normal normal normal 8pt/1em monospace; color: #00ff00; border:1px solid #00ff00;background:#222}
A:link, A:visited     { text-decoration: none; color: #14c6b5; }
A:active, A:hover     { text-decoration: underline; color: #D14; }
fieldset              { padding-left: 10px; padding-bottom: 10px; }
.bordercolor          { background:#666 }
.maincolor            { background:#222;border:none; }
.button               { background:#8c0909;color:#fff; border:none;padding:5px;font-size:14px;}
.titlebarcolor        { background:#00ff00;padding:7px; }
.titlefont            { font: normal normal bold 9pt/1em monospace; color: #000;font-size:17px; }
.copyrightfont        { font: normal normal normal 12.5pt/1.5em monospace; color: #fff; }

header{
	width:100%;
	height:auto;
	padding:10px 0px;
	background:#000;
	border-bottom:1px solid #00ff00;
}

#logoarea{
	margin:0 auto;
	text-align:center;
}
#logoarea img{
	height:80px;
}
</STYLE>




<TITLE>Email Picker by Ben0209</TITLE>
</HEAD>
<BODY>

<header>
			<div id="logoarea"><a href="https://www.ben0209.me"><img src="images/mainlogo.gif"></a></div>
		</header>
		
		
<?php
	
// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
	echo $ipaddress;
	
?>

<DIV ALIGN="CENTER">
<FORM NAME="extractor">
<TABLE CLASS="bordercolor" CELLPADDING=1 CELLSPACING=0 BORDER=0><TR><TD>
<TABLE CLASS="maincolor" CELLPADDING=4 CELLSPACING=0 BORDER=0>
<TR CLASS="titlebarcolor" VALIGN="MIDDLE"> 
<TD><FONT CLASS="titlefont">Email Picker</FONT></TD>
<TD ALIGN="RIGHT" NOWRAP></TD>
</TR>
<TR>
<TD VALIGN="TOP" ALIGN="CENTER" WIDTH="50%">
<B>Input Window</B><BR>
<TEXTAREA NAME="input" autofocus style="border:1px solid #00ffff;color:#00ffff" rows=8 cols=50></TEXTAREA>
</TD>
<TD VALIGN="TOP" ALIGN="CENTER" WIDTH="50%">
<B>Output Window</B><BR>
<TEXTAREA NAME="output" id="outputwin" rows=8 cols=50 readonly></TEXTAREA>
</TD></TR>
<TR>
<TD VALIGN="TOP" ALIGN="CENTER">

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
if ((navigator.appName=="Microsoft Internet Explorer")&&(parseInt(navigator.appVersion)>=4)) document.write('<A HREF="javascript:paste();">Paste Input</A>');
else document.write('Paste Input');
// -->
</SCRIPT>

</TD>
<TD VALIGN="TOP" ALIGN="CENTER">

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
if ((navigator.appName=="Microsoft Internet Explorer")&&(parseInt(navigator.appVersion)>=4)) document.write('<A HREF="javascript:copy();">Copy Output</A>');
else document.write('Copy Output');
// -->
</SCRIPT>

</TD></TR>
<TR>
<TD VALIGN="TOP" ALIGN="LEFT" COLSPAN=2>
<fieldset title="Output Option">
<legend align="left"><B>Output Option</B></legend>
<BR>
Separator:
<SELECT NAME="sep">
<OPTION VALUE=", ">Comma</OPTION>
<OPTION VALUE="|">Pipe</OPTION>
<OPTION VALUE=" : ">Colon</OPTION>
<OPTION VALUE="new">New Line</OPTION>
<OPTION VALUE="other">Other</OPTION>
</SELECT>
<INPUT TYPE="TEXT" NAME="othersep" SIZE=3 onBlur="checksep(this.value)">
&nbsp;&nbsp;
Group: <INPUT TYPE="TEXT" SIZE=3 NAME="groupby" onBlur="numonly(this.value)"> Addresses
&nbsp;&nbsp;
<LABEL FOR="sortbox"><INPUT TYPE="CHECKBOX" NAME="sort" id="sortbox">Sort Alphabetically</LABEL>
</fieldset>
<BR>
<fieldset title="Filter Option">
<legend align="left"><B>Filter Option</B></legend>
<BR>
<SELECT NAME="filter_type">
<OPTION VALUE=1>Only</OPTION>
<OPTION VALUE=0>Do not</OPTION>
</SELECT>
extract address containing this string: <INPUT TYPE="TEXT" SIZE=20 NAME="string">
<BR>
<BR>
Type of address to extract: 
<SELECT NAME="address_type">
<OPTION VALUE="email">Email</OPTION>
<OPTION VALUE="web">Web</OPTION>
</SELECT>
</fieldset>
</TD></TR>
<TR>
<TD VALIGN="TOP" ALIGN="LEFT">
<INPUT TYPE="BUTTON" CLASS="button" VALUE="Extract" onClick="findEmail()"> 
<INPUT TYPE="RESET" CLASS="button" VALUE="Reset">&nbsp;&nbsp;&nbsp;
<A HREF="mailto:watsup@ben0209.me"><I>Need help?</I></A>
</TD>
<TD VALIGN="TOP" ALIGN="RIGHT" NOWRAP>
Counter: <INPUT NAME="count" SIZE=5 READONLY> <button class="button" style="background:#9f9305;" id="dupcheck" type="button" name="submit" >Check For Duplicates</button>
</TD>
</TR>
</TABLE>
</TD></TR></TABLE>
</FORM>
<BR>




<?php
	
	
	include('duplicate-remover.php');
	
	
?>

<script>

  $(document).ready(function(){
			
			$("#dupcheck").click(function(){
				var outputwiny = document.getElementById('outputwin');
			    var resbox = document.getElementById('dupsy');
			    resbox.value = outputwiny.value;
			});
  
            $("#dupnow").click(function(){

                $.ajax({
                    url: "extract.php",  
                    method:"POST",
					data:{
						  searchy: $('#dupsy').val(),
						  removestrings: ",",
						},
			
					dataType:"JSON",
					success:function(data){
                        $("#select4").val(data.newemail);
						$("#emailtotal").html(data.emailtotal);
						$("#uniqueemails").html(data.uniqueemails);
						$("#dupemails").html(data.duplicate);
                    }});
            });
   });
        </script>

<FONT CLASS="copyrightfont">MADE WITH &#128525 BY <a href="https://benjaminakindote.com">BENJAMIN AKINDOTE</a>.</FONT>
</DIV>

</BODY>
</HTML>

