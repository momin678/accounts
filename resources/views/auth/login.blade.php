<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login page</title>
	<link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/my-login.css')}}">
</head>
<style>
	body {
  background-image: url('{{asset('assets/img/cybersecurity_padlock_bkgrd.jpg')}}');
  background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: cover;
}
.input_filed{
	background-color: #b3e2f5eb !important; 
	border: 0px  !important; 
}
.form_bg{
	border: 2px solid; 
	background-color: #17171b7d !important;
}
</style>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
			
					<div class="cardx fat mt-5">
						<div class="card-body form_bg">
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation" autocomplete="off" action="{{ route('login') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control input_filed" name="email" value="" required autofocus placeholder="Enter email">
                                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control input_filed" name="password" required data-eye placeholder="Enter password">
                                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remeber Me
											<a href="{{route('password.request')}}" class="float-right">
												Forgot Password?
											</a>
										</label>
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-block">
									Login
								</button>
							</form>
							<div  class="form-group text-center mt-2">
							    <a href="{{route('social.login', 'facebook')}}" class="btn input_filed btn-sm"> Login with Facebook</a>
							    <!--<a href="{{route('register')}}" class="btn input_filed btn-sm">Twitter Login</a>-->
							    <a href="{{route('social.login', 'google')}}" class="btn input_filed btn-sm"> Login with Google</a>
							</div>
							<div class="mt-4 text-center">
								Don't have an account? <a href="{{route('register')}}">Create One</a>
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</section>

    <script src="{{asset('assets/jquery-3.6.0.min.js')}}"></script>
	<script src="{{asset('assets/bootstrap/js/bootstrap.js')}}"></script>
	<script src="{{asset('assets/js/my-login.js')}}"></script>
</body>
</html>