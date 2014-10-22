<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DietCake <?php outputText($title) ?></title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px;
      }
    </style>
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="<?php outputText(url('thread/index'))?>">Home Screen</a>
          <a class="brand" href="<?php outputText(url('thread/create'))?>">Create Thread</a>
          <a class="brand" href="<?php outputText(url('user/add'))?>">Add User</a>
        </div>
      </div>
    </div>

    <div class="container">

      <?php echo $_content_ ?>

    </div>

    <script>
    console.log(<?php outputText(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
    </script>

  </body>
</html>
