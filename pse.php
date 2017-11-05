<?php
//PAITS SERVER ENGINE
// COPYRIGHT © 2017 Paitorocxon (Fabian Müller)
//  VERSION 1.0.0
function Error_Handler($error_number,$error_string,$error_file,$error_line){
    die('<!--[SERVER] ERROR ' . $error_number . $error_number . $error_string . $error_file . $error_line . ' !-->');
}
set_error_handler("Error_Handler");
if(isset($_GET['user']) && isset($_GET['password'])){
    if(file_exists("userfiles/" . $_GET['user'])){
        if(base64_decode(base64_decode(base64_decode(file_get_contents("userfiles/" . $_GET['user']))))==$_GET['password']){
        }else{
            echo "<!--[SERVER] 0,403-->";
            die();
        }
    }else{
        echo "<!--[SERVER] 0,404-->";
        die();
    }
}else{
    die("Permission denied!");
}
if (!is_dir("userfiles")){
    mkdir("userfiles");
    $myfile = fopen("userfiles/" . "admin", "w") or die("Cannot create user");
    $txt = "1234";
    fwrite($myfile, $txt);
    fclose($myfile);
}
echo "<!--[SERVER]-->" . "\n";
if(isset($_GET['command'])){
    $full_command = explode(" ", $_GET['command']);
    $command = $full_command;
    if(isset($command[0])){
        if($command[0]=="ls"){
            if(isset($command[1])){
                if(strpos($command[1],"..")){
                    die("Illegal charackters! (..)");
                }
            $files = scandir(realpath(dirname(__FILE__)) . $command[1]);   
            }else{
            $files = scandir(realpath(dirname(__FILE__)));                
            }
            $count = 0;
            echo "\n";
            foreach ($files as $file){
                $count++;
                if(is_dir($file)){
                echo "→/ " .$file  . "\n";
                }else{
                echo $file . "\n";
                }
            }
            echo "\n" . "[" . $count . "] Files in ";
            die();  
        }elseif($command[0]=="mkdir"){
            if(isset($command[1])){
                if(strpos($command[1],"..")){
                    die("Illegal charackters! (..)");
                }
                mkdir($command[1]); 
                echo "Created " . $command[1];      
            }else{        
                echo "Not created " . $command[1];            
            }
            die();  
        }elseif($command[0]=="del"){
            if(isset($command[1])){
                if(strpos($command[1],"..")){
                    die("Illegal charackters! (..)");
                }elseif($command[1]="pse.php"){
                    die("Illegal charackters! (..)");
                }
                unlink( $command[1]); 
                echo "Erased " . $command[1];      
            }else{        
                echo "Error!" . $command[1];            
            }
            die();  
        }elseif($command[0]=="rmdir"){
            if(isset($command[1])){
                if(strpos($command[1],"..")){
                    die("Illegal charackters! (..)");
                }
                $files = glob('path/to/temp/{,.}*', GLOB_BRACE);
                foreach($files as $file){ 
                  if(is_file($file))
                    unlink($file);
                }
                try{
                    rmdir($command[1]);
                } catch (Exception $ex){
                    echo  $ex;
                }
                echo "Erased " . $command[1];      
            }else{        
                echo "Error!" . $command[1];            
            }
            die();  
        }elseif($command[0]=="read"){
            if(isset($command[1])){
                if(strpos($command[1],"..")){
                    die("Illegal charackters! (..)");
                }
                if(file_exists($command[1])){
                    die(file_get_contents($command[1]));
                }   
            }else{        
                echo "Error! No such file or directory!" . $command[1];            
            }
            die();    
        }elseif($command[0]=="createuser"){
            if(isset($command[1])){
                if(strpos($command[1],"..")){
                    die("Illegal charackters! (..)");
                }
                if(file_exists("userfiles/" . $command[1])){
                    die("User exists already");
                }else{
                    $myfile = fopen("userfiles/" . $command[2], "w") or die("Cannot create user");
                    $txt = base64_decode(base64_decode(base64_decode($command[3])));
                    fwrite($myfile, $txt);
                    fclose($myfile);
                }   
            }else{        
                echo "Error! No such file or directory!" . $command[1];            
            }
            die();  
        }elseif($command[0]=="touch"){
            if(isset($command[1])){
                if(strpos($command[1],"..")){
                    die("Illegal charackters! (..)");
                }
                if(file_exists($command[1])){
                    die("User exists already");
                }else{
                    $myfile = fopen($command[1], "w") or die("Cannot create file");
                    $txt = $command[2];
                    fwrite($myfile, $txt);
                    fclose($myfile);
                }   
            }else{        
                echo "Error! No such file or directory!" . $command[1];            
            }
            die();  
        }elseif($command[0]=="help"){
            echo "\n";
            echo "ls </FOLDERNAME>                  List all files in folder" . "\n";
            echo "mkdir FOLDERNAME                  Creates a new directory" . "\n";
            echo "rmdir FOLDERNAME                  Deletes a directory" . "\n";
            echo "del FILENAME                      Deletes a file" . "\n";
            echo "createuser USERNAME PASSWORD      Create user" . "\n";
            echo "touch FILENAME <content>          Create new file" . "\n";
            die();            
        }        
    }
}else{
    die();
}

//PaitsServerEngine



