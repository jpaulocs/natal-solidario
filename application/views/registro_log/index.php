<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Registros Log Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('registro_log/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Data Cadastro</th>
						<th>Usuario</th>
						<th>Acao</th>
						<th>Titulo</th>
						<th>Conteudo Anterior</th>
						<th>Conteudo Posterior</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($registros_log as $r){ ?>
                    <tr>
						<td><?php echo $r['id']; ?></td>
						<td><?php echo $r['data_cadastro']; ?></td>
						<td><?php echo $r['usuario']; ?></td>
						<td><?php echo $r['acao']; ?></td>
						<td><?php echo $r['titulo']; ?></td>
						<td><?php echo $r['conteudo_anterior']; ?></td>
						<td><?php echo $r['conteudo_posterior']; ?></td>
						<td>
                            <a href="<?php echo site_url('registro_log/edit/'.$r['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('registro_log/remove/'.$r['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
