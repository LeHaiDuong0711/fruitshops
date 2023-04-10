<div class="sectionLogin">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form action="admin.php?act=auth&use=login_act" method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="username" name="username" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="password" name="password" required>
                        </div>
                        <div class="remember">
                       <input type="checkbox"> Remember Me
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn btn-login" name="submit">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?<a href="admin.php?act=auth&use=register">Sign Up</a>
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