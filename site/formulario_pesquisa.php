<div class="search">
		<div class="container-16">
			<h2>PESQUISE</h2>
			<form method="GET" action="listaImoveis.php">
				<table>

					<tr>
						<td>
							<select name="op">
								<?php echo listaOperacoes(); ?>
							</select>
						</td>

						<td>
							<select name="cidade">
								<option value=""></option>
								<?php echo listaCidades(); ?>
							</select>
						</td>

						<td>
							<select name="bairro">
								<option value=""></option>
								<?php echo listaBairros(); ?>
							</select>
						</td>

						<td>
							<select name="tipo">
								<option value=""></option>
								<?php echo listaTipos(); ?>
							</select>
						</td>

						<td>
							<select name="dormitorio">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>
							<input type="submit" value="BUSCAR">
						</td>
					</tr>
				</table>
			</form>	
		</div>
</div>
