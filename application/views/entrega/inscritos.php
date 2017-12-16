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
                    	<tr>
<!--                     		<th>ID</th> -->
                    		<th>Responsável</th>
                    		<th>Qtd crianças</th>
                    	</tr>
                        <?php 
                        foreach($responsaveis as $r){ 
                            if ($r['total_criancas'] > 0) {
                        ?>
                        <tr>
<!--                              <td><?php echo $r['id']; ?></td>-->
                            <td><?php echo $r['nome']; ?></td>
                            <td><?php echo $r['total_criancas']; ?></td>
                        </tr>
                        <?php } 
                        } ?>
                        <tr>
<!--                         	<th></th> -->
                        	<th>TOTAL DE CRIANÇAS NA SALA</th>
                        	<th><?php echo $total; ?></th>
                        </tr>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
