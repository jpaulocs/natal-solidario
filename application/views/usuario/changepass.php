<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Alterar senha - <?php echo $usuario['email']; ?></h3>
            </div>
			<?php echo form_open('usuario/changepass/'.$usuario['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-4">
						<label for="senha" class="control-label">Nova senha</label>
						<div class="form-group">
							<input type="password" name="senha" value="" class="form-control" id="senha" />
							<span class="text-danger"><?php echo form_error('senha');?></span>
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