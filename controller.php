<?php 




include "config.php";

#http function 
header('Content-Type:application/json'); 

function responseJson($success,$message,$data=[],$status=200){
    http_response_code($status);

    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data'    => $data
    ]);

    exit;
}

function responseError($message,$status=500,$success=false){
      http_response_code($status);

      echo json_encode([
        'success' => $success,
        'error'   =>  $message
      ]);

      exit;
}


$method = $_SERVER['REQUEST_METHOD']; 

switch($method){
    case "GET" : {
        if(isset($_GET['id'])){

            $id = $_GET['id'];
            $sql = "SELECT * FROM students WHERE id = $id";
            $result = mysqli_query($con,$sql);

            if(!$result){
                throw new Exception(mysqli_error($con));
            }

            //covert to associative array
            $student = mysqli_fetch_assoc($result);



            responseJson(true,'get student success',['student' => $student]);

        }else{
            try{
            
                $sql = "SELECT * FROM students";
                $result = mysqli_query($con,$sql);
    
                if(!$result){
                    throw new Exception('Failed to fetch students'.mysqli_error($con));
                }
    
                $students = mysqli_fetch_all($result,MYSQLI_ASSOC);
               
                responseJson(true,'select data success',["students" => $students]);
    
            }catch(Exception $e){
                responseError($e->getMessage());
            }
            
        }

        break;
    }

    case "POST" : {
       if(isset($_GET['id'])){
            try{
                $id = $_GET['id'];

                $name = $_POST['name'];

                responseJson('Updated successfully',200,['name' => $name]);

            }catch(Exception $e){
                responseError($e->getMessage(),500);
            }
            
       }else{
            try{

                $name = $_POST['name'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];

                $sql = "INSERT INTO `students`(`name`, `gender`, `address`, `phone`, `email`) 
                VALUES ('$name','$gender','$address','$phone','$email')";
                $result = mysqli_query($con,$sql);

                if(!$result){
                    throw new Exception('Failed when insertting student to database . '. mysqli_error($con));
                }

                responseJson(true,'created student success');

            }catch(Exception $e){
                responseError('Failed creatting student '.$e->getMessage(),500);
            }
       }

        break;
    }

    
    case "DELETE" : {
        try{

            $id = $_GET['id'];

            $sql = "DELETE FROM `students` WHERE id = $id";
            $result = mysqli_query($con,$sql);

            if(!$result){
                throw new Exception(mysqli_error($con));
            }

            responseJson(true,'Deleted student success');

        }catch(Exception $e){
            responseError($e->getMessage());
        }
        break;
    }
}


?>