<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Usuario Add</h3>
            </div>
            <?php echo form_open('usuario/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="nome" class="control-label">Nome</label>
						<div class="form-group">
							<input type="text" name="nome" value="<?php echo $this->input->post('nome'); ?>" class="form-control" id="nome" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="email" class="control-label">Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="senha" class="control-label">Senha</label>
						<div class="form-group">
							<input type="text" name="senha" value="<?php echo $this->input->post('senha'); ?>" class="form-control" id="senha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="perfil" class="control-label">Perfil</label>
						<div class="form-group">
							<input type="text" name="perfil" value="<?php echo $this->input->post('perfil'); ?>" class="form-control" id="perfil" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="removido" class="control-label">Removido</label>
						<div class="form-group">
							<input type="text" name="removido" value="<?php echo $this->input->post('removido'); ?>" class="form-control" id="removido" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="area_abrangencia" class="control-label">Area Abrangencia</label>
						<div class="form-group">
							<input type="text" name="area_abrangencia" value="<?php echo $this->input->post('area_abrangencia'); ?>" class="form-control" id="area_abrangencia" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="referencia" class="control-label">Referencia</label>
						<div class="form-group">
							<input type="text" name="referencia" value="<?php echo $this->input->post('referencia'); ?>" class="form-control" id="referencia" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="telefone" class="control-label">Telefone</label>
						<div class="form-group">
							<input type="text" name="telefone" value="<?php echo $this->input->post('telefone'); ?>" class="form-control" id="telefone" />
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