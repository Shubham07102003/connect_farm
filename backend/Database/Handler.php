<?php

namespace Database;

use Database\Connect;
use Database\Validator;
use Options\Options;
use PDO;
use PDOException;

class Handler
{
    public static $connection;

    public static $showfullerror = false;

    //    example of a datatype
    //       datatype = ['id'=>['int','phone','email','string','empty']]

    public $alltypes = ['int', 'phone', 'email', 'string', 'empty', 'unique'];

    public function __construct()
    {
        $con =  new Connect();
        self::$connection = $con->getDb();
    }


    public function insert($tablename, $data, $datatype = null)
    {
        $i = 0;
        $ii = 0;
        $len = count($data);
        $fields = array();
        $errors = array(); // storing error of a particular data type and of all fields

        // foreach ($data as $d) {
        //     $key = array_search($d, $data, true);
        //     $fields[] = $key;
        // }

        $fields =  array_keys($data);


        if (!empty($datatype)) {

            //check all given datatypes
            foreach ($datatype as $some) {
                foreach ($some as $item) {
                    //                        print_r($this->alltypes);
                    //                         echo $item;
                    $some1 = array_search($item, $this->alltypes, TRUE);
                    $some1++;
                    if (empty($some1)) {
                        $errors[] = 'Datatype of ' . $item . ' not found';
                    }
                }
            }

            $result11 = array_diff_key($datatype, $data);
            if (empty($result11)) {
                foreach ($datatype as $item) {
                    $key = array_search($item, $datatype, true);
                    //                         echo $key;
                    $valueofitem = $data[$key];
                    $optiond = new Options($item, $key);
                    $validat = new Validator($optiond, $valueofitem);
                    $errs = $validat->reterror();
                    if ($errs[0] == false) {
                        $errors[] = $errs[1];
                    }
                    //                         echo '<pre>';
                    //                         print_r($errs);
                    //                         echo '</pre>';
                }
            } else {
                $errors[] = 'Please Enter Same Data Keys in Datatype Parameter';
            }
        }

        foreach ($data as $d) {
            $key = array_search($d, $data, true);

            $data[$key] = htmlspecialchars($d);
        }

        if (!array_filter($errors)) {
            $roster = "INSERT INTO $tablename (";
            foreach ($fields as $feild) {
                if ($i == $len - 1) {
                    // last
                    $roster = $roster . strval($feild);
                    break;
                }
                $i++;
                $roster = $roster . strval($feild) . ",";
            }

            $roster .= ") VALUES (";
            foreach ($fields as $d) {
                if ($ii == $len - 1) {
                    // last
                    $roster .= ":" . strval($d);
                    break;
                }
                $roster .= ":" . strval($d) . ",";
                $ii++;
            }
            $roster .= ")";


            try {
                $stmt = self::$connection->prepare($roster);
                $stmt->execute($data);
            } catch (PDOException $e) {
                //            print_r($data);
                //            echo '<br>'.$roster.'<br><pre>';
                //            print_r($data). '</pre>';
                $errors[] = $e->getMessage();
                if (self::$showfullerror) {
                    $errors['table'] = $tablename;
                    $errors['data'] = $data;
                    $errors['dataty'] = $datatype;
                    $errors['feilds'] = $fields;
                    $errors['query'] = $roster;
                }
                // $errors[] = $roster;
                return $errors;
            }
        } else {
            return $errors;
        }


        //if nothing happens every thing is ok
        return true;
    }














