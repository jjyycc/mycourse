<?php
/**
 * Created by PhpStorm.
 * User: zj
 * Date: 2017/10/24
 * Time: 15:15
 */

namespace dao;
 class BaseDAO
{
     /**
      * @var 静态共享的PDO对象
      */
    private static $_PDO;

    public  static  $_host;
     public  static $_DataBaseName;
     public  static  $_UserId;
     public  static  $_DBPassword;

    private  static  $_dsn;

    private static function CreatePDO(){
        $host=BaseDAO::$_host;
        $dbname=BaseDAO::$_DataBaseName;
        $_dsn="mysql:host=$host;dbname=$dbname";

        try{
            BaseDAO::$_PDO= new \PDO($_dsn,BaseDAO::$_UserId,BaseDAO::$_DBPassword,
                array(\PDO::ATTR_PERSISTENT=>true));//创建PDO的持久化连接

            BaseDAO::$_PDO -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        }catch (\PDOException $e){
            die("Erroe!".$e->getMessage()."");
        }

    }
     /**
      * @return 静态共享的PDO对象
      */
     public static function getPDO()
     {
         if (self::$_PDO==null) self::CreatePDO();
         return self::$_PDO;
     }

     /**
      * @param 静态共享的PDO对象 $PDO
      */
     public static function setPDO($PDO)
     {
         self::$_PDO =null;//首先清除原有的数据连接对象
         self::$_PDO = $PDO;
     }

     public   function __construct()
     {
         $this->setDefaultConnParameters();
     }

     /**
      * @param $_host
      * @param $_DataBaseName
      * @param $_UserId
      * @param $_DBPassword
      */
     private function setDefaultConnParameters()
     {
         $this::$_host = 'localhost';
         $this::$_DataBaseName = 'csdb';
         $this::$_UserId = 'root';
         $this::$_DBPassword = '582314';
     }
 }