<!DOCTYPE html>
<html>
<head>
	<title>Backend</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</head>
<body>


	<p>Usuários online: <span class="current">0</span></p>
	<p>Total de visitas hoje: <span class="today">0</span></p>


	<!-- Contador de visitas -->
	<script>
	  visitors();
	  function visitors(){
	    $.post("<?= base_url('visits/getVisitors') ?>", function(response) {
	        var data = jQuery.parseJSON(response);
	        $('.current').html(data.current);
	        $('.today').html(data.total);
	    });
	  }
	  // Atualiza em tempo determinado
	  setInterval(function () { visitors() }, 10000);
	</script>

</body>
</html>