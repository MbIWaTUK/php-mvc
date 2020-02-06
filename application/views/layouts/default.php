<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?></title>
        <script src="/public/scripts/jquery.js"></script>
        <script src="/public/scripts/form.js"></script>
        <link href="/public/styles/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['account']['id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/list">Список</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/request">Заявка</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/account/profile">Профиль</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/account/logout">Выход</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/account/register">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/account/login">Вход</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
        <?php echo $content; ?>
    </body>
</html>