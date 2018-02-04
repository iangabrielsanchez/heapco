@extends('layouts.simplified') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 margin-top-30">
			<h2>
				<a href="/">HeapCo</a> | Login</h2>
			<div class="panel panel-primary">
				<div class="panel-heading">Login</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ old('email') }}"
								    required autofocus> @if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-md-4 control-label">Password</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password" placeholder="Password" required> @if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember" {{ old( 'remember') ? 'checked' : '' }}> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Login
									<i class="fa fa-arrow-circle-right"></i>
								</button>
								<a class="btn btn-link" href="{{ url('/password/reset') }}">
									Forgot Your Password?
								</a><br/>
								<small>If you want to have a new account, contact: 0187498739</small>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection