<div class="row">
    <?php echo form_open('presente/receberPresente'); ?>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Recebimento de Presentes</h3>
            </div>
            
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-4">
                        <label for="numeroCarta" class="control-label"><span class="text-danger">*</span>Número da Carta</label>
                        <div class="form-group">
                            <input type="text" name="numeroCarta" value="<?php echo $this->input->post('numeroCarta'); ?>" class="form-control" id="numeroCarta" />
                            <span class="text-danger"><?php echo form_error('numeroCarta');?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Buscar
                </button>
            </div>
            
        </div>
        <?php if(isset($dados) && $dados['situacaoPresente'] == 2) {?>
        <h3>O presente já foi recebido.</h3>
        <?php
        } else {
        ?>
        
        <?php 
        
        if(isset($dadosPresente) && is_null($dadosPresente['idPresente'])):
        
        ?>
		<div class="box">
			<div class="panel panel-primary">
                <div class="panel-heading">Cadastro do presente</div>
                <div class="panel-body"><h3>O adotante não realizou o cadastro do presente. Realize o cadastro antes de receber o presente:</h3></div>
            	<div class="panel-body">
            		<div class="col-xs-6">
                		<label>* Qual o brinquedo que a criança irá receber?</label>
                    	<input type="text" name="descricaoBrinquedo" value="<?php echo $dadosPresente['descricaoBrinquedo'];?>" class="form-control"/>
    				</div>
    				<div class="col-xs-6">
                    	<label>* Classificação do brinquedo</label>
                        <select name="classificacaoBrinquedo" class="form-control">
        					<option value="">selecione</option>
        					<?php 
        					    foreach($brinquedo_classificacoes as $classificacao) {
        					        $selected = ($dadosPresente['classificacaoBrinquedo'] == $classificacao['id']) ? ' selected="selected"' : "";
        
        							echo '<option value="'.$classificacao['id'].'" '.$selected.'>'.$classificacao['nome'].'</option>';
        						} 
        					?>
        				</select>
        			</div>
    			</div>
    			<div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Salvar
                    </button>
                </div>
			</div>
		</div>
        <?php endif?>
        <?php if(isset($dados) && !is_null($dados['idPresente'])):?>
            
            <div class="box">
                <div class="panel panel-primary">
                    <div class="panel-heading">Dados do Presente</div>
                    <table class="table">
                        <tr>
                            <td style="width:20%">Número da carta</td> 
                            <td><?php echo $dados['numeroCarta'];?></td>
                        </tr>
                        <tr>
                            <td>Nome do adotante</td>
                            <td><?php echo $dados['nomeAdotante']; ?></td>
                        </tr>
                        <tr>
                            <td>Nome do responsável</td>
                            <td><?php echo $dados['responsavel_nome']; ?></td>
                        </tr>
                        <tr>
                            <td>Nome da criança</td>
                            <td><?php echo $dados['beneficiado_nome']; ?></td>
                        </tr>
                        <tr>
                            <td>Local de entrega</td>
                            <td><?php echo $dados['nomeLocalEntrega'] . " <br/> Sala: " . $dados['numeroSalaEntrega']; ?></td>

                        </tr>
                    </table>
                    <div class="panel-footer"><a href="<?php echo site_url('presente/gerarEtiqueta/'.$dados['numeroCarta']."/". $dados['responsavel_nome'] . "/" . $dados['beneficiado_nome'] . "/" . $dados['nomeLocalEntrega']. "/" . $dados['numeroSalaEntrega']); ?>" class="btn btn-success" target="_blank">Visualizar etiqueta</a></div>
                </div>
            </div>
            
            <div class="box">
                <div class="panel panel-primary">
                    <div class="panel-heading">Receber presente</div>
                    <table class="table">
                        <tr>
                            <td style="width:20%">Local de armazenamento</td> 
                            <td>
                                <div class="form-group">
                                    <select name="local_armazenamento" class="form-control">
                                        <option value=""></option>
                                        <?php 
                                        foreach($allLocaisArmazenamento as $local)
                                        {
                                                $selected = ($local['id'] == $dados['localArmazenamentoPresente']) ? ' selected="selected"' : "";

                                                echo '<option value="'.$local['id'].'" '.$selected.'>'.$local['nome'].'</option>';

                                        } 
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Receber
                        </button>
                    </div>
                </div>
            </div>
            
        <?php 
        endif;
        }
        ?>
    </div>
    <?php echo form_close(); ?>
</div>