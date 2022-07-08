<?php require_once 'nav.php' ?>
<?php  is_logged_in(true);?>
<?php
    $data = array(
        'dQuestion' => "dQuestion",
    );

    $page=$_GET['page'];

    if (!isset($total_pages)) { 
        $total_pages = 1;
    }
    if (!isset($page)) {
        $page = 1;
    }

    if(isset($_POST['submit'])){
        $answer = rawurlencode($_POST['answer']);
        $id = $_POST['hidden'];
        $page = ($_POST['page']);
        $total_pages = ($_POST['total-page']);

        //if($_POST['submit']== 'Next'){
        /*  if ($total_pages!=$page)
            {
                $page=$page + 1;
            }
        */   
        //}
        // create array to save*
        $data = array(
            'question_id' => $id,
            'answer' => $answer,
        );
        /*}
        else{
            echo "<h4 style=color:red;><center>Answer slot is empty, Please enter something</center></h4>";
        }*/
    }
    
    $url = "https://afsaccess4.njit.edu/~mm2623/canvas/middle.php";

    // curl*
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);

    $recieved_array = array();
    $recieved_array = json_decode($result,true);
    //print_r($recieved_array);
    //var_dump(count($recieved_array)); 
    $total_pages = count($recieved_array);
?>
<head>
    <meta charset="UTF-8">
    <title>Take Exam</title>
</head>
<br>
<?php if($page <= $total_pages): ?>
    <div class="row">
        <div class="col" style= "margin-left: 20;">
            <h1><center><b>Exam</b></center></h1>
            <br>
            <table>
                <thead>
                    <tr>
                        <th style = background-color:#d6d6d6;><center>Questions</center></th>
                        <th style = background-color:#d6d6d6;><center>Score</center></th>
                        <th style = background-color:#d6d6d6;><center>Answers</center></th>
                        <th style = background-color:#d6d6d6;>Confirm</th>
                    </tr>
                    <?php $each_array=$recieved_array[$page-1]; ?>
                    <tr>
                        <form action method = "post">
                            <td>
                                <input type="hidden"  name="hidden" value="<?php echo $each_array['question_id']; ?>">
                                <?php echo $each_array['question']; ?>
                            </td>
                            <td>
                                <?php echo $each_array['score']; ?>
                            </td>
                            <td>
                                <textarea rows="4" cols="80" name="answer" placeholder="<?php echo $each_array['answer']; ?>"></textarea><br>
                            </td>
                            <td>
                            <input type="hidden" value="<?php echo ($page + 1); ?>" name="page">
                            <input type="hidden" value="<?php echo count($recieved_array); ?>" name="total-page">
                            <?php if($page != $total_pages): ?>
                                <input class="submit" type="submit" name="submit">
                            <?php endif; ?> 
                            <?php if($page == $total_pages): ?>
                                <input class="submit" type="submit" value = "End" name="submit">
                            <?php endif; ?> 
                            
                            </td>
                    </tr>
                        </form>
                </thead>
            </table>
        </div>
    </div>
    <?php ?>

    <!--Pagination-->
    <div class="pagination-box" > 
        <ul class="pagination">
            <li class="page-item <?php echo ($page - 1) < 1 ? "disabled" : ""; ?>">
                <a class="page-link" href="?<?php echo "page=".($page - 1).""; ?>" tabindex="-1">Previous</a>
            </li>
            <?php for ($i = 0; $i < $total_pages; $i++) : ?>
                <li class="page-item <?php echo ($page - 1) == $i ? "active" : ""; ?>"><a class="page-link" href="?<?php echo"page=".($i + 1); ?>"><?php echo ($i + 1); ?></a></li>
            <?php endfor; ?>
            <li class="page-item <?php echo ($page) >= $total_pages ? "disabled" : ""; ?>">
                <a class="page-link" href="?<?php echo "page=".($page + 1); ?>">Next</a>
            </li>
        </ul>
    </div>
<?php endif; ?>
<!--Submit page-->
<?php if($page > $total_pages): ?>
    <h1 style=color:red;><center><b>Exam Submited</b></center></h1>
<?php endif; ?>
  
<?php require_once 'flash.php' ?>