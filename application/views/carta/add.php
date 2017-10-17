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
								foreach($all_usuarios as $usuario)
								{
									if($usuario['perfil'] === "1"){
										$selected = ($usuario['id'] == $this->input->post('representante_comunidade')) ? ' selected="selected"' : "";

										echo '<option value="'.$usuario['id'].'" '.$selected.'>'.$usuario['nome'].'</option>';

									}
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('representante_comunidade');?></span>
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
								foreach($all_usuarios as $usuario)
								{
									if($usuario['perfil'] === "3"){
										$selected = ($usuario['id'] == $this->input->post('carteiro_associado')) ? ' selected="selected"' : "";

										echo '<option value="'.$usuario['id'].'" '.$selected.'>'.$usuario['nome'].'</option>';
									}
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
								<option value="20">Águas Claras</option>
								<option value="4">Brazlândia</option>
								<option value="1">Plano Piloto</option>
								<option value="19">Candangolândia</option>
								<option value="9">Ceilândia</option>
								<option value="11">Cruzeiro</option>
								<option value="31">Fercal</option>
								<option value="2">Gama</option>
								<option value="10">Guará</option>
								<option value="28">Itapoã</option>
								<option value="27">Jardim Botânico</option>
								<option value="18">Lago Norte</option>
								<option value="16">Lago Sul</option>
								<option value="8">Núcleo Bandeirante</option>
								<option value="7">Paranoá</option>
								<option value="24">Park Way</option>
								<option value="6">Planaltina</option>
								<option value="15">Recanto das Emas</option>
								<option value="17">Riacho Fundo</option>
								<option value="21">Riacho Fundo II</option>
								<option value="12">Samambaia</option>
								<option value="13">Santa Maria</option>
								<option value="14">São Sebastião</option>
								<option value="25">SCIA</option>
								<option value="29">SIA</option>
								<option value="5">Sobradinho</option>
								<option value="26">Sobradinho II</option>
								<option value="22">Sudoeste/Octogonal</option>
								<option value="3">Taguatinga</option>
								<option value="23">Varjão</option>
								<option value="30">Vicente Pires</option>
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