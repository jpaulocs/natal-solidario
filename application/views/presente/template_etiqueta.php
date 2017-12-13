<html>
<head>
	<link rel="stylesheet" href="http://natalsolidario.dev/resources/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://natalsolidario.dev/resources/css/font-awesome.min.css">
    <title>Etiqueta - Carta número <?php echo $numeroCarta; ?></title>
</head>
<body>
	
        <div class="row">
          <div class="col-md-10" style="">
            <table class="table table-bordered" style="border-width: thick; font-size:25px">
              <thead></thead>
              <tbody>
                <tr>
                  <td rowspan="4">
                    <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $urlQrcode;?>&choe=UTF-8" title="Link to Google.com" />
                  </td>
                  <td>Número da carta</td>
                  <td><?php echo $numeroCarta; ?></td>
                </tr>
                <tr>
                  <td>Nome da criança</td>
                  <td><?php echo $nomeCrianca; ?></td>
                </tr>
                <tr>
                  <td>Nome do Responsável</td>
                  <td><?php echo $nomeResponsavel; ?></td>
                </tr>
                <tr>
                  <td>Local de entrega</td>
                  <td><?php echo $localEntrega; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
      <div class="row">
          <div class="col-md-10" style="">
            <table class="table table-bordered" style="border-width: thick; font-size:25px">
              <thead></thead>
              <tbody>
                <tr>
                  <td rowspan="4">
                    <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $urlQrcode;?>&choe=UTF-8" title="Link to Google.com" />
                  </td>
                  <td>Número da carta</td>
                  <td><?php echo $numeroCarta; ?></td>
                </tr>
                <tr>
                  <td>Nome da criança</td>
                  <td><?php echo $nomeCrianca; ?></td>
                </tr>
                <tr>
                  <td>Nome do Responsável</td>
                  <td><?php echo $nomeResponsavel; ?></td>
                </tr>
                <tr>
                  <td>Local de entrega</td>
                  <td><?php echo $localEntrega; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <button class="btn btn-primary hidden-print" onclick="window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>Imprimir</button>
</body>
</html>