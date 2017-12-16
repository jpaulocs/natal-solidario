<div class="row">
    <?php echo form_open_multipart(isset($dadosPresente) ? 'presente/entrega/'.$dadosPresente['idPresente'] : 'presente/entrega'); ?>
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Entrega do presente</h3>
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
        
        <?php if(isset($dadosPresente)){?>
        <div class="box">
            <div class="panel panel-primary">
                <div class="panel-heading">Dados do Presente</div>
                <table class="table">
                    <tr>
                        <td style="width:20%">Número da carta</td> 
                        <td><?php echo $dadosPresente['numeroCarta'];?></td>
                    </tr>
                    <tr>
                        <th>Nome do responsável</th>
                        <th><?php echo $dadosPresente['responsavel_nome']; ?></th>
                    </tr>
                    <tr>
                        <th>Nome da criança</th>
                        <th><?php echo $dadosPresente['beneficiado_nome']; ?></th>
                    </tr>
                    <tr>
                        <td>Local de entrega</td>
                        <td><?php echo $dadosPresente['nomeLocalEntrega'] . " <br/> Sala: " . $dadosPresente['numeroSalaEntrega']; ?></td>

                    </tr>
                </table>
                <?php if(is_null($imagem_entrega)){?>
                <div class="panel-body">
                	<div class="row clearfix">
    					<div class="col-md-4">
    						<label for="numero" class="control-label">Anexar foto:</label>
    						<div class="form-group">
    							<input type="file" name="imagem" class="form-control"/>
    						</div>
    					</div>
    				</div>
                </div>
                <div class="panel-footer"><button class="btn btn-success">Confirmar entrega</button></div>
                <?php }?>
            </div>
		</div>
        <?php } ?>
        <?php if(isset($imagem_entrega)){?>
        <div class="box">
            <div class="panel panel-primary">
                <div class="panel-heading">Imagem da entrega</div>
                <div class="panel-body">
                	<div class="row clearfix">
    					<div class="col-md-4">
    						<div class="form-group">
    							<img src="<?php echo site_url('uploads/'.$imagem_entrega);?>"/>
    						</div>
    					</div>
    				</div>
                </div>
            </div>
		</div>
        <?php } ?>
    </div>
     <?php echo form_close(); ?>
</div>