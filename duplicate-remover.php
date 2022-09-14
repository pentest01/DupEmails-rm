<script>

var fieldtoclipboard = {
	tooltipobj: null,
	hidetooltiptimer: null,

	createtooltip:function(){
		var tooltip = document.createElement('div')
		tooltip.style.cssText = 
			'position:absolute; background:black; color:white; padding:4px;z-index:10000;'
			+ 'border-radius:3px; font-size:12px;box-shadow:3px 3px 3px rgba(0,0,0,.4);'
			+ 'opacity:0;transition:opacity 0.3s'
		tooltip.innerHTML = 'Copied!'
		this.tooltipobj = tooltip
		document.body.appendChild(tooltip)
	},

	showtooltip:function(e){
		var evt = e || event
		clearTimeout(this.hidetooltiptimer)
		this.tooltipobj.style.left = evt.pageX - 10 + 'px'
		this.tooltipobj.style.top = evt.pageY + 15 + 'px'
		this.tooltipobj.style.opacity = 1
		this.hidetooltiptimer = setTimeout(function(){
			fieldtoclipboard.tooltipobj.style.opacity = 0
		}, 700) // time in milliseconds before tooltip disappears
	},

	selectelement:function(el){
    var range = document.createRange() // create new range object
    range.selectNodeContents(el)
    var selection = window.getSelection() // get Selection object from currently user selected text
    selection.removeAllRanges() // unselect any user selected text (if any)
    selection.addRange(range) // add range to Selection object to select it
	},
	
	copyfield:function(e, fieldref, callback){
		var field = (typeof fieldref == 'string')? document.getElementById(fieldref) : fieldref
		callbackref = callback || function(){}
		if (/(textarea)|(input)/i.test(field) && field.setSelectionRange){
			field.focus()
			field.setSelectionRange(0, field.value.length) // for iOS sake
		}
		else if (field && document.createRange){
			this.selectelement(field)
		}
		else if (field == null){ // copy currently selected text on document
			field = {value:null}
		}
		var copysuccess // var to check whether execCommand successfully executed
		try{
			copysuccess = document.execCommand("copy")
		}catch(e){
			copysuccess = false
		}
		if (copysuccess){ // execute desired code whenever text has been successfully copied
			if (e){
				this.showtooltip(e)
			}
			callbackref(field.value || window.getSelection().toString())
		}
		return false
	},


	init:function(){
		this.createtooltip()
	}
}

fieldtoclipboard.init()


</script>

	
</head>
<body>
<div style="max-width: 97%;width:500px;margin:10px auto 30px">
	
<h1 style="font-size: 15px;">Paste Output here to Remove All Duplicates</h1>
 
<textarea name="search" rows="5" style="width:100%;border:1px solid #00ffff;color:#00ffff" id="dupsy" placeholder="Paste Output Here..."></textarea>
<!-- <input type="text" name="removestrings" placeholder="Add texts separated by comma to remove extra texts. E.g www.,http://,Email-"></input> -->
<p style="color:#d0c32b;"><i id="emailtotal">0</i> Emails Extracted | <i id="uniqueemails">0</i> Unique Emails Found | <i id="dupemails">0</i> Duplicate Emails Removed</p>
<textarea name="removestrings" id="select4" rows="3" style="width:100%;" placeholder="Add texts separated by comma to remove extra texts. E.g www.,Email-"></textarea>

<button class="button" id="dupnow" type="button"  style="background:#9f9305;" name="submit" >Remove Duplicates</button> <BUTTON class="button"  onClick="return fieldtoclipboard.copyfield(event, 'select4');" style="background:#440606;">Copy to Clipboard</BUTTON> 

</div>