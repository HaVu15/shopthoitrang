<?php
 include '../classes/catadd.php';
?>
<?php
 include '../lib/session.php';
 session::checkSession();
?>
<?php
  
 $class = new category();
 if($_SERVER['REQUEST_METHOD'] === 'POST')
 {
   $catName =  $_POST['catName'];
   

   $insertCat = $class->insert_category($catName) ;
 }
?>
<?php
  $cat = new category();
  if(!isset($_GET['delid']) || $_GET['delid']==NULL)
  {
   
  }
  else{
    $id = $_GET['delid'];
    $delCat = $cat->del_category($id) ;

  }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Trang Quản Lý</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Trang Quản Lý</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav" >
    <div class="nav-item text-nowrap">
       <a class="nav-link px-3" style="color:white">Admin : <?php
       echo session::get('adminName');
       ?></a>
      
    </div>
  </div>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
    <?php
                    if(isset($_GET['action']) && $_GET['action']=='logout'){
                      session::destroy();
                    }
                  ?>
      <a class="nav-link px-3" href="?action=logout">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Đơn hàng
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productadd.php">
              <span data-feather="shopping-cart"></span>
              Sản phẩm
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Người dùng
            </a>
            
          </li>
          <li class="nav-itemcategory">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Danh mục sản phẩm
            </a>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
      <h2>DANH MỤC SẢN PHẨM</h2>
      <h5>Thêm danh mục</h5>
      <?php
        if(isset($insertCat)){
            echo $insertCat;
        }

      ?>
      
      <form action="category.php" method="post">
      <TABLE class=""form>
         <tr>
             <td>
                 <input type="text" name ="catName"placeholder="Thêm danh mục sản phẩm" class="medium">
             </td>
         </tr>
         <tr>
             <td>
                 <input type="submit" name="submit" value="Save">
             </td>
         </tr>
      </TABLE>
      </form>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Serial No.</th>
              <th scope="col">Category Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
               $show_cate = $cat->show_category();
               if($show_cate)
               {
                 $i=0;
                 while($result = $show_cate->fetch_assoc()){
                     $i++;
                 
               
            ?>
            <tr>
              <td><?php echo $i;  ?></td>
              <td><?php echo $result['catName'];  ?></td>
              <td><a href="categoryedit.php?catId=<?php echo $result['catId'] ?>">Exit</a> || <a onclick="return confirm('Bạn có chắc chắn xóa')"href="?delid=<?php echo $result['catId'] ?>">Delete</a></td>
            </tr>
            <?php
          }
        }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
    
  </body>

</html>
