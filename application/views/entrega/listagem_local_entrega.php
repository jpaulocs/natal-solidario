<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Locais de entrega dos presentes</h3>
            	<div class="box-tools">
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Região administrativa</th>
						<th>Local</th>
						<th></th>
                    </tr>
                    <?php foreach($locaisEntrega as $local){ ?>
                    <tr>
                        <td><?php echo $local['regiao_administrativa_nome']; ?></td>
                        <td><?php echo $local['nomeLocalEntrega']; ?></td>
						<td>
                            <a href="<?php echo site_url('entrega/cartas/'.$local['regiao_administrativa_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Cartas recebidas</a> 
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
