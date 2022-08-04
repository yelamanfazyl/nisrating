<?php
    session_start();

    if(isset($_SESSION['user'])){
        if($_SESSION['is_admin']){   
            header('Location: /dashboards/admin/admin.php');   
            die(); 
        } else {
            header('Location: /dashboards/leader/leader.php');   
            die(); 
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // The request is using the POST method
        require_once "../utils/bd.php";
    
        $data = $_POST;
        $errors = array();

        if(isset($data['do_login'])){      
            $user = R::findOne("users","login = ?", array($data['login']));

            if($user){
                if(password_verify($data['password'], $user->password)){
                    $_SESSION['user'] = $user->login;
                    $_SESSION['is_admin'] = (bool)((int)$user->role == 1) ? TRUE : FALSE;
                    $_SESSION['avatar'] = $user->avatar;
                    $_SESSION['user_id'] = $user->id; 
                    $_SESSION['shanyrak'] = (int)$user->shanyrak;
                    
                    if($user->role == '1'){
                        header("Location: /dashboards/admin/admin.php");
                        die();
                    } else {
                        header("Location: /dashboards/leader/leader.php");
                        die();
                    }

                } else {
                    $errors[] = 'Неправильный пароль';
                }
            } else {
                $errors[] = 'Неправильный логин';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicon -->
    <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">
    <link rel="stylesheet" href="/assets/styles.css">

    <title>Логин</title>

</head>
<body class="bg-body vh-100">
    <!-- Display errors -->
    <?php 
        if(!empty($errors)){ ?>
            <div class="col-12 bg-white py-1">
                <h2 class="text-center text-danger">
                    <?php  
                        echo $errors[0];
                    ?>
                </h2>
            </div>
        <?php }
    ?>

    <div class="row h-100 justify-content-center align-items-center">
        <form class="col-10 col-md-6 col-lg-4 bg-white py-5" method="post">
            <div class="form-group">
                <h2 class="text-center text-dark py-3">Авторизация</h2> 
            </div>
            <div class="form-group w-75 mx-auto">
                <label for="formGroupExampleInput">Логин</label>
                <input name="login" type="text" class="form-control" placeholder="Ваш логин" required>
            </div>
            <div class="form-group w-75 mx-auto">
            <label for="formGroupExampleInput">Пароль</label>
                <input name="password" type="password" class="form-control" placeholder="Ваш пароль" required>
            </div>
            <div class="form-group pt-4">
                <button class="btn btn-lg btn-block w-50 btn-success mx-auto" type="submit" name="do_login">Логин</button>
            </div>
        </form> 
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>