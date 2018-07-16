'use strict';
$( function() {
	$.datepicker.formatDate( "dd-mm-yyyy");
	$( "#datepicker" ).datepicker({ changeMonth: true,
		changeYear: true, dateFormat: 'yy-mm-dd' });
var currentYear = (new Date).getFullYear();
var yearRange = $( "#datepicker" ).datepicker( "option", "yearRange" );
$( "#datepicker" ).datepicker( "option", "yearRange", "1950:"+currentYear );
} );