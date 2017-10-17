<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Usuarios Perfil Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('usuario_perfil/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($usuarios_perfil as $u){ ?>
                    <tr>
						<td><?php echo $u['id']; ?></td>
						<td><?php echo $u['nome']; ?></td>
						<td>
                            <a href="<?php echo site_url('usuario_perfil/edit/'.$u['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('usuario_perfil/remove/'.$u['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
