<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Usuário</h3>
            </div>
			<?php echo form_open('usuario/edit/'.$usuario['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="nome" class="control-label"><span class="text-danger">*</span>Nome</label>
						<div class="form-group">
							<input type="text" name="nome" value="<?php echo ($this->input->post('nome') ? $this->input->post('nome') : $usuario['first_name']); ?>" class="form-control" id="nome" />
							<span class="text-danger"><?php echo form_error('nome');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="email" class="control-label"><span class="text-danger">*</span>E-mail</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $usuario['email']); ?>" class="form-control" id="email" />
							<span class="text-danger"><?php echo form_error('email');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="area_abrangencia" class="control-label">Area Abrangência</label>
						<div class="form-group">
							<input type="text" name="area_abrangencia" value="<?php echo ($this->input->post('area_abrangencia') ? $this->input->post('area_abrangencia') : $usuario['area_abrangencia']); ?>" class="form-control" id="area_abrangencia" />
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="referencia" class="control-label">Referência</label>
						<div class="form-group">
							<input type="text" name="referencia" value="<?php echo ($this->input->post('referencia') ? $this->input->post('referencia') : $usuario['referencia']); ?>" class="form-control" id="referencia" />
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="telefone" class="control-label">Telefone</label>
						<div class="form-group">
							<input type="text" name="telefone" value="<?php echo ($this->input->post('telefone') ? $this->input->post('telefone') : $usuario['phone']); ?>" class="form-control" id="telefone" />
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="perfil" class="control-label">Perfil</label>
							<?php
								foreach($all_grupos as $grupo)
								{
									$pertenceGrupo = false;
									foreach($all_grupos_usuario as $grupo_usuario)
									{
										if($grupo->id == $grupo_usuario->id) {
											$pertenceGrupo = true;
											break;
										}
									}
									echo '<div class="checkbox"> 
											<label>
												<input type="checkbox"' . ($pertenceGrupo ? ' checked' : "") . ' value="' . $grupo->id . '" name="perfil[]"/>'
											. $grupo->description . 
											'</label> 
										</div>';
								} 
							?>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<div class="form-group">
							<a href="<?php echo site_url('usuario/changepass/'.$usuario['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Alterar senha</a> 
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Salvar
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>