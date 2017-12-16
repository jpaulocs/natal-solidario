<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Salas para entrega dos presentes</h3>
            	<div class="box-tools">
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Região administrativa</th>
						<th>Local</th>
                        <th>Número</th>
						<th></th>
                    </tr>
                    <?php foreach($salas as $sala){ ?>
                    <tr>
                        <td><?php echo $sala['regiao_administrativa_nome']; ?></td>
                        <td><?php echo $sala['local_entrega_nome']; ?></td>
                        <td><?php echo $sala['sala']; ?></td>
						<td>
                            <a href="<?php echo site_url('entrega/inscritos/'.$sala['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Inscritos</a> 
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
