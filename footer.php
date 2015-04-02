			<div class="footer">

				<div class="row">

					<div class="col-xs-6">

						<p class="footer_text text-left">

							<?php echo $db->GetText('footer_address_copyright_text', $pageLang);	?>

						</p>

					</div>

					<div class="col-xs-6" >

						<p class="footer_text text-right">

							<?php
								echo $db->GetText('footer_designby_text', $pageLang);
								echo "<br/>";
								echo $db->GetText('footer_createdby_text', $pageLang);
							?>

						</p>

					</div>

				</div>

			</div>