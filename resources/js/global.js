$(document).ready(function() {
	
	if( $('.has-datetimepicker').length ) 
	{
		$('.has-datetimepicker').datetimepicker();
	}
	
	if( $('.has-datepicker').length )
	{
		$('.has-datepicker').datetimepicker({format: 'DD/MM/YYYY'});
	} 

	$(".phones").mask('(00) 00000-0000');
	$('.money').mask('#.##0,00', {reverse: true});
});