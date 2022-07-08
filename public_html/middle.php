<?php
$set = "FALSE";
$backurl = 'https://afsaccess4.njit.edu/~mm2623/canvas/backend.php';

$username = $_POST['username'];
$password = $_POST['password'];

$display_question =$_POST['display_question'];
$topic = $_POST['topic'];
$difficulty = $_POST['difficulty'];
$constraints = $_POST['constraints'];
$question = $_POST['question'];
$testcase1 = $_POST['testcase1'];
$output_testcase1 = $_POST['output_testcase1'];
$testcase2 = $_POST['testcase2'];
$output_testcase2 = $_POST['output_testcase2'];
$testcase3 = $_POST['testcase3'];
$output_testcase3 = $_POST['output_testcase3'];
$testcase4 = $_POST['testcase4'];
$output_testcase4 = $_POST['output_testcase4'];
$testcase5 = $_POST['testcase5'];
$output_testcase5 = $_POST['output_testcase5'];

$exam_display_question =$_POST['exam_display_question'];
$exam_display_exam1 =$_POST['exam_display_exam'];
$score1 =$_POST['score'];
$id1 =$_POST['id'];

$dQuestion =$_POST['dQuestion'];
$questionID =$_POST['question_id']; ///change
$answer =$_POST['answer'];

$topic =$_POST['topic'];
$key_word =$_POST['key_word']; 
$difficulty =$_POST['difficulty'];
$sort =$_POST['sort'];

$autograding =$_POST['autograding'];
if($autograding == 'autograding'){
        $set= "TRUE";
}

$quest = $_POST['quest'];

$post = "user_name=$username&passwd=$password".
        "&display_question=$display_question&topic=$topic&difficulty=$difficulty&constraints=$constraints&question=$question&testcase1=$testcase1&output_testcase1=$output_testcase1&testcase2=$testcase2&output_testcase2=$output_testcase2&testcase3=$testcase3&output_testcase3=$output_testcase3&testcase4=$testcase4&output_testcase4=$output_testcase4&testcase5=$testcase5&output_testcase5=$output_testcase5".
        "&exam_display_question=$exam_display_question&exam_display_exam=$exam_display_exam1&score=$score1&id=$id1".
        "&dQuestion=$dQuestion&question_id=$questionID&answer=$answer".
        "&autograding=$autograding"."&quest=$quest"."&topic=$topic&key_word=$key_word&difficulty=$difficulty&sort=$sort";
        
