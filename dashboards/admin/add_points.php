<?php 
  require_once(dirname(__DIR__).'/../utils/sessions.php');

  if(!$_SESSION['is_admin']){
    header("Location: /dashboards/leader/leader.php");
  }

  require_once dirname(__DIR__).'/../utils/bd.php';
?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calculate'])) {
        $count = count($_FILES['images']['name']); 
        if($count < 1) {
            $errors[] = 'Вы не загрузили доказательства';
        }

        if (count($_FILES['images']['name']) > 0) {
            $filename = '';

            for($i=0; $i < $count; $i++){
                if(!empty($_FILES['images']['name'][$i])){            
                    $_FILES['image']['name'] = $_FILES['images']['name'][$i];
                    $_FILES['image']['type'] = $_FILES['images']['type'][$i];
                    $_FILES['image']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                    $_FILES['image']['error'] = $_FILES['images']['error'][$i];
                    $_FILES['image']['size'] = $_FILES['images']['size'][$i];
            
                    $target_dir = "../../uploads/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $filename = basename(md5(uniqid(rand(), true)) . '.' . $imageFileType);
                    $dest_file = $target_dir . $filename;
                    
                    // Check if image file is a actual image or fake image
                    if(isset($_POST["calculate"])) {
                        $check = getimagesize($_FILES["image"]["tmp_name"]);
    
                        if($check !== false) {
                            $uploadOk = 1;
                        } else {
                            $errors[] =  "Это не изображение";
                            $uploadOk = 0;
                        }
                    }
    
                    // Check file size
                    if ($_FILES["image"]["size"] > 1024 * 1024 * 10) {
                        $errors[] =  "Файл слишком большой";
                        $uploadOk = 0;
                    }
    
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                        $errors[] =  "Доспускается только JPG, JPEG, PNG & GIF.";
                        $uploadOk = 0;
                    }
    
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $errors[] = "Файл не был загружен";
                        // if everything is ok, try to upload file
                    } else {
                        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $dest_file)) {
                            $errors[] = "Sorry, there was an error uploading your file.";
                        }
                    }
                }    
            }
 
            $total_points = 1;
            
            $coef_1 = R::findOne("categories", "id = ?", array($_POST['category_id']));
            $coef_1 = (float)$coef_1->coefficient;

            $coef_2 = R::findOne("places", "id = ?", array($_POST['place_id']));
            $coef_2 = (float)$coef_2->coefficient;

            $coef_3 = R::findOne("types", "id = ?", array($_POST['type_id']));
            $coef_3 = (float)$coef_3->coefficient;

            $coef_4 = (int)$_POST['participants_amount'];

            $total_points = (float)((10 * $coef_1 * $coef_2 * $coef_3) / $coef_4);

            try {
                $new_points = R::dispense("points");
                $new_points->category = $_POST['category_id'];
                $new_points->place = $_POST['place_id'];
                $new_points->type = $_POST['type_id'];
                $new_points->part_amount = $_POST['participants_amount'];
                $new_points->points = $total_points;
                $new_points->author = $_SESSION['user_id'];
                $new_points->added_to = $_POST['student_id'];
                $new_points->proof = $filename;
                R::store($new_points);

                $new_action = R::dispense("history");
                $new_action->action = 1;
                $new_action->acted_to = $_POST['student_id'];
                $new_action->author = $_SESSION['user_id'];
                R::store($new_action); 
                
                $success[] = $total_points." балл";
            } catch (\Throwable $th) {
                throw $th;
                die();                
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
    Добавить баллы | Президент
  </title>

  <!-- Favicon -->
  <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">

  <link href="/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- CSS Files -->
  <link href="/assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />

  <link rel="stylesheet" href="/assets/libs/fancybox/jquery.fancybox.min.css">
  
  <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="/assets/libs/image-uploader/image-uploader.min.css">

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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="admin.php">Добавить баллы </a>
        
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
            <h1 class="text-center">Добавить баллы</h1>
            <div class="col-10 mx-auto py-5 mt-3">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="form-main" enctype="multipart/form-data">
                    <?php 
                        $shanyraks = R::findAll("shanyraks"); 
                        
                        if($shanyraks != null){ ?>
                            <div class="form-group" >
                                <label>Шанырак</label>
                                <select name="shanyrak_id" class="form-control" id="select-shanyrak" required>
                                    <option value="">Выберите</option>
                                    <?php 
                                        if(isset($shanyraks)){
                                            foreach($shanyraks as $shanyrak){ ?>
                                                <option <?php if($shanyrak->id == $_POST['shanyrak_id']){ echo 'selected'; } ?> value="<?php echo $shanyrak->id; ?>"><?php echo $shanyrak->shanyrak; ?></option>
                                            <?php }
                                        }
                                    ?>
                                </select>
                            </div>
                        <?php } 
                    ?>  
                    <?php 
                        $grades = R::find("grades", "shanyrak = ?", array($_POST['shanyrak_id'])); 
                        
                        if($grades != null){ 
                        ?>
                            <div class="form-group" >
                                <label>Класс</label>
                                <select name="grade_id" class="form-control" id="select-grade" required>
                                    <option value="">Выберите</option>
                                    <?php 
                                        if(isset($grades)){
                                            foreach($grades as $grade){ ?>
                                                <option <?php if($grade['id'] == $_POST['grade_id']){ echo 'selected'; } ?> value="<?php echo $grade['id'] ?>"><?php echo $grade['grade']." ".$grade['letter']; ?></option>
                                            <?php }
                                        }
                                    ?>
                                </select>
                            </div>
                        <?php } 
                    ?>
                    <?php 
                        if(isset($_POST['grade_id']) && $_POST['grade_id'] != ''){ 
                        ?>
                            <div class="form-group">
                                <label>Ученик</label>
                                <select name="student_id" class="form-control" id="select-student" required>
                                    <option value="">Выберите</option>
                                    <?php 
                                    $students = R::find("students", "grade = ?", array($_POST['grade_id']));
                                    if(isset($students)){
                                        foreach($students as $student){ ?>
                                            <option <?php if($student['id'] == $_POST['student_id']){ echo 'selected'; } ?> value="<?php echo $student['id'] ?>"><?php echo $student['first_name']." ".$student['last_name']; ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php } 
                    ?>
                    <?php 
                        if(isset($_POST['student_id']) && $_POST['student_id'] != ''){ 
                        ?>
                            <div class="form-group">
                                <label>Категория</label>
                                <select name="category_id" class="form-control" id="select-category" required>
                                    <option value="">Выберите</option>
                                    <?php 
                                    $categories = R::findAll("categories");
                                    if(isset($categories)){
                                        foreach($categories as $category){ ?>
                                            <option <?php if($category['id'] == $_POST['category_id']){ echo 'selected'; } ?> value="<?php echo $category['id'] ?>"><?php echo $category['category']; ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php } 
                    ?>
                    <?php 
                        if(isset($_POST['category_id']) && $_POST['category_id'] != ''){ 
                        ?>
                            <div class="form-group">
                                <label>Место</label>
                                <select name="place_id" class="form-control" id="select-place" required>
                                    <option value="">Выберите</option>
                                    <?php 
                                    $places = R::findAll("places");
                                    if(isset($places)){
                                        foreach($places as $place){ ?>
                                            <option <?php if($place['id'] == $_POST['place_id']){ echo 'selected'; } ?> value="<?php echo $place['id'] ?>"><?php echo $place['place']; ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php } 
                    ?>
                    <?php 
                        if(isset($_POST['place_id']) && $_POST['place_id'] != ''){ 
                        ?>
                            <div class="form-group">
                                <label>Тип</label>
                                <select name="type_id" class="form-control" id="select-type" required>
                                    <option value="">Выберите</option>
                                    <?php 
                                    $types = R::findAll("types");
                                    if(isset($types)){
                                        foreach($types as $type){ ?>
                                            <option <?php if($type['id'] == $_POST['type_id']){ echo 'selected'; } ?> value="<?php echo $type['id'] ?>"><?php echo $type['type']; ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php } 
                    ?>
                    <?php 
                        if(isset($_POST['type_id']) && $_POST['type_id'] != ''){ 
                        ?>
                            <div class="form-group">
                                <label>Количество участников</label>
                                <div class="form-group">
                                    <input name="participants_amount" type="number" class="form-control" min="1" required>
                                </div>
                            </div>
                        <?php } 
                    ?>
                    
                    <div class="form-group" style="display: none;">
                        <div class="gallery-create-images"></div>
                    </div>

                    <button class="btn btn-lg btn-block btn-success w-50 mx-auto" type="submit" name="calculate">Отправить</button>
                </form>
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