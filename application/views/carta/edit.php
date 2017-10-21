<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Editar Carta</h3>
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
						<label for="representante_comunidade" class="control-label"><span class="text-danger">*</span>Representante da Comunidade</label>
						<div class="form-group">
							<select name="representante_comunidade" class="form-control">
								<option value=""></option>
								<?php 
								foreach($all_repr_comunidade as $usuario)
								{
									$selected = ($usuario['id'] == $carta_pedido['representante_comunidade']) ? ' selected="selected"' : "";

									echo '<option value="'.$usuario['id'].'" '.$selected.'>'.$usuario['first_name'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="carteiro_associado" class="control-label"><span class="text-danger">*</span>Carteiro</label>
						<div class="form-group">
							<select name="carteiro_associado" class="form-control">
								<option value=""></option>
								<?php 
								foreach($all_carteiros as $usuario)
								{
									$selected = ($usuario['id'] == $carta_pedido['carteiro_associado']) ? ' selected="selected"' : "";

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

				<div class="row clearfix">
					<div class="box-header with-border">
	              		<h3 class="box-title">Checklist</h3>
	            	</div>

					<div class="col-md-6">
						
						<div class="checkbox">
					      <label><input type="checkbox" value="1" name="checklist_carta" <?php echo ($checklist['carta'] == 1) ? ' checked' : "";?> />Carta</label>
					    </div>
						<div class="checkbox">
					      <label><input type="checkbox" value="2" name="checklist_form_social" <?php echo ($checklist['formularo_social'] == 1) ? ' checked' : "";?>  />Formulário Social</label>
					    </div>
					    <div class="checkbox">
					      <label><input type="checkbox" value="3" name="checklist_doc_id_responsaveis"  <?php echo ($checklist['doc_identidade_responsaveis'] == 1) ? ' checked' : "";?> />Cópia do documento de identificação dos responsáveis</label>
					    </div>
					    <div class="checkbox">
					      <label><input type="checkbox" value="4" name="checklist_cert_nasc_crianca"  <?php echo ($checklist['certidao_nascimeno_crianca'] == 1) ? ' checked' : "";?> />Cópia da certidão de nascimento da criança</label>
					    </div>
					    <div class="checkbox">
					      <label><input type="checkbox" value="5" name="checklist_doc_bolsa_familia"  <?php echo ($checklist['doc_bolsa_familia'] == 1) ? ' checked' : "";?> />Cópia do documento de Bolsa Família</label>
					    </div>
					    <div class="checkbox">
					      <label><input type="checkbox" value="6" name="checklist_comp_escolar"  <?php echo ($checklist['comprovante_escolar'] == 1) ? ' checked' : "";?> />Cópia do comprovante escolar</label>
					    </div>
					    <div class="checkbox">
					      <label><input type="checkbox" value="7" name="checklist_doc_pne"  <?php echo ($checklist['doc_pne'] == 1) ? ' checked' : "";?> />Cópia do documento de PNE, se for o caso</label>
					    </div>
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