<?php 
    require_once(dirname(__DIR__).'/../utils/sessions.php');
    
    if(!$_SESSION['is_admin']){
        header("Location: /dashboards/leader/leader.php");
    }

    require_once dirname(__DIR__).'/../utils/bd.php';
?>

<?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        $errors = array();
        
        if(isset($data['create_user'])){
            if($data['password2'] != $data['password1']){
                $errors[] = "Пароли не совпадают";
            } else {
                $find_user = R::findOne("users","login = ?",array($data['login']));

                if($find_user){
                    $errors[] = "Такой логин зарегистрирован";
                } else {
                    if(empty($errors)){
                        $new_user = R::dispense("users");
                        $new_user->login = $data['login'];
                        $new_user->password = password_hash($data['password1'],PASSWORD_DEFAULT);
                        $new_user->role = $data['role'];
                        $new_user->avatar = null;
                        $new_user->shanyrak = $data['shanyrak'];
                        R::store($new_user);

                        $new_action = R::dispense("history");
                        $new_action->action = 2;
                        $new_action->acted_to = $new_user->id;
                        $new_action->author = $_SESSION['user_id'];
                        $new_action->type = 'user';
                        R::store($new_action); 

                        $success[] = 'Пользователь успешно создан';
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
  <title>
    Добавить пользователя | Президент
  </title>

  <!-- Favicon -->
  <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">

  <link href="/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- CSS Files -->
  <link href="/assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />

  <link rel="stylesheet" href="/assets/styles.css">

</head>
<body>
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Brand -->
      <a class="navbar-brand pt-0" href="admin.php">
        <div class="d-flex flex-row justify-content-center align-items-center">
            <img src="/assets/favicon.jpg" class="img-fluid nis-brand" alt="">
            <h1 class="">NIS Rating</h1>
        </div>
      </a>

      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="/assets/img/theme/team-1-800x800.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <a href="profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Мой профиль</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="/auth/logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Выйти</span>
            </a>
          </div>
        </li>
      </ul>
      
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
                <div class="row justify-content-center align-items-center">
                    <img src="/assets/favicon.jpg" class="img-fluid ">
                    <h1 class="ml-2">NIS Rating</h1>
                </div>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="admin.php">
              <i class="ni ni-tv-2 text-primary"></i> Панель управления
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add_points.php">
              <i class="fas fa-plus text-success"></i> Добавить баллы
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="history.php">
              <i class="fas fa-list-ul text-warning"></i> История действий
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="points.php">
              <i class="fas fa-list-ul text-success"></i> Запросы
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create_user.php">
              <i class="fas fa-user-plus text-info"></i> Добавить аккаунт
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="delete_user.php">
              <i class="fas fa-user-times text-danger"></i> Удалить аккаунт
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="/index.php">
              <i class="fas fa-home text-info"></i> Вернуться на главную
            </a>
          </li>          
        </ul>

      </div>

    </div>
  </nav>

  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="admin.php">Добавить пользователя </a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="/assets/img/users/<?php echo (!isset($_SESSION['avatar']))? 'placeholder.jpg' : $_SESSION['avatar']; ?>">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo (!isset($_SESSION['user']))? 'user' : $_SESSION['user']; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <!-- <a href="profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Мой профиль</span>
              </a> -->
              <div class="dropdown-divider"></div>
              <a href="/auth/logout.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Выйти</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      
    </div>
    <div class="container-fluid mt--9">   
      <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow py-5">
            <!-- Display errors -->
            <?php 
                if(!empty($errors)){ ?>
                    <div class="col-12 bg-white py-1 mb-5">
                        <h2 class="text-center text-danger">
                            <?php  
                                echo array_shift($errors);
                            ?>
                        </h2>
                    </div>
                <?php }
            ?>
            <!-- Display errors -->
            <?php 
                if(!empty($success)){ ?>
                    <div class="col-12 bg-white py-1 mb-5">
                        <h2 class="text-center text-success">
                            <?php  
                                echo array_shift($success);
                            ?>
                        </h2>
                    </div>
                <?php }
            ?>
            <h1 class="text-center">Добавить пользователя</h1>
            <div class="col-10 mx-auto py-5 mt-3">
                <div class="container row">
                    <div class="col-12">
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <div class="form-group">
                                <label>Логин</label>
                                <input type="text" name="login" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Пароль</label>
                                <input type="password" name="password1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Повторите пароль</label>
                                <input type="password" name="password2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Роль</label>
                                <select name="role" class="form-control">
                                  <?php 
                                    $roles = R::findAll('roles');
                                    if($roles){
                                      foreach($roles as $role){ ?>
                                        <option value="<?php echo $role->id; ?>"><?php echo $role->role; ?></option>
                                      <?php }
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Шанырак</label>
                              <select name="shanyrak" class="form-control">
                                <?php 
                                  $shanyraks = R::findAll('shanyraks');
                                  if($shanyraks){
                                    foreach($shanyraks as $shanyrak){ ?>
                                      <option value="<?php echo $shanyrak->id; ?>"><?php echo $shanyrak->shanyrak; ?></option>
                                    <?php }
                                  }
                                ?>
                              </select>
                            </div>
                            <button class="btn btn-lg btn-block btn-success w-25 mx-auto" type="submit" name="create_user">Создать</button>
                        </form>
                    </div>    
                </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-dark">
              &copy; <?php echo date('Y'); ?>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://github.com/I0bSTeR" class="nav-link text-dark" target="_blank">I0bSTeR</a>
                <a href="https://github.com/ElamanGOD" class="nav-link text-dark" target="_blank">zackdon</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--   Core   -->
  <script src="/assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="/assets/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="/assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <!--   Argon JS   -->
  <script src="/assets/js/argon-dashboard.min.js?v=1.1.0"></script>

  <script src="/assets/scripts.js"></script>
</body>

</html>