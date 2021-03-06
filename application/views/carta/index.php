<?php if($this->session->flashdata('numero_carta_criada')): ?>
    <div class="alert alert-success" role="alert">
        <strong>Carta <?php echo $this->session->flashdata('numero_carta_criada'); ?> inserida com sucesso!</strong>
        <!-- <?php echo $this->session->flashdata('teste'); ?> -->
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="row">
	<?php echo form_open('carta/index', array('method'=>'get','id'=>'myform')); ?>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Cartas</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('carta/add'); ?>" class="btn btn-success btn-sm">Nova</a> 
                </div>
            </div>
            <div class="box-body">
            	<div  class="panel panel-primary">
					<div class="panel-heading">Filtrar</div>
					<div class="panel-body">
						<div class="row clearfix">
                        	<div class="col-md-4">
                            	<label>Número da carta</label>
                                <input type="text" name="numero" value="<?php echo $numero;?>" class="form-control" onblur="myform.submit();" />
                			</div>
                			<div class="col-md-4">
                            	<label>Nome da criança</label>
                                <input type="text" name="nome_crianca" value="<?php echo $nome_crianca;?>" class="form-control" onblur="myform.submit();" />
                			</div>
                			<div class="col-md-4">
                            	<label>Nome do responsável</label>
                                <input type="text" name="nome_responsavel" value="<?php echo $nome_responsavel;?>" class="form-control" onblur="myform.submit();" />
                			</div>
                		</div>
                		<div class="row clearfix">
                           <div class="col-md-6">
                                <label>Carteiro</label>
                                <select name="carteiro" class="form-control" onchange="myform.submit();">
                                    <option value="">Todos</option>
                                    <?php 
                                    foreach($carteiros as $carteiro) {
                                        $selected = ($carteiro['id'] == ''.$carteiro_selecionado) ? ' selected="selected"' : '';
                    
                                        echo '<option value="'.$carteiro['id'].'" '.$selected.'>'.$carteiro['first_name'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                           <div class="col-md-6">
                                <label>Mobilizador</label>
                                <select name="mobilizador" class="form-control" onchange="myform.submit();">
                                    <option value="">Todos</option>
                                    <?php 
                                    foreach($mobilizadores as $mobilizador) {
                                        $selected = ($mobilizador['id'] == ''.$mobilizador_selecionado) ? ' selected="selected"' : '';
                    
                                        echo '<option value="'.$mobilizador['id'].'" '.$selected.'>'.$mobilizador['first_name'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                		</div>
                		<div class="row clearfix">
                			<div class="col-md-6">
                            	<label>Região administrativa </label>
                                <select name="regiao_administrativa" class="form-control" onchange="myform.submit();">
                    				<option value="">Todas</option>
                    				<?php 
                    				foreach($all_regioes as $ra) {
                    				    $selected = ($ra['id'] == ''.$regiao_administrativa) ? ' selected' : '';
                    				    
                    				    echo '<option value="'.$ra['id'].'" '.$selected.'>'.$ra['nome'].'</option>';
                    				}
                    				?>
                    			</select>
                			</div>
                			<div class="col-md-6">
                            	<label>Situação </label>
                                <select name="situacao" class="form-control" onchange="myform.submit();">
                    				<option value="">Todas</option>
                    				<option value="SEM_CARTEIRO_VINCULADO" <?php echo ($situacao == 'SEM_CARTEIRO_VINCULADO') ? 'selected' : '' ?>>Sem carteiro vinculado</option>
                    				<option value="SEM_MOBILIZADOR_VINCULADO" <?php echo ($situacao == 'SEM_MOBILIZADOR_VINCULADO') ? 'selected' : '' ?>>Sem mobilizador vinculado</option>
                    				<option value="AGUARDANDO_ADOCAO" <?php echo ($situacao == '3') ? 'selected' : 'AGUARDANDO_ADOCAO' ?>>Aguardando adoção</option>
                    			</select>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
            <div class="box-body">
            	<div style="font-weight: bold;">Total de cartas encontradas: <?php echo $total_registros;?></div>
            	<nav aria-label="Page navigation">
  					<ul class="pagination">
                <?php if (isset($links)) { ?>
                	<?php echo $links ?>
            	<?php } ?>
            		</ul>
				</nav>
                <table class="table table-striped">
                    <tr>
						<th>Número</th>
                        <th>Beneficiado</th>
                        <th>Responsável</th>
                        <th>Adotante</th>
                        <th>Data Cadastro</th>
                        <th>Credenciado</th>
                        <th>Ação</th>
                    </tr>
                    <?php
                    if($cartas) {
                    foreach($cartas as $c){ 
                    ?>
                    <tr>
						<td><?php echo $c['numero']; ?></td>
                        <td><?php echo $c['beneficiado_nome']; ?></td>
                        <td><?php echo $c['responsavel_nome']; ?></td>
                        <td><?php echo $c['adotante_nome']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($c['data_cadastro'])); ?></td>
                        <td><?php echo ($c['credenciado']) ? 'Sim' : 'Não'; ?></td>
						<td>
							<?php                            
                            $grupos_usuario = $this->session->userdata('grupos_usuario');
                            
                            if($this->session->userdata('grupos_usuario'))
                                //echo print_r($grupos_usuario);
                                if (in_array("admin", $grupos_usuario, true) || in_array("representante-ong", $grupos_usuario, true)):
                            ?>
                                <a href="<?php echo site_url('carta/edit/'.$c['id']); ?>" class="btn btn-info btn-xs" style="margin-right:10px;"><span class="fa fa-pencil"></span> Editar</a>
                            <?php 
                                
                             endif;
                             
                             if (in_array("admin", $grupos_usuario, true) || $this->session->userdata('usuario_logado_id') == $c['carteiro_associado']):
                            ?>
                            	<a href="<?php echo site_url('carta/formulario/'.$c['id']); ?>" class="btn btn-success btn-xs" style="margin-right:10px;"><span class="fa fa-pencil"></span> Formulário</a>
                            <?php 
                                
                             endif;
                             
                             if (in_array("admin", $grupos_usuario, true) || $this->session->userdata('usuario_logado_id') == $c['mobilizador']):
                             ?>
                            	<a href="<?php echo site_url('carta/adotante/'.$c['id']); ?>" class="btn btn-warning btn-xs" style="margin-right:10px;"><span class="fa fa-pencil"></span> Adotante</a>
                            <?php
                             endif;
                             if ((in_array("admin", $grupos_usuario, true) || in_array("representante-comunidade", $grupos_usuario, true)) && !$c['credenciado']) {
                                 ?>
							<a href="<?php echo site_url('carta/credenciar/'.$c['id']); ?>" class="btn btn-danger btn-xs" style="margin-right:10px;" onclick="return confirm('Confirma o credenciamento da carta <?php echo $c['numero'] . " - " . $c['beneficiado_nome']; ?>?');"><span class="fa fa-pencil"></span> Credenciar</a>
                            <?php
							}
                             ?>
                        </td>
                    </tr>
                    <?php }
                    } ?>
                </table>
                <nav aria-label="Page navigation">
  					<ul class="pagination">
                <?php if (isset($links)) { ?>
                	<?php echo $links ?>
            	<?php } ?>
            		</ul>
				</nav>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
