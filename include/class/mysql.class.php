<?php


class mysql
{
    /*網絡配置*/
    public $Host     = "localhost";
    public $Database = "";
    public $User     = "root";
    public $Password = "";

    public $Link_ID  = 0;
    public $Query_ID = 0;
    public $Record   = [];
    public $Row;

    public $Errno = 0;
    public $Error = "不能鏈接到數據庫";

    public $Auto_free   = 0;
    public $Auto_commit = 0;

    public $jsonErr = false;
    public $debug   = false;

    public function __construct($connentAry)
    {
        self::mysql($connentAry);
    }

    public function mysql($connentAry)
    {
        $this->Host     = $connentAry['host'];
        $this->Database = $connentAry['database'];
        $this->User     = $connentAry['user'];
        $this->Password = $connentAry['pass'];
    }

    public function connect($autoDb = true)
    {
        if ($this->Link_ID == 0) {
            $this->Link_ID = mysqli_connect($this->Host, $this->User, $this->Password, $this->Database) or die(mysqli_connect_errno($this->Link_ID));
            if (!$this->Link_ID) {
                $this->halt("連接數據庫失敗，請教檢查您的配置文件");
            }
            if (!$this->Link_ID) {
                if ($autoDb) {
                    if (!mysqli_query($this->Link_ID, 'CREATE DATABASE ' . $this->Database . ';')) {
                        $this->halt("創建數據庫失敗：" . $this->Database);
                    }
                } else {
                    $this->halt("找不到數據庫：" . $this->Database);
                }
            }
        }
    }

    public function getTableField($table)
    {
        $this->connect();
        $sql = "SELECT * FROM `" . $table . "`";
        if ($rs = mysqli_query($this->Link_ID, $sql)) {
            $fieldinfo = mysqli_fetch_fields($rs);
            foreach ($fieldinfo as $val) {
                // printf("Name: %s\n",$val->name);
                // printf("Table: %s\n",$val->table);
                // printf("max. Len: %d\n",$val->max_length);
                $result[] = ['name' => $val->name, 'type' => $val->type];
            }
        }

        return $result;
    }

    public function query($Query_String)
    {
        //echo $Query_String;
        $this->connect();
        mysqli_query($this->Link_ID, "SET NAMES 'utf8'");
        $this->Query_ID = mysqli_query($this->Link_ID, $Query_String);
        $this->Row      = 0;
        $this->Errno    = mysqli_errno($this->Link_ID);
        $this->Error    = mysqli_error($this->Link_ID);
        if (!$this->Query_ID) {
            $this->halt("SQL語句執行失敗：" . $Query_String);  //調試時
            return false;
        }
        return $this->Query_ID;
    }

    public function next()
    {
        $this->Record = @mysqli_fetch_array($this->Query_ID, MYSQLI_ASSOC);
        $this->Row += 1;
        $this->Errno = mysqli_errno($this->Link_ID);
        $this->Error = mysqli_error($this->Link_ID);

        $stat = is_array($this->Record);
        if (!$stat && $this->Auto_free) {
            mysqli_free_result($this->Query_ID);
            $this->Query_ID = 0;
        }
        return $stat;
    }

    public function f($Name)
    {
        return $this->Record[$Name];
    }

    public function getList($SQL)
    {
        //debug echo
        //echo $sql;
        $this->query($SQL);
        $ary = [];
        while ($this->next()) {
            $ary[] = $this->Record;
            // $i++;
        }
        return $ary;
    }

    public function getValue($SQL, $field = '')
    {
        // echo $SQL;
        $this->query($SQL);

        if ($this->next()) {
            if ($field) {
                return $this->f($field);
            }
        }
        return $this->Record;

        return false;
    }

    public function mssql_addslashes($data)
    {
        $ver = floatval(substr(PHP_VERSION, 0, 3));
        if ($ver >= 5.3 || !get_magic_quotes_gpc()) {
            $data = str_replace("'", "''", $data);
        }
        //if ($ver>=5.3 || !get_magic_quotes_gpc()) $data = addslashes($data);
        return $data;
    }

