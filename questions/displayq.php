<?php
    session_start();
    include("../login/connection.php");
    include("../login/functions.php");
    include("qfunctions.php");
    include("qconnection.php");
    $user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        // posted
        $answer = $_POST["answer"];
        $question_id = $_POST['q_id'];
        $responder_id = $user_data['user_id'];
        // echo $answer, $question_id, $responder_id;
        if (!empty($answer) && !empty($question_id) && !empty($responder_id)){
            $answer_id = randomAns(13);
            $queryys = "insert into answers (answer, question_id, responder_id, answer_id) values ('$answer', '$question_id', '$responder_id', $answer_id)";
            
            mysqli_query($con,  $queryys);
            header("Location: ../login/index.php");
            die;
        } else {

        }
    }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    
    <div class="container-fluid p-5">
        <?php
            $sql = "SELECT * from questions";

            $result = $con -> query($sql);

            if($result -> num_rows > 0){
                while($row = $result -> fetch_assoc()){
                    echo 
                    
                    '<div class="container-fluid mb-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3>'.$row['question'].'</h3>
                                    <span onclick="showthis('.$row['question_id'].')" class="w3-button w3-display-topright bg-dark" style = "z-index: 1; background-color: black; color: white;")>Answer</span>

                                </div>
                            
                        </div>
                    </div>
                    <div class="w3-modal bg-dark text-white" id = "'.$row['question_id'].'">
                        <div class="container-fluid  pt-5">
                            <div class="container-fluid  pt-5">
                                <h1>We Value Your Feedback</h1>
                            </div>
                            <span id="btn'.$row['question_id'].'" class="w3-button w3-display-topright bg-dark" style = "z-index: 1; background-color: black; color: white;")>x</span>

                            <div class="apend-here'.$row['question_id'].'">
                            
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "zero rows";
            }
        ?>
        
    </div>

    <script src="questions.js"></script>
</body>
</html>