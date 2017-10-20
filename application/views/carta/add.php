<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Nova Carta</h3>
            </div>
            <?php echo form_open('carta/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="beneficiado" class="control-label"><span class="text-danger">*</span>Beneficiado</label>
						<div class="form-group">
							<select name="beneficiado" class="form-control">
								<option value=""></option>
								<?php 
								foreach($all_beneficiados as $beneficiado)
								{
									$selected = ($beneficiado['id'] == $this->input->post('beneficiado')) ? ' selected="selected"' : "";

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
						<label for="representante_comunidade" class="control-label"><span class="text-danger">*</span>Representante da Comunidade</label>
						<div class="form-group">
							<select name="representante_comunidade" class="form-control">
								<option value=""></option>
								<?php 
								foreach($all_repr_comunidade as $usuario)
								{
										$selected = ($usuario['id'] == $this->input->post('representante_comunidade')) ? ' selected="selected"' : "";

										echo '<option value="'.$usuario['id'].'" '.$selected.'>'.$usuario['first_name'].'</option>';

								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('representante_comunidade');?></span>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="carteiro_associado" class="control-label"></span>Carteiro</label>
						<div class="form-group">
							<select name="carteiro_associado" class="form-control">
								<option value=""></option>
								<?php 
								foreach($all_carteiros as $usuario)
								{
										$selected = ($usuario['id'] == $this->input->post('carteiro_associado')) ? ' selected="selected"' : "";

										echo '<option value="'.$usuario['id'].'" '.$selected.'>'.$usuario['first_name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('carteiro_associado');?></span>
						</div>
					</div>

				</div>

				<div class="row clearfix">
					<div class="col-md-4">
						<label for="regiao_administrativa" class="control-label"><span class="text-danger">*</span>Região Administrativa</label>
						<div class="form-group">
							<select name="regiao_administrativa" class="form-control">
								<option value=""></option>
								<?php 
									foreach($all_regioes as $regiao_administrativa)
									{
										$selected = ($regiao_administrativa['id'] == $carta_pedido['regiao_administrativa']) ? ' selected="selected"' : "";

										echo '<option value="'.$regiao_administrativa['id'].'" '.$selected.'>'.$regiao_administrativa['nome'].'</option>';
									} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('regiao_administrativa');?></span>
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