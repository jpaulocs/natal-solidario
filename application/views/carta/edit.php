<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Carta Pedido Edit</h3>
            </div>
			<?php echo form_open('carta/edit/'.$carta_pedido['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-2">
						<label for="numero" class="control-label">Número</label>
						<div class="form-group">
							<input disabled type="text" name="numero" value="<?php echo ($this->input->post('numero') ? $this->input->post('numero') : $carta_pedido['numero']); ?>" class="form-control" id="numero" />
							<span class="text-danger"><?php echo form_error('numero');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="beneficiado" class="control-label"><span class="text-danger">*</span>Beneficiado</label>
						<div class="form-group">
							<select name="beneficiado" class="form-control">
								<option value="">select beneficiado</option>
								<?php 
								foreach($all_beneficiados as $beneficiado)
								{
									$selected = ($beneficiado['id'] == $carta_pedido['beneficiado']) ? ' selected="selected"' : "";

									echo '<option value="'.$beneficiado['id'].'" '.$selected.'>'.$beneficiado['nome'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('beneficiado');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="representante_comunidade" class="control-label">Representante da Comunidade</label>
						<div class="form-group">
							<select name="representante_comunidade" class="form-control">
								<option value=""></option>
								<?php 
								foreach($all_usuarios as $usuario)
								{
									if($usuario['perfil'] === "1"){
										$selected = ($usuario['id'] == $carta_pedido['representante_comunidade']) ? ' selected="selected"' : "";

										echo '<option value="'.$usuario['id'].'" '.$selected.'>'.$usuario['nome'].'</option>';
									}
								} 
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="carteiro_associado" class="control-label">Carteiro</label>
						<div class="form-group">
							<select name="carteiro_associado" class="form-control">
								<option value=""></option>
								<?php 
								foreach($all_usuarios as $usuario)
								{
									if($usuario['perfil'] === "3"){
										$selected = ($usuario['id'] == $carta_pedido['carteiro_associado']) ? ' selected="selected"' : "";

										echo '<option value="'.$usuario['id'].'" '.$selected.'>'.$usuario['nome'].'</option>';
									}
								} 
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="data_cadastro" class="control-label">Data Cadastro</label>
						<div class="form-group">
							<input disabled type="text" name="data_cadastro" value="<?php echo ($this->input->post('data_cadastro') ? $this->input->post('data_cadastro') : $carta_pedido['data_cadastro']); ?>" class="has-datetimepicker form-control" id="data_cadastro" />
							<span class="text-danger"><?php echo form_error('data_cadastro');?></span>
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