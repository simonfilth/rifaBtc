	<!-- <script src="/js/app.js"></script> -->
    {!! Html::script('components/js/jquery.js') !!}
    {!! Html::script('components/bootstrap/js/bootstrap.min.js') !!}
	{!! Html::script('components/js/custom.js') !!}
    {!! Html::script('components/jquery-ui/jquery-ui.min.js') !!}
	{!! Html::script('components/js/sorttable.js') !!}
    <!-- Smartsupp Live Chat script -->
        <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '8d905a47427c30952678dbe77fd65da2320ae69c';
        _smartsupp.loginEmailControl = false;
        window.smartsupp||(function(d) {
            var s,c,o=smartsupp=function(){ o..push(arguments)};o.=[]; 
            s=d.getElementsByTagName('script')[0];c=d.createElement('script');
            c.type='text/javascript';c.charset='utf-8';c.async=true;
            c.src='//www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
        </script>
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