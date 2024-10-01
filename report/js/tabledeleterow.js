// tabledeleterow.js version 1.2 2006-02-21
// mredkj.com

// CONFIG notes. Below are some comments that point to where this script can be customized.
// Note: Make sure to include a <tbody></tbody> in your table's HTML

var INPUT_NAME_PREFIX = 'inputName'; // this is being set via script
var RADIO_NAME = 'totallyrad'; // this is being set via script
var TABLE_NAME = 'dataTable'; // this should be named in the HTML
var ROW_BASE = 0; // first number (for display)
var hasLoaded = false;
var nRow = 0;

window.onload=fillInRows;

function fillInRows()
{
	hasLoaded = true;
/*	addRowToTable();
	addRowToTable();*/
}

// CONFIG:
// myRowObject is an object for storing information about the table rows
function myRowObject(one, two, three, four)
{
	this.one = one; // text object
	this.two = two; // input text object
	this.three = three; // input checkbox object
	this.four = four; // input radio object
}

/*
 * insertRowToTable
 * Insert and reorder
 */
function insertRowToTable()
{
	if (hasLoaded) {
		var tbl = document.getElementById(TABLE_NAME);
		var rowToInsertAt = tbl.tBodies[0].rows.length;
		for (var i=0; i<tbl.tBodies[0].rows.length; i++) {
			if (tbl.tBodies[0].rows[i].myRow && tbl.tBodies[0].rows[i].myRow.four.getAttribute('type') == 'radio' && tbl.tBodies[0].rows[i].myRow.four.checked) {
				rowToInsertAt = i;
				break;
			}
		}
		addRowToTable(rowToInsertAt);
		reorderRows(tbl, rowToInsertAt);
	}
}

/*
 * addRowToTable
 * Inserts at row 'num', or appends to the end if no arguments are passed in. Don't pass in empty strings.
 */
function addRowToTable(num)
{
	if (hasLoaded) {
		var tbl = document.getElementById(TABLE_NAME);
		var nextRow = tbl.tBodies[0].rows.length;
		var iteration = nextRow + ROW_BASE;
		if (num == null) { 
			num = nextRow;
		} else {
			iteration = num + ROW_BASE;
		}
		

		var cdesc =  document.getElementById('cdesc').value;
		var ctid =  document.getElementById('ctid').value;
		var cfid =  document.getElementById('cfid').value;
		var cexit =  document.getElementById('cexit').value;

		if(cdesc == ""){alert("Please enter control description");document.getElementById('cdesc').focus();return false;}
		if(ctid == ""){alert("Please Select control type");document.getElementById('ctid').focus();return false;}
		if(cfid == ""){alert("Please Select control frequency");document.getElementById('cfid').focus();return false;}
		if(cexit == ""){alert("Please Select control exit");document.getElementById('cexit').focus();return false;}

		var cindex = document.frm.ctid.selectedIndex;
		var ctid_text = document.frm.ctid.options[cindex].text;

		var cfindex = document.frm.cfid.selectedIndex;
		var cfid_text = document.frm.cfid.options[cfindex].text;

		var ceindex = document.frm.cexit.selectedIndex;
		var cexit_text = document.frm.cexit.options[ceindex].text;

		nRow = nRow+1;
		// add the row
		var row = tbl.tBodies[0].insertRow(num);
		
		// CONFIG: requires classes named classy0 and classy1
		row.className = 'classy' + (iteration % 2);
	
		// CONFIG: This whole section can be configured
		
		var cell1 = row.insertCell(0);
		cell1.innerHTML = cdesc

		var element1 = document.createElement("input");
		element1.type = "hidden";
		element1.name = "cdescData[]";
		element1.value = cdesc;
		cell1.appendChild(element1);

		var cell2 = row.insertCell(1);
		cell2.innerHTML = ctid_text

		var element2 = document.createElement("input");
		element2.type = "hidden";
		element2.name = "ctidData[]";
		element2.value = ctid;
		cell2.appendChild(element2);

		var cell3 = row.insertCell(2);
		cell3.innerHTML = cfid_text

		var element3 = document.createElement("input");
		element3.type = "hidden";
		element3.name = "cfidData[]";
		element3.value = cfid;
		cell3.appendChild(element3);

		var cell4 = row.insertCell(3);
		cell4.innerHTML = cexit_text

		var element4 = document.createElement("input");
		element4.type = "hidden";
		element4.name = "cexitData[]";
		element4.value = cexit;
		cell4.appendChild(element4);

			
		// cell 2 - input button
		var cell5 = row.insertCell(4);
		var btnEl = document.createElement('input');
		btnEl.setAttribute('type', 'button');
		btnEl.setAttribute('value', 'Delete');
		btnEl.onclick = function () {deleteCurrentRow(this)};
		cell5.appendChild(btnEl);
		
		// Pass in the elements you want to reference later
		// Store the myRow object in each row
		//row.myRow = new myRowObject(textNode, txtInp, cbEl, raEl);
	}
}

