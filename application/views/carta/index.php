<?php if($this->session->flashdata('numero_carta_criada')): ?>
    <div class="alert alert-success" role="alert">
        <strong>Carta <?php echo $this->session->flashdata('numero_carta_criada'); ?> inserida com sucesso!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

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
                        <td><?php echo $c['beneficiado_nome']; ?></td>
                        <td><?php echo $c['representante_comunidade_nome']; ?></td>
                        <td><?php echo $c['carteiro_nome']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($c['data_cadastro'])); ?></td>
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
