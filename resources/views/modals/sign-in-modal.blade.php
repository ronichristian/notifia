<div class="modal fade" id="sign-in-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- -->
            <div class="modal-body modal-body-sub_agile">
                <div class="main-mailposi">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                </div>
                <div class="modal_body_left modal_body_left1">
                    <h3 class="agileinfo_sign">Sign In </h3>
                    <p>
                        Sign In now, Let's start your Grocery Shopping. Don't have an account?
                        <a href="" data-toggle="modal" data-target="#sign-up-modal">
                            Sign Up Now</a>
                    </p>
                    

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="styled-input agile-styled-input-top">
                            <input type="email" placeholder="Email Address" name="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required="">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="styled-input">
                            <input type="password" placeholder="Password" name="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" required="">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <input type="submit" value="Sign In">
                    </form>

                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- -->
        </div>
        <!-- //Modal content-->
    </div>
</div>