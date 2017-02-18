<?php if(!defined("APP_NAME")) exit(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 form-container" id="sign-in-form-container">
            <h2 class="sign-in-heading text-center">Sign In</h2>
            <form method="post" id="signInForm">
                <div class="form-group">
                    <label for="username">Email address or username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Email address or username" required />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember_me"> Remember me
                    </label>
                </div>
                <div class="alert alert-danger alert-errors"></div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button><hr />
                <p>If you don't have an account you can sign up via the link below.</p>
                <a href="#" id="sign-up-link">Sign Up</a>
                <input type="hidden" name="_token" class="token-field" value="<?php echo isset($_SESSION["token"]) ? $_SESSION["token"] : ""; ?>" />
            </form>
        </div>
    </div>
</div>