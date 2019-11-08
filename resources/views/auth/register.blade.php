@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
            <img src="assets/img/logo.png" alt=""/>
            </div>
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">                  
                <div class="panel-heading">
                    <h3 class="panel-title">Register</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('register') }}" role="form">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" type="text" value="{{ old('name') }}" autofocus required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-mail" name="email" type="email" value="{{ old('email') }}" autofocus required>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input id="location" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="Location" name="location" type="text" value="{{ old('location') }}" autofocus required>
                                @if ($errors->has('location'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" type="password" value="">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                            
                            <div class="checkbox">
                                <label>
                                        Allready has account ? 
                                    <a href="/login">Click here to login</a>
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">
                                Register
                            </button>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/import/jquery-library.js"></script>
<script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
<script src="/js/import/sweetalert.min.js"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

<!-- toaster notification -->
{{-- <script type="text/javascript" src="/js/import/toastr.min.js"></script> --}}
<!-- toaster notification -->
{{-- <link rel="stylesheet" type="text/css" href="/js/import/toastr.min.css"/> --}}

@if(Session::has('success')) 
<script> 
	toastr.success("Product Shared!");
</script>

@endif
<script>
    $(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $('#location').val("Valencia City")
    });
</script>

@endsection
