<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Usuarios Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('usuario/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Senha</th>
						<th>Perfil</th>
						<th>Removido</th>
						<th>Area Abrangencia</th>
						<th>Referencia</th>
						<th>Telefone</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($usuarios as $u){ ?>
                    <tr>
						<td><?php echo $u['id']; ?></td>
						<td><?php echo $u['nome']; ?></td>
						<td><?php echo $u['email']; ?></td>
						<td><?php echo $u['senha']; ?></td>
						<td><?php echo $u['perfil']; ?></td>
						<td><?php echo $u['removido']; ?></td>
						<td><?php echo $u['area_abrangencia']; ?></td>
						<td><?php echo $u['referencia']; ?></td>
						<td><?php echo $u['telefone']; ?></td>
						<td>
                            <a href="<?php echo site_url('usuario/edit/'.$u['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('usuario/remove/'.$u['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
