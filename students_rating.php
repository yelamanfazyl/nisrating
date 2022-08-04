<?php  
  require_once "./utils/bd.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NIS Rating</title>
      <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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
  </style>
</head>
<body>    
   
  <div class="main-content"> 
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      
    </div>
     
      <div class="container-fluid mt--9">    
      <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow py-5 container-fluid">
            <div class="row text-center">
           <div class="col-4"></div>
            <div class="col-md-4 col-sm-12">
            <h1 class="text-center pb-5">Рейтинг учеников</h1>
            </div>
            <div class="col-md-4 col-sm-2 text-center">
               <div class="btn-group text-center" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Рейтинги
                </button>
                <div class="dropdown-menu text-center" aria-labelledby="btnGroupDrop1">
                  <a class="index dropdown-item" href="/index.php">
                      <button class="btn btn-warning">Рейтинг шаныраков</button>
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
                 <thead>
                    <tr>
                        <th>Имя и фамилия</th>
                        <th>Класс</th>
                        <th>Шанырак</th>
                        <th>Набранные Очки</th>
                    </tr>  
                 </thead>
                  <tbody class="list">                     
                    <?php
                      $students = R::findAll("students", "ORDER BY rating DESC");
                      $i=0;
                      if(isset($students)){
                        foreach($students as $key=>$student){
                      ?>
                          <tr>
                            <th scope="row" class="name">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm"><?php echo $student->first_name . " " . $student->last_name; ?></span>
                                    </div>
                                </div>
                            </th>
                            <td class="grades text-uppercase">
                                <?php 
                                  $grade = R::findOne("grades","id = ?", array($student->grade));
                                  if($grade){
                                      echo $grade->grade . " " . $grade->letter;
                                  }
                                ?>
                            </td>
                            <td class="grades text-uppercase">
                                <?php 
                                  $grade = R::findOne("grades","id = ?", array($student->grade));
                                  if($grade){
                                      $shanyrak = R::findOne("shanyraks","id = ?",array($grade->shanyrak));
                                      echo $shanyrak->shanyrak;
                                  }
                                ?>
                            </td>
                            <td class="status">
                              <?php 
                                echo $student->rating;
                              ?>
                            </td>
                        </tr>
                        <?php
                            $i++;
                            if($i==20){
                                break;
                            }
                        }
                        }
                    ?>                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
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