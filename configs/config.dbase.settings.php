<?php
####################################################################
#	File Name	:	config.dbase.php
#	Author		:	Brian Cai
#	Location	: 	configs/
#	Description	:	Includes the required configuration settings
####################################################################

interface iDBaseConfig
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
		$this->dBType		=	iDBaseConfig::DBTYPE;
		$this->dBHost		=	iDBaseConfig::DBHOST;
		$this->tblPrefix	=	iDBaseConfig::TBLPREFIX;
		$this->dBUsr		=	iDBaseConfig::DBUSER;
		$this->dBPwd		=	iDBaseConfig::DBPWD;
		$this->dBCharSet	=	iDBaseConfig::DBCHARSET;
		$this->dbName		=	iDBaseConfig::DBNAME;
		
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