<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Beneficiados</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('beneficiado/add'); ?>" class="btn btn-success btn-sm">Novo</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<!-- <th>ID</th> -->
                        <th>Nome</th>
                        <th>Data Nascimento</th>
                        <th>Responsável</th>
                        <th>Data Cadastro</th>
						<!-- <th>Actions</th> -->
                    </tr>
                    <?php foreach($beneficiados as $b){ ?>
                    <tr>
						<!-- <td><?php //echo $b['id']; ?></td> -->
                        <td><?php echo $b['nome']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($b['data_nascimento'])); ?></td>
                        <td><?php echo $b['responsavel_nome']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($b['data_cadastro'])); ?></td>
						<!-- <td>
                            <a href="<?php //echo site_url('beneficiado/edit/'.$b['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php //echo site_url('beneficiado/remove/'.$b['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td> -->
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