    public function update($tablename, $data, $where, $datatype = null)
    {
        $i = 0;
        $ii = 0;
        $len = count($data);
        $len1 = count($where);
        $fields = array();
        $errors = array(); // storing error of a particular data type and of all fields

        // foreach ($data as $d) {
        //     $key = array_search($d, $data, true);
        //     $fields[] = $key;
        // }


        $fields =  array_keys($data);

        if (!empty($datatype)) {

            //check all given datatypes
            foreach ($datatype as $some) {
                foreach ($some as $item) {
                    //                        print_r($this->alltypes);
                    //                         echo $item;
                    $some1 = array_search($item, $this->alltypes, TRUE);
                    $some1++;
                    if (empty($some1)) {
                        $errors[] = 'Datatype of ' . $item . ' not found';
                    }
                }
            }

            //            foreach ($where as $item){
            //                    $some1 = array_search($item, $where,true);
            //                if (!array_key_exists($some1,$data)){
            //                    $errors[] = 'Please Enter Same Data Keys in Where Parameter';
            //                }
            //            }

            $result11 = array_diff_key($datatype, $data);
            if (empty($result11)) {
                foreach ($datatype as $item) {
                    $key = array_search($item, $datatype, true);
                    //                         echo $key;
                    $valueofitem = $data[$key];
                    $optiond = new Options($item, $key);
                    $validat = new Validator($optiond, $valueofitem);
                    $errs = $validat->reterror();
                    if ($errs[0] == false) {
                        $errors[] =  $errs[1];
                    }
                    //                         echo '<pre>';
                    //                         print_r($errs);
                    //                         echo '</pre>';
                }
            } else {
                $errors[] = 'Please Enter Same Data Keys in Datatype Parameter';
            }
        }

        foreach ($data as $d) {
            $key = array_search($d, $data, true);
            $data[$key] = htmlspecialchars($d);
        }


        if (!array_filter($errors)) {
            $roster = "UPDATE $tablename SET ";
            foreach ($fields as $feild) {
                if ($i == $len - 1) {
                    // last
                    $roster .=  strval($feild) . "=:" . strval($feild);
                    break;
                }
                $i++;
                $roster .=  strval($feild) . "=:" . strval($feild) . ",";
            }

            $roster .= " WHERE ";

            foreach ($where as $prkey) {
                $some1 = array_search($prkey, $where, true);
                if ($ii == $len1 - 1) {
                    // last
                    $roster .=  strval($some1) . "=:where" . strval($some1);
                    break;
                }
                $roster .=  strval($some1) . "=:where" . strval($some1) . " and ";
                $ii++;
            }

            foreach ($where as $item) {
                $some1 = array_search($item, $where, true);
                $data['where' . $some1] = $item;
            }


            try {
                $stmt = self::$connection->prepare($roster);
                $stmt->execute($data);
            } catch (PDOException $e) {
                //            print_r($data);
                //         echo '<br>'.$roster.'<br><pre>';
                //            print_r($data). '</pre>';
                $errors[] = $e->getMessage();
                if (self::$showfullerror) {

                    $errors['table'] = $tablename;
                    $errors['data'] = $data;
                    $errors['where'] = $where;
                    $errors['dataty'] = $datatype;
                    $errors['feilds'] = $fields;
                    $errors['query'] = $roster;
                }
                return $errors;
            }
        } else {
            return $errors;
        }


        //if nothing happens every thing is ok
        return true;
    }














    public function delete($tablename, $primarykey, $primaryval)
    {
        $primarykey = htmlspecialchars($primarykey);
        $primaryval = htmlspecialchars($primaryval);
        $stmt = self::$connection->prepare("DELETE FROM $tablename WHERE $primarykey =:$primarykey");
        $stmt->bindParam(':' . $primarykey, $primaryval);
        $stmt->execute();
        if (!$stmt->rowCount()) return ["Deletion failed"];
        return true;
    }

    public function select($tablename, $where = null, $limit = null, $orderby = null, $order = null)
    {
        $ii = 0;
        $roster = "SELECT * FROM $tablename";

        if (!empty($where)) {
            //            print_r($where);
            $roster .= " WHERE ";
            $len11 = count($where);
            foreach ($where as $prkey) {
                $some1 = array_search($prkey, $where, true);

                if ($ii == $len11 - 1) {
                    // last
                    $roster .= strval($some1) . "=:" . strval($some1);
                    break;
                }
                $ii++;
                $roster .= strval($some1) . "=:" . strval($some1) . " and ";
            }
        }


        if (!empty($orderby) && !empty($order)) {
            $roster .= " order by $orderby $order";
        }

        if (!empty($limit)) {
            $roster .= " LIMIT $limit";
        }

        try {
            $stmt = self::$connection->prepare($roster);
            if (empty($where)) {
                $stmt->execute();
            } else {
                $stmt->execute($where);
            }
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmt->fetchAll();
            // echo $roster;
        } catch (PDOException $e) {
            //            print_r($data);
            //            echo '<br>'.$roster.'<br><pre>';
            //            print_r($data). '</pre>';
            return $e->getMessage() . $roster;
        }

        return $rows;
    }


    public function queryRunner($qry, $prms = null)
    {

        $stmt = self::$connection->prepare($qry);
        if (!empty($prms)) {
            $stmt->execute($prms);
        } else {
            $stmt->execute();
        }

        
        if (strpos($qry, 'select') !== false || strpos($qry, 'SELECT') !== false) {
            try {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                $rows = $stmt->fetchAll();
                if (empty($stmt->rowCount())) {
                    return false;
                }
                return $rows;
            } catch (PDOException $e) {
                //            print_r($data);
                //            echo '<br>'.$roster.'<br><pre>';
                //            print_r($data). '</pre>';
                return $e->getMessage() . $qry;
            }
        }




        if (!$stmt->rowCount()) return ["Some Error Occured"];
        return true;
    }
}
