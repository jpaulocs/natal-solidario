<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Conferência de presentes por local de entrega</h3>
            	<div class="box-tools">
                </div>
            </div>
            <div class="box-body">
                <table class="table">
                    <tr>
						<th rowspan="2" style="text-align: center;">Destino</th>
						<th colspan="7" style="text-align: center">Locais de entrega</th>
						<th>Cartas recebidas</th>
					</tr>
					<tr>
						<?php foreach($locaisEntrega as $local){?>
                        <th><?php echo $local['nomeLocalEntrega'];?></th>
                        <?php }?>
                    </tr>
                    <?php foreach($totalCartasRecebidasPorRegiao as $item){?>
                    <tr>
                    	<td><?php echo $item['nome']; ?></td>
                    	<?php foreach($locaisEntrega as $local){?>
                    	<td><?php echo $item['conferidosPorRegiao'][$local['nomeLocalEntrega']];?></td>
                    	<?php }?>
                    	<td><?php echo $item['total']; ?></td>
                    </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
</div>
