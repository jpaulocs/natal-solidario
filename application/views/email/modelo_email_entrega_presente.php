<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Natal Solidário - heroisdeverdade.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
	<div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header">
		<img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;max-width: 152px" src="http://heroisdeverdade.org/natalsolidario/wp-content/uploads/2017/08/logo-horizontal.png" alt="" width="159" height="60">
	</div>

	<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 20px;Margin-bottom: 25px">
		<br>
		Olá <?php echo $nomeAdotante;?>,
	</p>

	<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 20px;Margin-bottom: 5px">
		Obrigado por iluminar o natal d<?php echo ($beneficiado_sexo == 'M') ? 'o' : 'a';?> <?php echo $beneficiado;?>. 
		Segue uma lembrança do momento em que <?php echo ($beneficiado_sexo == 'M') ? 'ele' : 'ela';?> recebeu o presente:  
	</p>
	<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 20px;Margin-bottom: 25px">
		<img src="http://www.heroisdeverdade.org/app/natal-solidario/uploads/<?php echo $imagem_entrega;?>"/>
	</p>
	<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 20px;Margin-bottom: 25px">
		Atenciosamente,
		<br>
		--
		<br>
		Equipe Natal Solidário
		<br>
		ONG Heróis de Verdade
	</p>
</div>
</body>
</html>