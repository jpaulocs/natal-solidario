<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Novo Responsável</h3>
            </div>
            <?php echo form_open('responsavel/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
          			<div class="col-md-6">
						<label for="nome" class="control-label"><span class="text-danger">*</span>Nome</label>
						<div class="form-group">
							<input type="text" name="nome" value="<?php echo $this->input->post('nome'); ?>" class="form-control" id="nome" />
							<span class="text-danger"><?php echo form_error('nome');?></span>
						</div>
					</div>
				</div>
					
				<div class="row clearfix">
					<div class="col-md-2">
						<label for="data_nascimento" class="control-label"><span class="text-danger">*</span>Data Nascimento</label>
						<div class="form-group">
							<input type="text" name="data_nascimento" value="<?php echo $this->input->post('data_nascimento'); ?>" class="has-datepicker form-control" id="data_nascimento" />
							<span class="text-danger"><?php echo form_error('data_nascimento');?></span>
						</div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-md-6">
						<label for="endereco" class="control-label"><span class="text-danger">*</span>Endereço</label>
						<div class="form-group">
							<input type="text" name="endereco" value="<?php echo $this->input->post('endereco'); ?>" class="form-control" id="endereco" />
							<span class="text-danger"><?php echo form_error('endereco');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="cidade" class="control-label"><span class="text-danger">*</span>Cidade</label>
						<div class="form-group">
							<input type="text" name="cidade" value="<?php echo $this->input->post('cidade'); ?>" class="form-control" id="cidade" />
							<span class="text-danger"><?php echo form_error('cidade');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-1">
						<label for="uf" class="control-label"><span class="text-danger">*</span>UF</label>
						<div class="form-group">
							<input type="text" name="uf" value="<?php echo $this->input->post('uf'); ?>" class="form-control" id="uf" />
							<span class="text-danger"><?php echo form_error('uf');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-2">
						<label for="cep" class="control-label">Cep</label>
						<div class="form-group">
							<input type="text" name="cep" value="<?php echo $this->input->post('cep'); ?>" class="form-control" id="cep" />
							<span class="text-danger"><?php echo form_error('cep');?></span>
						</div>
					</div>
				</div>
					<!-- <div class="col-md-6">
						<label for="documento_tipo" class="control-label">Documento Tipo</label>
						<div class="form-group">
							<select name="documento_tipo" class="form-control">
								<option value="">select</option>
								//<?php 
								//$documento_tipo_values = array(
								//	'CPF'=>'CPF',
								//	'RG'=>'RG',
								//	'CNH'=>'CNH',
								//	'Outro'=>'Outro',
								//);

								//foreach($documento_tipo_values as $value => $display_text)
								//{
								//	$selected = ($value == $this->input->post('documento_tipo')) ? ' selected="selected"' : "";
								//	
								//	echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
								//} 
								//?>

							</select>
						</div>
					</div> -->
					
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>