<meta charset="UTF-8">
<title>Sidd & Associates, LLC</title><!--Personal Portfolio Website-->

    <!----TO REMOVE TAB ICON----->
<link rel="icon" href="data:,">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----CSS link----->
<link rel="stylesheet" href="style.css?v=1.1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div id="header">
    <div class="logo">
        <a href="#">Sidd & Associates, LLC</a>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="current-jobs.php">Current Jobs</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>$("#header").prepend(
    '<div id="dash"><i id ="list" class="fa fa-bars"></i><i id ="x" class="fa-solid fa-xmark"></i></div>'
  );
  
  $("#dash").on("click", function () {
    $("nav").slideToggle();
    $(this).toggleClass("active");
  });</script>