    public function insert($array, $table)
    {
        foreach ($array as $key => $val) {
            //if (trim($val)!='') $ary[]="`".$key."`='".$val."'";
            if (trim($val) != '') {
                $ary[] = "`" . $key . "`='" . $this->mssql_addslashes($val) . "'";
            }
        }
        $sql = "insert into `" . $table . "` set " . implode(',', $ary);
        $this->query($sql);
        return $this->insert_id();
    }

    public function insert_inarr($array, $table, $n)
    {
        $result = $this->query("SELECT * FROM " . $table);
        $fields = mysqli_num_fields($result);

        //返回所有键名
        //print_r(array_keys($array) );
        $key_name_arr = array_keys($array);

        for ($i = 0; $i < $fields; $i++) {
            //if(array_search(mysql_field_name($result, $i), $array) && $val!='id'){

            $file_arr[] = mysql_field_name($result, $i);
            //}
            //$file_arr[mysql_field_name($result, $i)]  =array_keys(mysql_field_name($result, $i));
        }
        print_r($file_arr);

        foreach ($key_name_arr as $key2 => $val2) {
            //echo $val2;

            if (array_key_exists($val2, $file_arr)) {
                echo $insert_key;
                echo '<br>';
            }
        }

        //print_r($file_arr);
        echo '<br>';

        foreach ($array as $key => $val) {
            echo $val;

            //if(in_array($val, $file_arr) && $val!='id'){
            //if(array_search($val, $file_arr) && $val!='id'){
            $ary[] = "`" . $key . "`='" . $val . "'";
            //}
        }
        // print_r($ary);
        echo '<br>';
        if ($n != 5) {
            $sql = "insert into `" . $table . "` set " . implode(',', $ary);
        } else {
            //echo $sql="insert into ".$table." set ".implode(',',$ary);
            $sql = "insert into `" . $table . "` set " . implode(',', $ary);
        }
        //echo $sql;
        //if($n!=5)
        $this->query($sql);
        return $this->insert_id();
    }

    public function insert_id()
    {
        return mysqli_insert_id($this->Link_ID);
    }

    public function update($array, $table, $where = null)
    {
        foreach ($array as $key => $val) {
            //$ary[]="`".$key."`=".(trim($val)!=''?"'".$val."'":"NULL");
            $ary[] = "`" . $key . "`=" . (trim($val) != ''?"'" . $this->mssql_addslashes($val) . "'":"NULL");
        }
        if (is_array($ary) && sizeof($ary) > 0) {
            $sql = "update `" . $table . "` set " . implode(',', $ary) . ($where?" WHERE " . $where:'');
            // if($this->debug) echo $sql;
            return $this->query($sql);
        }
        return false;
    }

    public function result_num()
    {
        return mysqli_num_rows($this->Query_ID);
    }

    public function table_exists($tab)
    {
        $sql = "SHOW TABLES LIKE '%" . $tab . "%'";
        $this->query($sql);
        if ($this->result_num()) {
            return true;
        }
        return false;
    }

    public function halt($msg)
    {
        printf("<font color=#000000><b>Database error:</b> %s<br>\n", $msg);
        printf("<b>MySQL Error</b>: %s (%s)<br></font>\n", $this->Errno, $this->Error);
        //		die('數據錯誤');
        /*if($this->jsonErr){
            disError($msg);
        }else{
            printf("</td></tr></table><font color=#000000><b>Database error:</b> %s<br>\n", $msg);
            printf("<b>MySQL Error</b>: %s (%s)<br></font>\n",$this->Errno,$this->Error);
            die("Session halted.");
        }
        throw new Exception($error);*/
    }

    public function free_result()
    {
        return mysqli_free_result($this->Query_ID);
    }

    public function disconnect()
    {
        return mysqli_close($this->Link_ID);
    }
}
