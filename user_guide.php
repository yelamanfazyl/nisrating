<?php  
  require_once "./utils/bd.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
  <title>
    NIS Rating
  </title>

  <!-- Favicon -->
  <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">

  <link href="/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <!-- CSS Files -->
  <link href="/assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />

  <link rel="stylesheet" href="/assets/styles.css">
  <style>
      .status{
          font-weight: 1000;
      }
    .student_rating{
        text-decoration: none;
        color: #FFFFFF;
    }
    .student_rating:hover{
        text-decoration: none;
        color: #FFFFFF;
    }
    .font-p{
        font-size:18px;
    }
  </style>
</head>
<body>
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      
    </div>
    <div class="container-fluid mt--9">    
      <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow py-5 container-fluid">
            <div class="row text-center">
            <div class="col-4"></div>
            <div class="col-md-4 col-sm-10">
            <h1 class="text-center pb-5">Руководство пользователя</h1>
            </div>
            <div class="col-md-4 col-sm-2 text-center">
               <div class="btn-group text-center" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Рейтинги
                </button>
                <div class="dropdown-menu text-center" aria-labelledby="btnGroupDrop1">
                  <a class="student_rating dropdown-item" href="/students_rating.php">
                      <button class="btn btn-warning">Рейтинг учеников</button>
                  </a>
                  <a class="shanyrak_rating dropdown-item" href="/shanyrak_rating.php">
                      <button class="btn btn-warning">Рейтинг учеников <br> в шаныраке</button>
                  </a>
                  <a class="parallel_rating dropdown-item" href="/parallel_rating.php">
                      <button class="btn btn-warning">Рейтинг учеников <br> среди пареллелей</button>
                  </a>
                  
                  <a class="search dropdown-item" href="/search.php">
                      <button class="btn btn-warning">Поиск</button>
                  </a>
                </div>
              </div>
            </div>
            </div>
            <div class="col-12 mx-auto px-5 py-3 font-p">
                <h3>Выберите вопрос:</h3>
                <ul>
                <b>
                <li><div><a href="#">Как авторизоваться?</a></div></li>
                <li><div><a href="#">Как сообщать оценки?</a></div></li>
                <li><div><a href="#">Как принять / отклонить отчеты об оценках (только для супервайзеров)?</a></div></li>
                <li><div><a href="#">Как добавить руководителя / супервайзеров (только для супервайзеров)?</a></div></li>
                <li><div><a href="#">Как удалить руководителей / супервайзеров (только для супервайзеров)?</a></div></li>
                <li><div><a href="#">Как просмотреть историю действий (только для супервайзеров)?</a></div></li>
                <li><div><a href="#">Как просмотреть список запросов (только для супервайзеров)?</a></div></li>
                <li><div><a href="#">Как выйти из системы?</a></div></li>
                <li><div><a href="#">Как просмотреть рейтинг?</a></div></li>
                <li><div><a href="#">Как найти студента по имени?</a></div></li>
                </b>
                </ul>
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
              <a href="auth/login.php" class="nav-link text-dark">Войти</a>
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