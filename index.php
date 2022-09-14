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
    .hide {
      display: none;
    }
          
    .MyDiv:hover + .hide {
      display: block;
      transition: 5s
    }
    .help{
      font-size: 10px;
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
            <h1 class="text-center pb-5">Рейтинг шаныраков</h1>
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
            <div class="col-12 mx-auto px-5 py-3">
              <div class="table-responsive">
                <table class="table align-items-center">
                  <tbody class="list">
                    <tr>
                        <th>Название шанырака</th>
                        <th>Классы</th>
                        <th>Набранные Очки</th>
                    </tr>                       
                    <?php
                      $shanyraks = R::findAll("shanyraks", "ORDER BY rating DESC");
                      if(isset($shanyraks)){
                        foreach($shanyraks as $shanyrak){ ?>
                          <tr>
                            <th scope="row" class="name shanyrak">
                                <div class="media align-items-center">
                                    <a href="#" class=" mr-3">
                                      <img alt="Image placeholder" class="img-fluid mw-50px" src="/assets/img/shanyraks/<?php echo $shanyrak->img.".jpg"; ?>">
                                    </a>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm"><?php echo $shanyrak->shanyrak; ?></span>
                                        <div class="hide">Нажмите, что бы перейти к баллам учеников в шаныраке</div>
                                    </div>
                                </div>
                            </th>
                            <td class="grades text-uppercase">
                                <?php 
                                  $grades = R::find("grades", "shanyrak = ?", array($shanyrak->id));
                                  if($grades){
                                    foreach($grades as $grade){
                                      echo $grade->grade.$grade->letter;
                                      echo "<br>";
                                    }
                                  }
                                ?>
                            </td>
                            <td class="status">
                              <?php 
                                echo $shanyrak->rating;
                              ?>
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
          <div class="col-xl-12">
            <div class="copyright text-center text-xl-center text-dark">
                &copy; <?php echo date('Y'); ?>
                <a href="auth/login.php" class="nav-link text-dark">Войти</a>
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