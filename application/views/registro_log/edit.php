<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Registro Log Edit</h3>
            </div>
			<?php echo form_open('registro_log/edit/'.$registro_log['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="data_cadastro" class="control-label">Data Cadastro</label>
						<div class="form-group">
							<input type="text" name="data_cadastro" value="<?php echo ($this->input->post('data_cadastro') ? $this->input->post('data_cadastro') : $registro_log['data_cadastro']); ?>" class="has-datetimepicker form-control" id="data_cadastro" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="usuario" class="control-label">Usuario</label>
						<div class="form-group">
							<input type="text" name="usuario" value="<?php echo ($this->input->post('usuario') ? $this->input->post('usuario') : $registro_log['usuario']); ?>" class="form-control" id="usuario" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="acao" class="control-label">Acao</label>
						<div class="form-group">
							<input type="text" name="acao" value="<?php echo ($this->input->post('acao') ? $this->input->post('acao') : $registro_log['acao']); ?>" class="form-control" id="acao" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="titulo" class="control-label">Titulo</label>
						<div class="form-group">
							<input type="text" name="titulo" value="<?php echo ($this->input->post('titulo') ? $this->input->post('titulo') : $registro_log['titulo']); ?>" class="form-control" id="titulo" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="conteudo_anterior" class="control-label">Conteudo Anterior</label>
						<div class="form-group">
							<textarea name="conteudo_anterior" class="form-control" id="conteudo_anterior"><?php echo ($this->input->post('conteudo_anterior') ? $this->input->post('conteudo_anterior') : $registro_log['conteudo_anterior']); ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<label for="conteudo_posterior" class="control-label">Conteudo Posterior</label>
						<div class="form-group">
							<textarea name="conteudo_posterior" class="form-control" id="conteudo_posterior"><?php echo ($this->input->post('conteudo_posterior') ? $this->input->post('conteudo_posterior') : $registro_log['conteudo_posterior']); ?></textarea>
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