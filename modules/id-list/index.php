<script type="text/javascript" charset="utf-8">

RegExp.escape = function(str) {
  return str.replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, '\\$1');
};

function lc_strip_spaces(str) {
  return str.toLowerCase().replace(/ /g, '');
}

var placeholder_hidden = false;

function hide_placeholder_text(evt) {
  $(evt.currentTarget).css('color', '').val('').unbind('click').unbind('focus').unbind('keydown');
  placeholder_hidden = true;
}

function do_search(evt) {
  var target = $(evt.currentTarget);
  var raw_keywords = target.val();
  if (!placeholder_hidden)
    raw_keywords = '';
  var keywords = lc_strip_spaces(raw_keywords);
  var keywords_no_colon = keywords.replace(/:$/, '');

  var regex = new RegExp('(' + RegExp.escape(raw_keywords).replace(/ +/gi, ' ?') + ')', 'gi');

  $('.item').each(function(index, item) {
    var id = $.trim($('.id', item).text());
    var name_element = $('.name a', item);
    var raw_name = name_element.text();
    var name = lc_strip_spaces(raw_name);
	
    name_element.html(raw_name.replace(regex, '<span class="highlight">$1</span>'));

    var alternate_id = id;
    if (id.indexOf(':') < 0)
      alternate_id += ':0';

    var id_matches = id == keywords_no_colon || alternate_id == keywords;
    if (keywords_no_colon.indexOf(':') < 0 && alternate_id.substring(0, alternate_id.indexOf(':')) == keywords_no_colon)
      id_matches = true;

    if (name.indexOf(keywords) >= 0 || id_matches)
      $(item).show();
    else
      $(item).hide();
  });
  
  if (evt.keyCode == 13) {
    target.blur();
    evt.preventDefault();
  }
}
$(document).ready(function() {
  var placeholder = $('#placeholder');
  if (placeholder) {
    placeholder.html('<div id="controls"></div><input placeholder="Enter an item number or block name..." id="search" type="text" autocomplete="off" />');
    var search_field = $('#search');
    search_field.focus();
    search_field.click(hide_placeholder_text);
    search_field.focus(hide_placeholder_text);
    search_field.keydown(hide_placeholder_text);
    search_field.keyup(do_search);
  }
});
</script>
<h2>Items</h2><br/>

<div class="content_maintable_stats" style="width:460px;">
    <div id="placeholder"></div>
	<table id="item-table" style="margin:auto;">
		<thead>
			<th style="text-align: center;" class="id"><?php echo translate('var73'); ?></th>
			<th style="text-align: center;" class="icon"><?php echo translate('var73'); ?></th>
			<th style="text-align: left;" class="name"><?php echo translate('var74'); ?></th>
		</thead>
		<tbody id="names" align="center">
			<?php echo id_index_table();?>
    	</tbody>
    </table>
</div>