function addRowToTableEdit(cdesc,ctid,cfid,cexit)
{
	var tbl = document.getElementById(TABLE_NAME);
	var nextRow = tbl.tBodies[0].rows.length;
	var iteration = nextRow + ROW_BASE;

	if (num == null) { 
		num = nextRow;
	} else {
		iteration = num + ROW_BASE;
	}
		
		

		var cindex = document.frm.ctid.selectedIndex;
		var ctid_text = document.frm.ctid.options[cindex].text;

		var cfindex = document.frm.cfid.selectedIndex;
		var cfid_text = document.frm.cfid.options[cfindex].text;

		var ceindex = document.frm.cexit.selectedIndex;
		var cexit_text = document.frm.cexit.options[ceindex].text;

		nRow = nRow+1;
		// add the row
		var row = tbl.tBodies[0].insertRow(num);
		
		// CONFIG: requires classes named classy0 and classy1
		row.className = 'classy' + (iteration % 2);
	
		// CONFIG: This whole section can be configured
		
		var cell1 = row.insertCell(0);
		cell1.innerHTML = cdesc

		var element1 = document.createElement("input");
		element1.type = "hidden";
		element1.name = "cdescData[]";
		element1.value = cdesc;
		cell1.appendChild(element1);

		var cell2 = row.insertCell(1);
		cell2.innerHTML = ctid_text

		var element2 = document.createElement("input");
		element2.type = "hidden";
		element2.name = "ctidData[]";
		element2.value = ctid;
		cell2.appendChild(element2);

		var cell3 = row.insertCell(2);
		cell3.innerHTML = cfid_text

		var element3 = document.createElement("input");
		element3.type = "hidden";
		element3.name = "cfidData[]";
		element3.value = cfid;
		cell3.appendChild(element3);

		var cell4 = row.insertCell(3);
		cell4.innerHTML = cexit_text

		var element4 = document.createElement("input");
		element4.type = "hidden";
		element4.name = "cexitData[]";
		element4.value = cexit;
		cell4.appendChild(element4);
			
		// cell 2 - input button
		var cell5 = row.insertCell(4);
		var btnEl = document.createElement('input');
		btnEl.setAttribute('type', 'button');
		btnEl.setAttribute('value', 'Delete');
		btnEl.onclick = function () {deleteCurrentRow(this)};
		cell5.appendChild(btnEl);

}


// CONFIG: this entire function is affected by myRowObject settings
// If there isn't a checkbox in your row, then this function can't be used.
function deleteChecked()
{
	if (hasLoaded) {
		var checkedObjArray = new Array();
		var cCount = 0;
	
		var tbl = document.getElementById(TABLE_NAME);
		for (var i=0; i<tbl.tBodies[0].rows.length; i++) {
			if (tbl.tBodies[0].rows[i].myRow && tbl.tBodies[0].rows[i].myRow.three.getAttribute('type') == 'checkbox' && tbl.tBodies[0].rows[i].myRow.three.checked) {
				checkedObjArray[cCount] = tbl.tBodies[0].rows[i];
				cCount++;
			}
		}
		if (checkedObjArray.length > 0) {
			var rIndex = checkedObjArray[0].sectionRowIndex;
			deleteRows(checkedObjArray);
			reorderRows(tbl, rIndex);
		}
	}
}

// If there isn't an element with an onclick event in your row, then this function can't be used.
function deleteCurrentRow(obj)
{
	if (hasLoaded) {
		var delRow = obj.parentNode.parentNode;
		var tbl = delRow.parentNode.parentNode;
		var rIndex = delRow.sectionRowIndex;
		var rowArray = new Array(delRow);
		deleteRows(rowArray);
		reorderRows(tbl, rIndex);
		nRow = nRow-1;
	}
}

function reorderRows(tbl, startingIndex)
{
	if (hasLoaded) {
		if (tbl.tBodies[0].rows[startingIndex]) {
			var count = startingIndex + ROW_BASE;
			for (var i=startingIndex; i<tbl.tBodies[0].rows.length; i++) {
			
				// CONFIG: next line is affected by myRowObject settings
				tbl.tBodies[0].rows[i].myRow.one.data = count; // text
				
				// CONFIG: next line is affected by myRowObject settings
				tbl.tBodies[0].rows[i].myRow.two.name = INPUT_NAME_PREFIX + count; // input text
				
				// CONFIG: next line is affected by myRowObject settings
				var tempVal = tbl.tBodies[0].rows[i].myRow.two.value.split(' '); // for debug purposes
				tbl.tBodies[0].rows[i].myRow.two.value = count + ' was' + tempVal[0]; // for debug purposes
				
				// CONFIG: next line is affected by myRowObject settings
				tbl.tBodies[0].rows[i].myRow.four.value = count; // input radio
				
				// CONFIG: requires class named classy0 and classy1
				tbl.tBodies[0].rows[i].className = 'classy' + (count % 2);
				
				count++;
			}
		}
	}
}

function deleteRows(rowObjArray)
{
	if (hasLoaded) {
		for (var i=0; i<rowObjArray.length; i++) {
			var rIndex = rowObjArray[i].sectionRowIndex;
			rowObjArray[i].parentNode.deleteRow(rIndex);
		}
	}
}

function openInNewWindow(frm)
{
	// open a blank window
	var aWindow = window.open('', 'TableAddRow2NewWindow',
	'scrollbars=yes,menubar=yes,resizable=yes,toolbar=no,width=400,height=400');
	
	// set the target to the blank window
	frm.target = 'TableAddRow2NewWindow';
	
	// submit
	frm.submit();
}

function wordwrap( str, width, brk, cut ) {
    brk = brk || '\n';
    width = width || 75;
    cut = cut || false;
 
    if (!str) { return str; }
 
    var regex = '.{1,' +width+ '}(\\s|$)' + (cut ? '|.{' +width+ '}|.+$' : '|\\S+?(\\s|$)');
 
    return str.match( RegExp(regex, 'g') ).join( brk );
 
}