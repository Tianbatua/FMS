<?php
####################################################################
#	File Name	:	config.dbase.php
#	Author		:	Brian Cai
#	Location	: 	configs/
#	Description	:	Includes the required configuration settings
####################################################################

interface dbConfig
{
    const DBTYPE        =   "mysql";
    const DBHOST        =   "localhost";
    const DBUSER        =   "root";
    const DBPWD         =   "";
	const DBNAME        =   "db_fms";
    const TBLPREFIX     =   "tbl_";
    const DBCHARSET     =   "utf8";
	
}

//class_alias('iDBaseConfig', 'ifaceDb');

class cdBConfig implements dbConfig
{
    public function __construct()
    {
		$this->dBType		=	dbConfig::DBTYPE;
		$this->dBHost		=	dbConfig::DBHOST;
		$this->tblPrefix	=	dbConfig::TBLPREFIX;
		$this->dBUsr		=	dbConfig::DBUSER;
		$this->dBPwd		=	dbConfig::DBPWD;
		$this->dBCharSet	=	dbConfig::DBCHARSET;
		$this->dbName		=	dbConfig::DBNAME;
		
		$this->conObj		=	 "";
		$this->conString	=	 "";
    }
    
}

class cdBConnect extends cdBConfig implements dbConfig
{
  
   private $dbErrStyle	=	'background: #b3d9ff; border: 2px dashed #7F0200; border-radius: 15px; color: #FFFFFF; font-size: 20px; font-weight: bold; margin: 5% auto 0;  padding: 30px 40px;  text-align: center; width: 70%;';
   
	# Building the constructor
	public function __construct()
	{
      	# Invoking the base class contructor
		parent::__construct();
      	
    }
	
	# Function to establish database connection
    public function connectDB()
    {
		 global $pdoConObj;
		 
		 #Connecting to main databases
		$this->conString =  $this->dBType.":host=".$this->dBHost.";dbname=".$this->dbName.";charset=".$this->dBCharSet;
		$this->errString = "";
		try
		{ 
			$pdoConObj = new PDO($this->conString, $this->dBUsr, $this->dBPwd);
			$pdoConObj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{ 
			$this->isConnected = false;
			$this->errString .= "<html><head><title>Database Error</title></head><body>";
			$this->errString .=  '<div style="'.$this->dbErrStyle.'">'. $e->getMessage().'</div>';
			$this->errString .= "</body></html>";
			die($this->errString);
		}
	}

}
?>