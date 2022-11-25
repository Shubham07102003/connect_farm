<?php
namespace Database;

//data types
// int
// phone
// email
// string
// empty


use Options\Options;
use PDOException;

class Validator{
    private $errors;
    private $superr;
    private $anyerr;
    private $options;
    private $tablename;

    public function vunique($data){
       $index = $this->options->getIndexes();
        // select a particular user by id
        try {

            $stmt = Handler::$connection->prepare("SELECT * FROM {$this->tablename} WHERE $index=:$index");
            $stmt->execute([$index => $data]);
            $user = $stmt->fetch();
        }catch (PDOException $e){
//            print_r($data);
//            echo '<br>'.$roster.'<br><pre>';
//            print_r($data). '</pre>';
//            print_r($e->getMessage());
            return $e->getMessage();
        }
        $bo = empty($user);
        return $bo ? [$bo,""]  : [$bo,$this->options->getIndexes()." Already Exists"];

    }

    public function vemail($data){
        $bo = filter_var($data,FILTER_VALIDATE_EMAIL) ? true : false;
        return $bo ? [$bo,""]  : [$bo,$this->options->getIndexes()."'s Format is Invalid"];
    }

    public function vstring($data){
        $bo = is_string($data);
        return $bo ? [$bo,""]  : [$bo,$this->options->getIndexes()." Should Be a String"];
    }

    public function vempty($data){
        $bo = empty($data) ? false : true;
        return $bo ? [$bo,""]  : [$bo,$this->options->getIndexes()." Can't Be Empty"];
    }

    public function vphone($data){
        $bo = preg_match('/^[0][1-9]\d{9}$|^[1-9]\d{9}$/',$data) ? true : false;
        return $bo ? [$bo,""]  : [$bo,$this->options->getIndexes()." Should Be a In A Valid Format"];
    }

    public function vint($data){
        $bo = is_numeric($data);
        return $bo ? [$bo,""]  : [$bo,$this->options->getIndexes()." Should Be a number"];
    }


public function __construct(Options $options,$data,$tablename = null)
{
       if(!empty($tablename)){
           $this->tablename = $tablename;
       }
    foreach ($options->getOpt() as $opt){
        $this->options = $options;
        $funname = 'v'.$opt;
        $this->errors[] =  $this->$funname($data);
        foreach ($this->errors as $error) {
            $this->anyerr = array_search(false,$error,true);
            $this->anyerr++;
            //print_r($this->anyerr);
            if(!empty($this->anyerr)){
//                print_r($error);
                $this->superr = $error;
                break;
            }
        }
        //$any_error = array_search(false,$this->errors);
//        if(empty($this->anyerr)){
//            return [true,""];
//        }else{
//            return $this->superr;
//        }
    }

}


    public function reterror(){
        if(empty($this->anyerr)){
            //print_r($this->anyerr);
            return [true,""];
        }else{
//        print_r($this->superr);
            return $this->superr;
        }
    }

}