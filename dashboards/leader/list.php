<?php 
  require_once(dirname(__DIR__).'/../utils/sessions.php');

  require_once dirname(__DIR__).'/../utils/bd.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
  <title>
    Мои предложения | Лидер шанырака
  </title>

  <!-- Favicon -->
  <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">

  <link href="/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/libs/image-uploader/image-uploader.min.css">
  
  <link rel="stylesheet" href="/assets/libs/fancybox/jquery.fancybox.min.css">

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
      <a class="navbar-brand pt-0" href="leader.php">
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
                <img alt="Image placeholder" src="/assets/img/users/<?php echo (!isset($_SESSION['avatar']))? 'placeholder.jpg' : $_SESSION['avatar']; ?>">
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
            <a class="nav-link" href="leader.php">
              <i class="ni ni-tv-2 text-primary"></i> Панель управления
            </a>
          </li>    
          <li class="nav-item">
            <a class="nav-link" href="list.php">
              <i class="fas fa-list text-warning"></i> Мои предложения
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="leader.php">Мои предложения </a>
        
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
            <h1 class="text-center">Мои предложения</h1>
            <div class="col-12 mx-auto py-5 mt-3">
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <tbody class="list">                       
                            <?php
                            $points = R::findAll("points", "author = ? ORDER BY id DESC", array($_SESSION['user_id']));
                            
                            if(isset($points)){
                                foreach($points as $point){ ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                echo $point->id;
                                            ?>
                                        </td>
                                        <td>    
                                            <?php 
                                                $student = R::findOne("students", "id = ?", array($point->added_to));
                                                echo $student->first_name." ".$student->middle_name." ".$student->last_name;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $category = R::findOne("categories", "id = ?", array($point->category));
                                                echo $category->category;
                                            ?>
                                            <br>
                                            <?php 
                                                $place = R::findOne("places", "id = ?", array($point->place));
                                                echo $place->place;
                                            ?>
                                            <br>
                                            <?php 
                                                $type = R::findOne("types", "id = ?", array($point->type));
                                                echo $type->type;
                                            ?>
                                            <br>
                                            <?php 
                                                echo $point->part_amount." участник";
                                            ?>
                                        </td>
                                        <td class="<?php echo ($point->points > 1) ? 'text-success' : 'text-danger'; ?>">
                                            <?php 
                                                echo $point->points;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                echo $point->created_at;
                                            ?>
                                        </td>
                                        <td class="<?php if($point->status_id == 2) { echo 'text-success'; } elseif($point->status_id == 3) { echo 'text-danger';} ?>">
                                            <?php 
                                                $status = R::findOne("statuses", "id = ?", array($point->status_id));
                                                if($status){
                                                    echo $status->status;
                                                }
                                            ?>
                                        </td>
                                        <td>
                                           <div class="text-wrap" style="width:200px">
                                            <?php echo $point->reason; ?>
                                            </div>
                                        </td>
                                        <td>
                                          <div class="row">
                                            <a data-fancybox="images-<?php $point->id; ?>" href="/uploads/<?php echo $point->proof; ?>">
                                                <img class="img-fluid mw-50px" src="/uploads/<?php echo $point->proof; ?>">
                                            </a>
                                          </div>
                                        </td>
                                    </tr>
                                <?php }
                            }
                            ?>                   
                        </tbody>
                    </table>
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
  
  <script src="/assets/libs/fancybox/jquery.fancybox.min.js"></script>

  <script src="/assets/libs/image-uploader/image-uploader.min.js"></script>

  <script src="/assets/scripts.js"></script>
</body>

</html>