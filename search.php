<?php  
  require_once "./utils/bd.php";

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $data = $_POST;
      if(isset($data['do_search'])){
          $errors = array();
          if(empty($data['name'])){
              $errors[] = "Пустое поле";
          }
          if(empty($errors)){
              $success = "success";
          }
      }
      if(isset($data['show_points'])){
          $success_show = true;
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
    NIS Rating
  </title>

  <!-- Favicon -->
  <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">

  <link href="/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
  <link rel="stylesheet" href="/assets/libs/fancybox/jquery.fancybox.min.css">

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
            <h1 class="text-center pb-5">Поиск учеников</h1>
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
                  <a class="student_rating dropdown-item" href="/students_rating.php">
                      <button class="btn btn-warning">Рейтинг учеников</button>
                  </a>
                  <a class="shanyrak_rating dropdown-item" href="/shanyrak_rating.php">
                      <button class="btn btn-warning">Рейтинг учеников <br> в шаныраке</button>
                  </a>
                  <a class="parallel_rating dropdown-item" href="/parallel_rating.php">
                      <button class="btn btn-warning">Рейтинг учеников <br> среди пареллелей</button>
                  </a>
                </div>
              </div>
            </div>
            </div>
            <div class="col-12 mx-auto px-5 py-1 text-center">
              <div class="col-12 mx-auto px-2 py-1 select_classes">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="select_class">
                      <input type="text" name="name"><br><br>
                      <button class="btn btn-sm btn-info" type="submit" name="do_search">Искать</button>
                  </form>
              </div>
              <?php 
                if($success == "success"){  
              ?>
              <div class="col-12 mx-auto px-5 py-3">
              <div class="table-responsive">
                <table class="table align-items-center">
                  <tbody class="list">
                    <tr>
                        <th>Фамилия и имя</th>
                        <th>Класс</th>
                        <th>Шанырак</th>
                        <th>Набранные Очки</th>
                    </tr>                       
                    <?php 
                        $students = R::find("students","first_name LIKE ? OR last_name LIKE ?",array($data['name'] . "%", $data['name'] . "%"));
                        foreach($students as $student){ ?>
                            <tr>
                                <th>
                                    <div class="text-center">
                                        <?php echo $student->last_name . " " . $student->first_name; ?>
                                    </div>
                                </th>
                                <td class="text-uppercase">
                                    <div class="text-center">
                                        <?php 
                                            $grade = R::findOne("grades","id = ?",array($student->grade));
                                            echo $grade->grade . $grade->letter;
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <?php 
                                            $shanyrak = R::findOne("shanyraks","id = ?",array($student->shanyrak));
                                            echo $shanyrak->shanyrak;
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <?php 
                                            echo $student->rating;
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                        <div class="row mx-auto justify-content-end">
                                            <input type="hidden" name="student_id" value="<?php echo $student->id; ?>">
                                            <button type="submit" name="show_points" class="btn btn-sm btn-info">Просмотреть</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                     <?php
                        }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <?php 
            }
            ?>
            <?php if($success_show){ ?>
                   <div class="col-12 mx-auto py-5 mt-3">
              <div class="table-responsive col-md-12">
                <table class="table align-items-center table-flush">
                  <tbody>
                    <?php 
                    $points = R::find("points","status_id = 2 AND added_to = ?",array($data['student_id']));
                      if(isset($points)){
                                foreach($points as $point){ ?>
                                    <tr>
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
            <?php
                }
            ?>
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
  
  <script src="/assets/libs/fancybox/jquery.fancybox.min.js"></script>
</body>

</html>