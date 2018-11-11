<!-- Cole este código no footer do seu site -->
<script>
	function visits(){	$.post( "<?= base_url('/visits') ?>") }
	setInterval(function () { visits() }, 10000);
</script>
