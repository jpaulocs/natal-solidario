<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="panel panel-primary">
                	<div class="panel-heading">Listagem de cartas por local de entrega</div>
                	<table class="table">
                        <tr>
    						<th>Região Administrativa</th>
    						<th><?php echo $regiao_administrativa['nome'];?></th>
                        </tr>
                	</table>
                </div>
            </div>
            <div class="box-body">
            	<div class="panel panel-primary">
                	<div class="panel-heading">Cartas</div>            	
                    <table class="table">
                        <tr>
                        	<th>Responsável</th>
                        	<th>Beneficiado</th>
                        	<th>Número</th>
                        	<th>Adotada</th>
                        	<th>Credenciada</th>
                        	<th>Presente cadastrado</th>
                        	<th>Presente recebido</th>
                        	<th>Presente conferido</th>
                        	<th>Presente entregue</th>
                        </tr>
                        <?php foreach($cartas as $carta){ ?>
                        <tr>
                            <td><?php echo $carta['responsavel_nome']; ?></td>
                            <td><?php echo $carta['beneficiado_nome']; ?></td>
                            <td><?php echo $carta['numero']; ?></td>
                            <td><div style="text-align:center;" class="<?php echo ($carta['adotante']) ? 'alert-success' : 'alert-danger'; ?>"><?php echo ($carta['adotante']) ? 'SIM' : 'NÃO'; ?></div></td>
                            <td><div style="text-align:center;" class="<?php echo ($carta['credenciado']) ? 'alert-success' : 'alert-danger'; ?>"><?php echo ($carta['credenciado']) ? 'SIM' : 'NÃO'; ?></div></td>
                            <td><div style="text-align:center;" class="<?php echo ($carta['presente_situacao'] >= 1) ? 'alert-success' : 'alert-danger'; ?>"><?php echo ($carta['presente_situacao'] >= 1) ? 'SIM' : 'NÃO'; ?></div></td>
                            <td><div style="text-align:center;" class="<?php echo ($carta['presente_situacao'] >= 2) ? 'alert-success' : 'alert-danger'; ?>"><?php echo ($carta['presente_situacao'] >= 2) ? 'SIM' : 'NÃO'; ?></div></td>
                            <td><div style="text-align:center;" class="<?php echo ($carta['presente_situacao'] >= 4) ? 'alert-success' : 'alert-danger'; ?>"><?php echo ($carta['presente_situacao'] >= 4) ? 'SIM' : 'NÃO'; ?></div></td>
                            <td><div style="text-align:center;" class="<?php echo ($carta['presente_situacao'] == 5) ? 'alert-success' : 'alert-danger'; ?>"><?php echo ($carta['presente_situacao'] == 5) ? 'SIM' : 'NÃO'; ?></div></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
