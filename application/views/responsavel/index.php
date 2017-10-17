<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Responsáveis</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('responsavel/add'); ?>" class="btn btn-success btn-sm">Novo</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Nome</th>
                        <th>Data Nascimento</th>
                        <th>Endereco</th>
                        <th>Cidade</th>
                        <th>Uf</th>
                        <th>Cep</th>
						<!-- <th>Actions</th> -->
                    </tr>
                    <?php foreach($responsaveis as $r){ ?>
                    <tr>
                        <!-- <td><//?php echo $r['id']; ?></td> -->
                        <td><?php echo $r['nome']; ?></td>
                        <td><?php echo $r['data_nascimento']; ?></td>
                        <td><?php echo $r['endereco']; ?></td>
                        <td><?php echo $r['cidade']; ?></td>
                        <td><?php echo $r['uf']; ?></td>
                        <td><?php echo $r['cep']; ?></td>
						<!-- <td>
                            <a href="<?php //echo site_url('responsavel/edit/'.$r['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php //echo site_url('responsavel/remove/'.$r['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td> -->
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
