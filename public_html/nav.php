<?php session_start();?>
<?php require_once 'functions.php' ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css?v=1.1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.1/font/bootstrap-icons.min.css" integrity="sha512-WYaDo1TDjuW+MPatvDarHSfuhFAflHxD87U9RoB4/CSFh24/jzUHfirvuvwGmJq0U7S9ohBXy4Tfmk2UKkp2gA==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
-->
<div id="header">
    <nav>
        <ul>
            <?php if (is_logged_in() && has_status("TEACHER")) : ?>
                <li><a href="teacher.php">Home</a></li>
                <li><a href="create.php">Create Question</a></li>
                <li><a href="make_exam.php">Make Exam</a></li>
                <li><a href="teacher_grading.php">Grading</a></li>
            <?php endif; ?>
            <?php if (is_logged_in() && has_status("STUDENT")) : ?>
                <li><a href="student.php">Home</a></li>
                <li><a href="exam_page.php">Take Exam</a></li>
                <li><a href="student_grading.php">Grading</a></li>
            <?php endif; ?>
            <?php if (is_logged_in()) : ?>
                <li><a href="logout.php">logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>