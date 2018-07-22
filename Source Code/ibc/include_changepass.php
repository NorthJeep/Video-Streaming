<?php

if(!defined('SADMIN_VIEW') && !defined('ADMIN_VIEW') && !defined('SUBEDIT_VIEW') && !defined('SELECT_VIEW')){
  die("<strong>403:</strong> Direct Access Forbidden!");
}

?>
  <!--Change Password Modal-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="chnge_pass" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
						<h4 class="modal-title">Change Password</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal tasi-form" role="form" method="POST" id="form_pass">
							<div class="form-group">
								<label class="col-lg-3 col-sm-2 control-label">Current Password</label>
								<div class="col-lg-9">
									<div class="input-group m-bot15">
										<input type="password" name="curr_pass" id="curr_pass" class="form-control" required>
										<span class="input-group-addon" id="show_pass" onmousedown="showPass()" onmouseup="hidePass()"><i class="icon-eye-open" id="icon_curr"></i></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 col-sm-2 control-label">New Password</label>
								<div class="col-lg-9" id="div_pass">
									<div class="input-group m-bot15">
										<input type="password" name="chng_pass" id="chng_pass" class="form-control" pattern="^(?=.*[a-z])(?=.*[0-9])(?!.*[A-Z])(?!.*\W)(?!.*\s).+$"  required>
										<span class="input-group-addon" id="show_pass" onmousedown="showPass2()" onmouseup="hidePass2()"><i class="icon-eye-open" id="icon_chng"></i></span>
									</div>
                                    <p class="help-block" id="pass_msg">The password must contain at lease one lowercase letter, one number, and be at least 6 characters long.</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 col-sm-2 control-label">Re-type Password</label>
								<div class="col-lg-9" id="div_pass2">
									<div class="input-group m-bot15">
										<input type="password" name="re_pass" id="re_pass" class="form-control" pattern="^(?=.*[a-z])(?=.*[0-9])(?!.*[A-Z])(?!.*\W)(?!.*\s).+$"  required>
										<span class="input-group-addon" id="show_pass" onmousedown="showPass3()" onmouseup="hidePass3()"><i class="icon-eye-open" id="icon_re"></i></span>
									</div>
                                    <p class="help-block" id="pass_msg2"></p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-3 col-lg-9">
									<button type="submit" name="submit_newpass" id="submit_newpass" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>

					  </div>

				  </div>
			  </div>
		  </div>