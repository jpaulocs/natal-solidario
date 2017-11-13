<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Novo usuário</h3>
            </div>
            <?php echo form_open('usuario/add'); ?>
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
					<div class="col-md-6">
						<label for="email" class="control-label"><span class="text-danger">*</span>Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" />
							<span class="text-danger"><?php echo form_error('email');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="senha" class="control-label"><span class="text-danger">*</span>Senha</label>
						<div class="form-group">
							<input type="text" name="senha" value="<?php echo $this->input->post('senha'); ?>" class="form-control" id="senha" />
							<span class="text-danger"><?php echo form_error('senha');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="area_abrangencia" class="control-label">Area Abrangência</label>
						<div class="form-group">
							<input type="text" name="area_abrangencia" value="<?php echo $this->input->post('area_abrangencia'); ?>" class="form-control" id="area_abrangencia" />
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="referencia" class="control-label">Referência</label>
						<div class="form-group">
							<input type="text" name="referencia" value="<?php echo $this->input->post('referencia'); ?>" class="form-control" id="referencia" />
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="telefone" class="control-label">Telefone</label>
						<div class="form-group">
							<input type="text" name="telefone" value="<?php echo $this->input->post('telefone'); ?>" class="form-control" id="telefone" />
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="perfil" class="control-label">Perfil</label>
						<div class="form-group">
							<?php 
								foreach($all_grupos as $grupo)
								{
									echo '<div class="checkbox"> 
											<label>
												<input type="checkbox" value="' . $grupo->id . '" name="perfil[]"/>'
											. $grupo->description . 
											'</label> 
										</div>';
								} 
							?>
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