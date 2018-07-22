  <?php

  if(!defined('EDIT_VIEW')){
	  die("<strong>403:</strong> Direct Access Forbidden!");
	}

	$query_ar = mysqli_query($connect, "SELECT * FROM `refresh` WHERE `id` = 2");
	$row_ar = mysqli_fetch_array($query_ar);

	$get_arfsh = $row_ar['refresh'];

  ?>

  <!--Set Auto Refresh Modal-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="auto_refresh" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
						<h4 class="modal-title">Set Automatic Refresh</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal tasi-form" role="form" method="POST">
							<div class="form-group">
								<label class="col-lg-3 col-sm-2 control-label">Refresh After</label>
								<div class="col-lg-9">
									<select class="form-control m-bot15" name="ar_secs">
					                    <option value="36000" <?php if ($get_arfsh == '36000') echo 'selected'; ?>>10 hours</option>
					                    <option value="25200" <?php if ($get_arfsh == '25200') echo 'selected'; ?>>7 hours</option>
					                    <option value="18000" <?php if ($get_arfsh == '18000') echo 'selected'; ?>>5 hours</option>
					                    <option value="10800" <?php if ($get_arfsh == '10800') echo 'selected'; ?>>3 hours</option>
					                    <option value="7200" <?php if ($get_arfsh == '7200') echo 'selected'; ?>>2 hours</option>
					                    <option value="3600" <?php if ($get_arfsh == '3600') echo 'selected'; ?>>1 hour</option>
					                    <option value="1800" <?php if ($get_arfsh == '1800') echo 'selected'; ?>>30 minutes</option>
					                    <option value="1200" <?php if ($get_arfsh == '1200') echo 'selected'; ?>>20 minutes</option>
					                 </select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-3 col-lg-9">
									<input type="hidden" id="edit" name="edit" value="1">
									<button type="submit" name="submit_autor" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>

					  </div>

				  </div>
			  </div>
		  </div>