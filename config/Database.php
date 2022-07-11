<?php

class Database
{
    const HOST = "db.3wa.io";
    const BDD = "camillelefort_projet";
    const USER = "camillelefort";
    const MDP = "b954697b12a4772862c48e5d8d32381e";
    
    private $connexion;
    
    public function __construct()
    {
        try 
        {
            $this -> connexion = new PDO("mysql:host=".self::HOST.";dbname=".self::BDD,self::USER,self::MDP);
            $this -> connexion -> exec("SET CHARACTER SET utf8");
        } 
        catch(Exception $message) 
        {
            die("erreur de connexion ".$message -> getMessage());
        }
    }
    
    public function getConnexion()
    {
        return $this -> connexion;
    }
}