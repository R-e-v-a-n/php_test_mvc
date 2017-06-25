<!DOCTYPE html>
<html lang="ru">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
		<meta name="keywords" content="" />

		<title>Test MVC</title>

		<link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/css/common.css" />
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
	</head>
	<body>
        <div class="wrapper">
            <div class="header">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="logo">
                            <a href="/"><span>MVC Archetype</span></a>
                        </div>
                    </div>
                    <div class="col-xs-9">
                        <?php if(!isset($_SESSION["user_role"])) : ?>

                        <div class="header-form">
                            <form class="form-inline" action="/login" method="post">
                                <div class="form-group <?php echo !empty($data["login-error"]) ? "has-error" : ""; ?>">
                                    <input type="username" class="form-control" name="username" placeholder="Username">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <button type="submit" class="btn btn-primary form-control">Sign in</button>
                                </div>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="menu">
                <ul class="menu-cell">
                    <li class="menu-item item-level_1 inline"><a href="/">Главная</a></li>
                    <li class="menu-item item-level_1 inline"><a href="/Description">Описание задания</a></li>
                    <li class="menu-item item-level_1 inline"><a href="/Tasks/Show">Посмотреть задачки</a></li>
                    <li class="menu-item item-level_1 inline"><a href="/Tasks/Add">Добавить задачку</a></li>
                </ul>
                <ul class="menu-cell">
                    <?php if(isset($_SESSION["user_role"]) and $_SESSION["user_role"] == "ROLE_ADMIN") : ?>
                        <li class="menu-item item-level_1"><a href="/Admin">Админка</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="content">
                <?php include 'app/views/'.$content_view; ?>
            </div>

            <footer class="footer">
                <div class="container" align="center">
                    <p class="text-muted"><a href="/">Разработал: Сергей Лазарев &copy; 2017</a></p>
                </div>
            </footer>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
	</body>
</html>