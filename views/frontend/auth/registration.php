<div class="page-content">
	<div class="form-v6-content">
		<form class="form-detail" action="#" method="post">
			<h2>Register <b>Member</b></h2>
			<span style="margin-bottom: 30px; border-bottom: 3px solid #d0d0d0; display: block;"></span>
			<div class="form-ct">
				<input oninput="remove_error('.cus-name-error')" type="text" name="cus-name" id="cus-name" class="input-text" placeholder="Your Name">
				<span class="_error cus-name-error"></span>
			</div>
			<div class="form-ct">
				<input oninput="register_check_username();" type="text" name="user-name" id="user-name" class="input-text" placeholder="User Name">
				<span class="_error user-name-error"></span>
			</div>
			<div class="form-ct">
				<input oninput="register_check_email();" type="text" name="email" id="email" class="input-text" placeholder="Email Address">
				<span class="_error email-error"></span>
			</div>
			<div class="form-ct">
				<input oninput="remove_error('.password-error')" type="password" name="password" id="password" class="input-text" placeholder="Password">
				<span class="_error password-error"></span>
			</div>
			<div class="form-ct">
				<input oninput="remove_error('.confirm-password-error')" type="password" name="confirm-password" id="confirm-password" class="input-text" placeholder="Confirm Password">
				<span class="_error confirm-password-error"></span>
			</div>
			<div class="form-row-last">
				<button onclick="load_login();" type="button" class="btn btn-danger">Return</button>
				<input onclick="register_account();" type="button" name="register" class="register" value="Register">
			</div>
		</form>
	</div>
</div>