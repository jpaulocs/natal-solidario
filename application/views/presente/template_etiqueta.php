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
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-10" style="">
            <table class="table table-bordered" style="border-width: thick; font-size:25px">
              <thead></thead>
              <tbody>
                <tr>
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
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <button class="btn btn-primary hidden-print" onclick="window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>Imprimir</button>
</body>
</html>