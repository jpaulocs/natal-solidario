<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Beneficiado Edit</h3>
            </div>
			<?php echo form_open('beneficiado/edit/'.$beneficiado['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<div class="form-group">
							<input type="checkbox" name="removido" value="1" <?php echo ($beneficiado['removido']==1 ? 'checked="checked"' : ''); ?> id='removido' />
							<label for="removido" class="control-label">Removido</label>
						</div>
					</div>
					<div class="col-md-6">
						<label for="responsavel" class="control-label"><span class="text-danger">*</span>Responsavel</label>
						<div class="form-group">
							<select name="responsavel" class="form-control">
								<option value="">select responsavel</option>
								<?php 
								foreach($all_responsaveis as $responsavel)
								{
									$selected = ($responsavel['id'] == $beneficiado['responsavel']) ? ' selected="selected"' : "";

									echo '<option value="'.$responsavel['id'].'" '.$selected.'>'.$responsavel['nome'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('responsavel');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="data_cadastro" class="control-label">Data Cadastro</label>
						<div class="form-group">
							<input type="text" name="data_cadastro" value="<?php echo ($this->input->post('data_cadastro') ? $this->input->post('data_cadastro') : $beneficiado['data_cadastro']); ?>" class="has-datetimepicker form-control" id="data_cadastro" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="nome" class="control-label"><span class="text-danger">*</span>Nome</label>
						<div class="form-group">
							<input type="text" name="nome" value="<?php echo ($this->input->post('nome') ? $this->input->post('nome') : $beneficiado['nome']); ?>" class="form-control" id="nome" />
							<span class="text-danger"><?php echo form_error('nome');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="data_nascimento" class="control-label"><span class="text-danger">*</span>Data Nascimento</label>
						<div class="form-group">
							<input type="text" name="data_nascimento" value="<?php echo ($this->input->post('data_nascimento') ? $this->input->post('data_nascimento') : $beneficiado['data_nascimento']); ?>" class="has-datepicker form-control" id="data_nascimento" />
							<span class="text-danger"><?php echo form_error('data_nascimento');?></span>
						</div>
					</div>
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