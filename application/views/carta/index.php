<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Cartas</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('carta/add'); ?>" class="btn btn-success btn-sm">Nova</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Número</th>
                        <th>Beneficiado</th>
                        <th>Representante Comunidade</th>
                        <th>Carteiro</th>
                        <th>Data Cadastro</th>
                        <th>Ação</th>
                    </tr>
                    <?php foreach($cartas as $c){ ?>
                    <tr>
						<td><?php echo $c['numero']; ?></td>
                        <td><?php echo $c['beneficiado']; ?></td>
                        <td><?php echo $c['representante_comunidade']; ?></td>
                        <td><?php echo $c['carteiro_associado']; ?></td>
                        <td><?php echo $c['data_cadastro']; ?></td>
						<td>
                            <a href="<?php echo site_url('carta/edit/'.$c['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a> 
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
