<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Reporte de Expedicion</title>

		<style>
			.invoice-box {
				max-width: 1400px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
                                <img src="<?php echo e($institute->getFirstMediaUrl('institutes')); ?>" alt="Institute Image"
                                class="img-fluid mb-2" style="width: 100%; max-width: 300px">
									
								</td>

								<td>
                                <span>Reference::</span> <strong><?php echo e($expedition->reference); ?></strong><br />
                                Versión: <strong> 01</strong><br />
                                Vigente: <strong> Junio 2024</strong>
                                    
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
                                <h4 class="print-title-1 border-bottom; padding-bottom: 10px;">Institución:</h4>
                                    <div><?php echo e(Institutes()->institute_name); ?></div>
                                    <div>Dirección: <?php echo e(Institutes()->institute_address); ?></div>
                                    <div>Área: <?php echo e(Institutes()->institute_area); ?></div>
                                    <div>Ciudad: <?php echo e(Institutes()->institute_city); ?></div>
                                    <div>País: <?php echo e(Institutes()->institute_country); ?></div>
								</td>

								<td>
                                <h4 class="print-title-1 border-bottom; padding-bottom: 10px;">Información de Despacho: </h4>
                                <div><strong>Temperatura del Ambiente: </strong> <?php echo e($expedition->temp_ambiente); ?>

                                </div>
                                <div><strong>Operario:</strong> <?php echo e($expedition->operator); ?></div>
                                <div><strong>Personal Retiro: </strong> <?php echo e($expedition->staff_expedition); ?></div>
								</td>
                                <td>
                                <h5 class="print-title-1 border-bottom; padding-bottom: 10px">Registro INFO:</h5>
                                    <div>Número: <strong><?php echo e($expedition->reference); ?></strong></div>
                                    <div><strong>Fecha Despacho:
                                        </strong><?php echo e(\Carbon\Carbon::parse($expedition->created_up)->format('d M, Y')); ?>

                                    </div>
                                    <div><strong>Estado de la expedición: </strong>
                                        <?php echo e($expedition->status_expedition); ?></div>


                                    <div><strong>Area Expedido: </strong> <?php echo e($expedition->area_expedition); ?></div>
                                </td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>

					<td>Check #</td>
				</tr>

				<tr class="details">
					<td>Check</td>

					<td>1000</td>
				</tr>

				<tr class="heading">
					<td>Item</td>

					<td>Price</td>
				</tr>

				<tr class="item">
					<td>Website design</td>

					<td>$300.00</td>
				</tr>

				<tr class="item">
					<td>Hosting (3 months)</td>

					<td>$75.00</td>
				</tr>

				<tr class="item last">
					<td>Domain name (1 year)</td>

					<td>$10.00</td>
				</tr>

				<tr class="total">
					<td></td>

					<td>Total: $385.00</td>
				</tr>
			</table>
		</div>
        <div class="row" style="margin-top: 25px;">
                            <div class="col-xs-12">
                                <p style="font-style: bold;text-align: center"><strong>NOTA:</strong> Asegurarse que el producto entregado sea el correcto.</p>
                                <p style="font-style: italic;text-align: center"><?php echo e(settings()->company_name); ?> &copy;
                                    <?php echo e(date('Y')); ?>; Correo: <?php echo e(settings()->company_email); ?> 
                                    - Telf: <?php echo e(settings()->company_phone); ?> </p>
                            </div>
                        </div>
	</body>

</html><?php /**PATH /var/www/html/Modules/Expedition/Resources/views/expeditions/print3.blade.php ENDPATH**/ ?>