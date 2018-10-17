<?php 
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
error_reporting(E_ALL ^ E_NOTICE);

$page = new \Controllers\IndexController();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Giorgos Patelis | Currency Calculator</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body>
  <!-- Topbar Section -->
  <section id="top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <h1 class="navbar-brand">Currency Calculator</h1>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" id="currency-converter" href="#">Converter</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="add-currency" href="#">Add New Currency</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="edit-currency" href="#">Edit Currencies</a>
          </li>
        </ul>
      </div>
    </nav>
  </section>
  <!-- /Topbar Section -->
  <!-- Main Section -->
  <section id="maincontent">
    <div class="container">
      <div id="main">
        <div class="row">
        
          <?= $page->getIndex(); ?>
        </div>
      </div>
    </div>
  </section>
  <!-- /Main Section -->
  <!-- Footer -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/script.js"></script>
</body>
</html>