if($_POST['submit'] == 'Submit'){
        $post=$_POST;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $backurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result = curl_exec($ch);
curl_close($ch);


$recieved_array = array();
$recieved_array = json_decode($result,true);
$send_to_front = $recieved_array;

if($set == 'TRUE'){
        foreach ($recieved_array as $array_index =>$each_array) {
                $question_backend= $each_array["question"];
                $question_id_backend= $each_array["question_id"];
                $score_backend =  $each_array["score"];
                $answer_backend= $each_array["answer"];
                $constraints_backend = $each_array["constraints"];

                $testcase1_backend = $each_array["testcase1"];
                $ans_testcase1_backend = $each_array["output_testcase1"];
                $testcase2_backend = $each_array["testcase2"];
                $ans_testcase2_backend = $each_array["output_testcase2"];
                $testcase3_backend = $each_array["testcase3"];
                $ans_testcase3_backend = $each_array["output_testcase3"];
                $testcase4_backend = $each_array["testcase4"];
                $ans_testcase4_backend = $each_array["output_testcase4"];
                $testcase5_backend = $each_array["testcase5"];
                $ans_testcase5_backend = $each_array["output_testcase5"];

                //echo json_encode($constraints_backend);
                if($testcase5_backend != '' && $constraints_backend != "None"){
                        $each_score = $score_backend/7;
                }
                elseif($testcase4_backend != '' && $constraints_backend != "None")
                {
                        $each_score = $score_backend/6;
                }
                elseif($testcase3_backend != '' && $constraints_backend != "None")
                {
                        $each_score = $score_backend/5;
                }
                elseif($testcase2_backend != '' && $constraints_backend != "None")
                {
                        $each_score = $score_backend/4;
                }
                elseif($testcase5_backend != ''){
                        $each_score = $score_backend/6;
                }
                elseif($testcase4_backend != '')
                {
                        $each_score = $score_backend/5;
                }
                elseif($testcase3_backend != '')
                {
                        $each_score = $score_backend/4;
                }
               elseif($testcase2_backend != '')
                {
                        $each_score = $score_backend/3;
                }
                $constraint ='';
                $detail='';
                $check = "FALSE";
                $score_name =0.0;
                $score_constraints = 0;
                $score_testcase1 = 0;
                $score_testcase2 = 0;
                $score_testcase3 = 0;
                $score_testcase4 = 0;
                $score_testcase5 = 0;

                $question_array = str_word_count($question_backend,1);
                $answer_array = str_word_count($answer_backend,1);
                
                $x = 0; 
                foreach ($question_array as $each_word):
                        $x = $x+1;
                        if ($each_word == "function"){
                        $function_name= $question_array[$x]; 
                        }
                endforeach;

                $x = 0; 
                foreach ($answer_array as $each_word):
                        $x = $x+1;
                        if ($each_word == "def"){
                        $ans_function_name= $answer_array[$x]; 
                        }
                endforeach;

                //checking for function name
                if ($ans_function_name == $function_name ) {
                        $detail = $detail."Name => Matches => ".$ans_function_name."<br>"."<br>";
                        $score_name=$each_score;
                } elseif ($ans_function_name != $function_name ) {
                        $detail= $detail."Name =>Not Matches => ".$ans_function_name."<br>"."<br>";
                        $answer_backend = str_replace($ans_function_name,$function_name,$answer_backend);
                        $score_name = 0 ;
                }
                
                if ($constraints_backend != "None"){
                        if(strpos($answer_backend, $constraints_backend) !== false){
                                $constraint = $constraints_backend ." loop Found";
                                $score_constraints = $each_score;
                        } else{
                                $constraint = $constraints_backend ." loop Not Found";
                                $score_constraints = 0;
                        }
                }
                //echo json_encode($constraint);

                if ($check != "TRUE"){
                        //erasing the page
                        file_put_contents('test.py',"");

                        // testing testcase1
                        $file_handle=fopen('test.py','w');
                        fwrite($file_handle,$answer_backend);
                        fwrite($file_handle,"\n");
                        fwrite($file_handle,"\n");
                        fwrite($file_handle,$testcase1_backend);
                        fclose($file_handle);

                        $output1 = exec("python /afs/cad.njit.edu/u/m/m/mm2623/public_html/canvas/test.py") or die('Cannot compile testcase1');
                        
                        if($output1 == $ans_testcase1_backend){
                        $detail = $detail."Testcase1 =>".$testcase1_backend." =>  Answer => ".$output1."<br>";
                        $detail = $detail."Correct Answer => ".$ans_testcase1_backend."<br>"."<br>";
                        $score_testcase1 = $each_score; 
                        }
                        elseif($output1 != $ans_testcase1_backend){
                        $detail = $detail."Testcase1 =>".$testcase1_backend." =>  Answer =>  ".$output1."<br>";
                        $detail = $detail."Correct Answer => ".$ans_testcase1_backend."<br>"."<br>";
                        $score_testcase1 = 0; 
                        }

                        //erasing the page
                        file_put_contents('test.py',"");

                        //testing testcase2
                        $file_handle=fopen('test.py','w');
                        fwrite($file_handle,$answer_backend);
                        fwrite($file_handle,"\n");
                        fwrite($file_handle,"\n");
                        fwrite($file_handle,$testcase2_backend);
                        fclose($file_handle);

                        $output2 = exec('python /afs/cad.njit.edu/u/m/m/mm2623/public_html/canvas/test.py 2>&1') or die('Cannot compile testcase2');;
                        //echo $output2;

                        if($output2 == $ans_testcase2_backend){
                        $detail = $detail."Testcase2 => ".$testcase2_backend." =>  Answer => ".$output2."<br>";
                        $detail = $detail."Correct Answer => ".$ans_testcase2_backend."<br>";
                        $score_testcase2 = $each_score; 
                        }
                        elseif($output2 != $ans_testcase2_backend){
                        $detail = $detail."Testcase2 => ".$testcase2_backend." =>  Answer => ".$output2."<br>";
                        $detail = $detail."Correct Answer => ".$ans_testcase2_backend."<br>";
                        $score_testcase2 = 0; 
                        }
                        if($testcase3_backend!= ''){
                                 //erasing the page
                                file_put_contents('test.py',"");

                                //testing testcase3
                                $file_handle=fopen('test.py','w');
                                fwrite($file_handle,$answer_backend);
                                fwrite($file_handle,"\n");
                                fwrite($file_handle,"\n");
                                fwrite($file_handle,$testcase3_backend);
                                fclose($file_handle);

                                $output3 = exec('python /afs/cad.njit.edu/u/m/m/mm2623/public_html/canvas/test.py') or die('Cannot compile testcase3');;

                                if($output3 == $ans_testcase3_backend){
                                $detail = $detail."<br>"."Testcase3 => ".$testcase3_backend." => ".$output3."<br>";
                                $detail = $detail."Correct Answer => ".$ans_testcase3_backend."<br>";
                                $score_testcase3 = $each_score; 
                                }
                                elseif($output3 != $ans_testcase3_backend){
                                $detail = $detail."<br>"."Testcase3 => ".$testcase3_backend." => ".$output3."<br>";
                                $detail = $detail."Correct Answer => ".$ans_testcase3_backend."<br>";
                                $score_testcase3 = 0; 
                                }
                        }
                        if($testcase4_backend != ''){
                                //erasing the page
                               file_put_contents('test.py',"");

                               //testing testcase4
                               $file_handle=fopen('test.py','w');
                               fwrite($file_handle,$answer_backend);
                               fwrite($file_handle,"\n");
                               fwrite($file_handle,"\n");
                               fwrite($file_handle,$testcase4_backend);
                               fclose($file_handle);

                               $output4 = exec('python /afs/cad.njit.edu/u/m/m/mm2623/public_html/canvas/test.py') or die('Cannot compile testcase4');;

                               if($output4 == $ans_testcase4_backend){
                               $detail = $detail."<br>"."Testcase4 => ".$testcase4_backend." => ".$output4."<br>";
                               $detail = $detail."Correct Answer => ".$ans_testcase4_backend."<br>";
                               $score_testcase4 = $each_score; 
                               }
                               elseif($output4 != $ans_testcase4_backend){
                               $detail = $detail."<br>"."Testcase4 => ".$testcase4_backend." => ".$output4."<br>";
                               $detail = $detail."Correct Answer => ".$ans_testcase4_backend."<br>";
                               $score_testcase4 = 0; 
                               }
                       }
                       if($testcase5_backend != ''){
                                //erasing the page
                                file_put_contents('test.py',"");

                                //testing testcase5
                                $file_handle=fopen('test.py','w');
                                fwrite($file_handle,$answer_backend);
                                fwrite($file_handle,"\n");
                                fwrite($file_handle,"\n");
                                fwrite($file_handle,$testcase5_backend);
                                fclose($file_handle);

                                $output5 = exec('python /afs/cad.njit.edu/u/m/m/mm2623/public_html/canvas/test.py') or die('Cannot compile testcase5');;

                                if($output5 == $ans_testcase5_backend){
                                $detail = $detail."<br>"."Testcase5 => ".$testcase5_backend." => ".$output5."<br>";
                                $detail = $detail."Correct Answer => ".$ans_testcase5_backend."<br>";
                                $score_testcase5 = $each_score; 
                                }
                                elseif($output5 != $ans_testcase5_backend){
                                $detail = $detail."<br>"."Testcase5 => ".$testcase5_backend." => ".$output5."<br>";
                                $detail = $detail."Correct Answer => ".$ans_testcase5_backend."<br>";
                                $score_testcase5 = 0; 
                                }
                        }

                }
                $question_backend = rawurlencode($question_backend);
                $detail = rawurlencode($detail);
                $post1 = "question_backend=$question_backend&question_id_backend=$question_id_backend&score_backend=$score_backend&detail=$detail&score_name=$score_name&score_testcase1=$score_testcase1&score_testcase2=$score_testcase2&score_testcase3=$score_testcase3&score_testcase4=$score_testcase4&score_testcase5=$score_testcase5&constraint=$constraint&score_constraints=$score_constraints"; 
                //echo json_encode($post1);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $backurl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post1);
                $result1 = curl_exec($ch);
                curl_close($ch);

        }
        $recieved_array1 = array();
        $recieved_array1 = json_decode($result1,true);
        $send_to_front = $recieved_array1;
}

//echo json_encode($topic); 
echo json_encode($send_to_front);
?>