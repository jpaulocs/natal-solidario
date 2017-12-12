<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Salas de palestras</h3>
            	<div class="box-tools">
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Região administrativa</th>
						<th>Local</th>
                        <th>Palestra</th>
                        <th>Número</th>
                        <th>Início</th>
                        <th>Término</th>
						<th></th>
                    </tr>
                    <?php foreach($salas as $sala){ ?>
                    <tr>
                        <td><?php echo $sala['regiao_administrativa_nome']; ?></td>
                        <td><?php echo $sala['local_entrega_nome']; ?></td>
                        <td><?php echo $sala['nome']; ?></td>
                        <td><?php echo $sala['sala']; ?></td>
                        <td><?php echo date("H:i", strtotime($sala['inicio'])); ?></td>
                        <td><?php echo date("H:i", strtotime($sala['termino'])); ?></td>
						<td>
                            <a href="<?php echo site_url('palestra/inscritos/'.$sala['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Inscritos</a> 
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
