	{!! Html::script('components/js/jquery.js') !!}
    {!! Html::script('components/bootstrap/js/bootstrap.min.js') !!}
	{!! Html::script('components/js/custom.js') !!}
	{!! Html::script('components/jquery-ui/jquery-ui.min.js') !!}
	<script>
$(function(){
	$(".datepicker").datepicker({
         dateFormat: 'dd-mm-yy',
         language: "es",
         autoclose: true,
         todayHighlight: true,
         minDate: '+0',
         firstDay: 1,
         maxDate: 100/*,
         changeYear: true,
         changeMonth: true*/
    });
});
</script>
</body>
</html>