        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-form">
                        <h3 class="form-title"><?= $page ?></h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input class="signin-signup-input" type="text" name="username" id="your_name" placeholder="User Name"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input class="signin-signup-input" type="password" name="password" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <button  type="submit" class="btn btn-sm btn-primary" id="btn-login"type="button">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>