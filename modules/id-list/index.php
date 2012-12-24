<h2>Items</h2><br/>

<div class="content_maintable_stats" style="width:460px;">

	<form id="search" class="navbar-form pull-right" method="get" autocomplete="off">
		<i class="icon-search icon-white"></i>
		<input id="search-bar" type="search" name="item-search" placeholder="Search For Item..."/>
	</form>
	<table id="item-table" class="table table-bordered init-hidden">
		<thead>
			<tr>
				<th id="icon-column">Item Photo</th>
				<th id="id-column">Item ID</th>
				<th id="name-column">Item Name</th>
				<th id="type-column">Type</th>
			</tr>
		</thead>
	</table>
</div>

<script>
function addItems(callback) {
	logInfo("Adding items...");
	$.ajax({
		type: "GET",
		url: "language/items.xml", 
		dataType: "xml",
		success: function(xml) {	
			$(xml).find('item').each(function() {	
				addItem(getValue(this, 'name'),
						  getValue(this, 'icon'),
						  getValue(this, 'id'),
						  getValue(this, 'type'));
			});
			logInfo("Done!");
			callback();
		}
	});
}

function addItem(name, icon, id, type) {
	$('<tr></tr>').html(
		'<td><a href="http://www.minecraftwiki.net/wiki/' + name + '" target="_blank"><img src="images/icons/'+icon+'.png" width="32px" height="32px" border="0" /></a></td>' +
		'<td>' + id + '</td>' +
		'<td><a href="index.php?mode=material-stats&material=' + icon + '" >' + name + '</a></td>' +
		'<td>' + type + '</td>'
	)
	.appendTo('#item-table');
	
	logDebug('Added ' + name + ' (' + type + ').');
}
$(document).ready(function() {
	addItems(function() {
		$("#item-table").fadeIn("slow");
	});
});
$("#search-bar").on("keyup", function() {
	var term = $(this).val().toLowerCase();
	var visible = 0;
	
	$("#item-table tr").each(function(index) {
		if (index !== 0) {
			$row = $(this);
			var value = "";
			
			$(this).find("td").each(function() {
				value += $(this).text();
			});
			
			value = value.toLowerCase();
			
			if (value.indexOf(term) == -1) {
			    $row.hide();
			} else {
			    $row.show();
			    visible++;
			}
		}
	});
	
	if (term) {
		logInfo(visible + " results found.");
	}
});
</script>