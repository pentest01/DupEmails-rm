<?php
$filtered = $_POST["removestrings"];
/*$filtered_words = array(
    'www.',
    'emails-',
);*/



function extract_emails_from($string){
  preg_match_all("/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i", $string, $matches);
  return $matches[0];
}
$text = $_POST["searchy"];


/*
$trimms = implode(" ",array_unique(explode(" ", $text)));
echo $trimms;
*/
$emails = extract_emails_from($text);


$filter = explode(",", $filtered);

foreach ($filter as $key => $value) {
	
}


$emails = str_replace($filter, '', $emails);

//preg_replace( "/\r|\n/", "", $emails );

$trimmed = (implode("<br/>",$emails));


//$new = (implode("<br/>", $trimmed));

//$new = implode("<br/>",array_unique(explode("<br/>", $trimmed)));

$new = array_unique(explode("<br/>", $trimmed));

$newemail = implode(" ",$new);

$data["status"] = '14';
$data["emailtotal"] = count($emails);
$data["uniqueemails"] = count($new);
$dupes = count($emails)-count($new);
$data["duplicate"] = $dupes;
$data["newemail"] = $newemail;
		echo json_encode($data);
		exit();

?>
<div style="width: 500px;max-width:97%;    margin: 50px auto;">
<div style="font-size: 20px;font-weight: bold"><?php echo count($emails);?> Emails Extracted</div>
<div style="font-size: 20px;font-weight: bold"><?php echo count($new);?> Unique Emails Found</div>
<?php $dupes = count($emails)-count($new);
?>
<div style="font-size: 20px;font-weight: bold"><?php echo $dupes;?> Duplicate Emails Removed</div>

<div id="select4" style="width: 100%;height: 400px;padding:5px;background-color: #333;border:1px solid #00ff00;color:#00ff00;overflow-y: scroll;"><?php echo $newemail;?></div>
<div style="float:left;width:210px"><BUTTON class="button"  onClick="return fieldtoclipboard.copyfield(event, 'select4');">Copy to Clipboard</BUTTON></div>

<div style="float: right;"><BUTTON class="button" onclick="location.href='index.php';">Go Back Home</BUTTON></div>
</div>

<!-- <TEXTAREA id="copyTarget"><?php echo $new;?></TEXTAREA><button id="copyButton">Copy</button> -->
<!-- <input type="text" id="copyTarget" value="<?php echo (implode ( "<br/>",$emails));?>"> <button id="copyButton">Copy</button>
 -->














