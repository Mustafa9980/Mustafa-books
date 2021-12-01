<?php
session_start();

# If the admin is logged in
if (
  isset($_SESSION['user_id']) &&
  isset($_SESSION['user_email'])
) {
  include "db_conn.php";

  include "http/Viewbooks.php";
  include "http/view_author.php";
  include "http/view_category.php";


  $books = get_books($conn);
  $authors = get_authors($conn);

  $categorys = get_categorys($conn);

?>


  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- bootstrap foe CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- bootstrap for js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="icon" href="">
  </head>

  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="admin.php">Admin</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.php">Store</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Add-book.php">Add books</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Add-Category.php">Add Category</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Add-Author.php">Add Author</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">logout</a>
              </li>
          </div>
        </div>
      </nav>
      <form
      style="width:100%  ;   max-width:30rem" action="search.php"
      method="GET"
      
      >

      <div class="input-group my-5">
      <input type="text" class="form-control"
       placeholder="Search Book..."
       name="key" 
       aria-label="Search Book..." 
       aria-describedby="basic-addon2">
       <button class="input-group-text
        btn btn-primary" 
       id="basic-addon2">
      <img src="img/search.png"
      width="20" >
      </button>
      </div>
      </form>

      <div class="mt-5"></div>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>


        <?php  if ($books == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no book in the database
		  </div>
        <?php }else {?>
        <h4 class="mt-5"> All Books</h4>
        <table class="table table-bordered shadow">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Author</th>
              <th>Description</th>
              <th>Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 0;
            foreach ($books as $book) {
              $count++;


            ?>


              <tr>
                <td><?= $count ?></td>
                <td>
                  <img width="100" src="uploads/cover/<?= $book['cover'] ?>">
                  <a class="link-dark d-block text-center" href="uploads/files/<?= $book['file'] ?>">
                    <?= $book['title'] ?>
                </td>

                </a>
                <td>

                  <?php if ($authors == 0) {
                    echo "Undfind";
                  } else {
                    foreach ($authors as $author) {
                      if ($author['id'] == $book['author_id']) {
                        echo $author['name'];
                      }
                    }
                  }

                  ?>
                </td>
                <td><?= $book['description'] ?></td>
                <td>
                  <?php if ($categorys == 0) {
                    echo "Undfind";
                  } else {
                    foreach ($categorys as $category) {
                      if ($category['id'] == $book['category_id']) {
                        echo $category['name'];
                      }
                    }
                  }

                  ?>



                </td>
                <td><a href="Edit-book.php?id=<?=$book['id']?>" 
                 class="btn btn-warning ">Edit</a>
                  <a href="http/delete-book.php?id=<?=$book['id']?>" class="btn btn-danger ">Delete</a>

                </td>


              </tr>
            <?php } ?>
          </tbody>

        </table>
      <?php } ?>
      <?php
      if ($categorys == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no categorys in the database
		  </div>

      <?php } else { ?>
        <h4 class="mt-5"> All category</h4>
        <table class="table table-bordered shadow">
          <thead>
            <tr>
              <th>#</th>
              <th>Categorys Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <tr>

              <?php
              $count = 0;
              foreach ($categorys as $category) {
                $count++;
              ?>
                <td><?= $count ?></td>
                <td><?= $category['name'] ?></td>
                <td><a href="Edit-category.php?id=<?=$category['id']?>"
                 class="btn btn-warning ">Edit</a>
                  <a href="http/delete-category.php?id=<?=$category['id']?>"  class="btn btn-danger ">Delete</a>

                </td>


            </tr>
          <?php } ?>
          </tbody>



        </table>
      <?php } ?>
      <?php
      if ($authors == 0) { ?>
        <div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no authors in the database
		  </div>

      <?php } else { ?>
        <h4 class="mt-5"> All authors</h4>
        <table class="table table-bordered shadow">
          <thead>
            <tr>
              <th>#</th>
              <th>Author Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <tr>

              <?php
              $count = 0;
              foreach ($authors as $author) {
                $count++;
              ?>
                <td><?= $count ?></td>
                <td><?= $author['name'] ?></td>
                <td><a href="Edit-author.php?id=<?=$author['id']?>" 
                class="btn btn-warning ">Edit</a>
                  <a href="http/delete-author.php?id=<?=$author['id']?>" class="btn btn-danger ">Delete</a>

                </td>


            </tr>
          <?php } ?>
          </tbody>



        </table>
      <?php } ?>

    </div>

  </body>

  </html>
<?php } else {
  header("Location: login.php");
  exit;
} ?>