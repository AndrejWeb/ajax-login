<?php if(!defined("APP_NAME")) exit(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 form-container" id="sign-up-form-container">
            <h2 class="sign-in-heading text-center">Sign Up</h2>
            <form method="post" id="signUpForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required />
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required />
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
                </div>

                <div class="alert alert-success"></div>
                <div class="alert alert-danger alert-errors"></div>

                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign Up</button><hr />
                <p>If you have an account you can sign in via the link below.</p>
                <a href="#" id="sign-in-link">Sign In</a>
                <input type="hidden" name="_token" id="signup_token" class="token-field" value="<?php echo isset($_SESSION["token"]) ? $_SESSION["token"] : ""; ?>" />
            </form>

        </div>
    </div>
</div>