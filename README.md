# Contador de visitas para codeigniter 

Uma solução simples para contar os usuários online em sua aplicação codeigniter.
Basta colar a pasta na raiz de seu projeto e criar a tabela que "visits".

### Como utilizar:

1 - Criar uma tabela em sua base de dados para salvar as sessões:

```
CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
)
```

2 - Implementar o código abaixo no frontend de seu site:

```
<script>
	function visits(){	$.post( "<?= base_url('/visits') ?>") }
	setInterval(function () { visits() }, 10000);
</script>
```

3 - Usar o código abaixo no backend para acompanhar os usuários online:

```
<p>Usuários online: <span class="current">0</span></p>
<p>Total de visitas hoje: <span class="today">0</span></p>
<script>
  visitors();
  function visitors(){
    $.post("<?= base_url('visits/getVisitors') ?>", function(response) {
        var data = jQuery.parseJSON(response);
        $('.current').html(data.current);
        $('.today').html(data.total);
    });
  }
  setInterval(function () { visitors() }, 10000);
</script>

```

Lembrando que essa é uma solução simples, mas você pode usar sua criatividade na hora de implementar :)
