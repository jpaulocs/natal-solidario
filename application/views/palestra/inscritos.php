<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="panel panel-primary">
                	<div class="panel-heading">Turma da palestra</div>
                	<table class="table">
                        <tr>
    						<th>Região Administrativa</th>
    						<th><?php echo $salaSelecionada['regiao_administrativa_nome'];?></th>
                        </tr>
                        <tr>
    						<th>Local</th>
    						<th><?php echo $salaSelecionada['local_entrega_nome'];?></th>
                        </tr>
                        <tr>
    						<th>Palestra</th>
    						<th><?php echo $salaSelecionada['nome'];?></th>
                        </tr>
                        <tr>
    						<th>Sala</th>
    						<th><?php echo $salaSelecionada['sala'];?></th>
                        </tr>
                	</table>
                </div>
            </div>
            <div class="box-body">
            	<div class="panel panel-primary">
                	<div class="panel-heading">Inscritos</div>            	
                    <table class="table">
                        <?php foreach($responsaveis as $r){ ?>
                        <tr>
                            <td><?php echo $r['nome']; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
