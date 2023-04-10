<?php
$firstName = $lastName = $username = $password = $passwordAgain = $phone = $email = "";
$firstNameErr = $lastNameErr = $usernameErr = $passwordErr = $passwordAgainErr = $phoneErr = $emailErr = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (empty($_POST['password'])) {
		$passwordErr = "Mật Khẩu Không Được Bỏ Trống";
	} else {
		$pass = $_POST['password'];
		// 		Ít nhất một chữ số[0-9]
		// Ít nhất một ký tự chữ thường[a-z]
		// Ít nhất một ký tự viết hoa[A-Z]
		// Ít nhất một ký tự đặc biệt[*.!@#$%^&(){}[]:;<>,.?/~_+-=|\]

		// Độ dài ít nhất 8 ký tự nhưng không quá 20 ký tự.
		if (!preg_match_all("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/", $pass)) {
			$passwordErr = "Ít nhất một chữ số[0-9],
			Ít nhất một ký tự chữ thường[a-z],
			Ít nhất một ký tự viết hoa[A-Z],
			Ít nhất một ký tự đặc biệt[*.!@#$%^&(){}[]:;<>,.?/~_+-=|\],

			Độ dài ít nhất 8 ký tự nhưng không quá 20 ký tự.";
		} else {
			$passwordErr = "";
		};
	};
	if (empty($_POST['first_name'])) {
		$firstNameErr = "Tên Không Được Bỏ Trống";
	} else {
		$firstNameErr = "";
	};

	if (empty($_POST['last_name'])) {
		$lastNameErr = "Họ Không Được Bỏ Trống";
	} else {
		$lastNameErr = "";
	};

	if (empty($_POST['username'])) {
		$usernameErr = "Tên Đang Nhập Không Được Bỏ Trống";
	} else {
		$usernameErr = "";
	};

	if (empty($_POST['passwordAgain'])) {
		$passwordAgainErr = "Mật Khẩu Không Được Bỏ Trống";
	} else {
		$passAgain = $_POST['passwordAgain'];

		if ($pass != $passAgain) {
			$passwordAgainErr = "Mật Khẩu Lặp Lại Không Khớp";
		} else {
			$passwordAgainErr = "";
		};
	}

	if (empty($_POST['phone'])) {
		$phoneErr = "Số điện thoại không được để trống";
	} else {
		$phone = $_POST['phone'];
		if (!preg_match("/^[0]{1}\d{9,10}/", $phone)) {
			$phoneErr = "số điện thoại không đúng định dạng";
		} else {
			$phoneErr = "";
		};
	}
	if (empty($_POST['email'])) {
		$emailErr = "Email không được để trống";
	} else {
		$email = $_POST['email'];
		/*  / / bắt đầu và kêt thúc biểu thức
			^ điểm bắt đầu của dòng
			([a-z0-9\+_\-]+) tập hợp các chữ cái từ a-z và các số 0-9 và ký tự đặc biệt lặp lại 1 hoặc nhiều lần

		*/
		if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
			$emailErr = "email không đúng định dạng";
		} else {
			$emailErr = "";
		};
	}
}

?>
<div class="sectionRegister">
	<div class="d-flex justify-content-center">
		<div class="card">
			<div class="card-header">
				<h3>Sign Up</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form action="<?php
								if ($firstNameErr != "" || $lastNameErr != "" || $usernameErr != "" || $passwordErr != "" || $passwordAgainErr != "" || $phoneErr != "" || $emailErr != "") {
									echo "admin.php?act=auth&use=register";
								} else {
									echo "admin.php?act=auth&use=register_action";
								}


								?>" method="post">

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="first_name" class="form-control" placeholder="First name">

					</div>
					<div>
						<span class="text-danger"><?php if (isset($firstNameErr)) {
														echo $firstNameErr;
													}  ?></span>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="last_name" class="form-control" placeholder="Last name">

					</div>
					<div>
						<span class="text-danger"><?php if (isset($lastNameErr)) {
														echo $lastNameErr;
													}  ?></span>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="username" class="form-control" placeholder="username">

					</div>
					<div>
						<span class="text-danger"><?php if (isset($usernameErr)) {
														echo $usernameErr;
													}  ?></span>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="password">

					</div>
					<div>
						<span class="text-danger"><?php if (isset($passwordErr)) {
														echo $passwordErr;
													}  ?></span>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="passwordAgain" class="form-control" placeholder="password again">

					</div>
					<div>
						<span class="text-danger"><?php if (isset($passwordAgainErr)) {
														echo $passwordAgainErr;
													}  ?></span>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-phone"></i></span>
						</div>
						<input type="text" name="phone" class="form-control" placeholder="Phone">


					</div>
					<div>
						<span class="text-danger"><?php if (isset($phoneErr)) {
														echo $phoneErr;
													}  ?></span>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
						</div>
						<input type="email" name="email" class="form-control" placeholder="email">


					</div>
					<div>
						<span class="text-danger"><?php if (isset($emailErr)) {
														echo $emailErr;
													}  ?></span>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Register" class="btn float-right btn-login">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="admin.php?act=auth&use=login">Sign In</a>
				</div>
				<div class="d-flex justify-content-center links">
					<a href="admin.php?act=auth&use=changePassword">Change password?</a>
				</div>
				<div class="d-flex justify-content-center links">
					<a href="admin.php?act=auth&use=forgotPassword">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>