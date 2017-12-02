<html>
<head>    
    <title> Resumo envio de e-mails Natal Solidário</title>
</head>
<body>
	<div>
		<p>Quantidade de e-mails a enviar: <?php echo $qtdEmailsEnviar; ?></p>
		<p>E-mails enviados com sucesso:</p>
		<ul>
			<?php
				foreach ($emailsOk as $emailOK) {
					echo '<li>' . $emailOK . '</li>';
				}
			?>
		</ul>
		<p>E-mails não enviado(erro):</p>
		<ul>
			<?php
				foreach ($emailsErro as $emailErro) {
					echo '<li>' . $emailErro . '</li>';
				}
			?>
		</ul>
	</div>

</body>
</html>