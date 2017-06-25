<div class="container text-center">
    <h2>.::Авторизация::.</h2>
    <hr color="red"/>

    <form method="POST" action="/login" class="form form-signin">

        <div class="form-group <?php echo $data["login-error"] == "access_denied" ? 'has-error' : ''; ?>">
            <span><?php echo $data["login-error"] == "access_denied" ? 'Логин и/или пароль введены неверно.' : ''; ?></span>
            <input name="username" type="text" class="form-control" placeholder="Username"
                   autofocus="true"/>
            <input name="password" type="password" class="form-control" placeholder="Password"/>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        </div>
    </form>

</div>

