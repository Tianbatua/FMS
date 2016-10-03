<?php
####################################################################
#	File Name	:	class.main.php
#	Author		:	Vijay
#	Location	: 	webroot/classes/
####################################################################

# Getting Server's Document root path
if (!defined('DOC_ROOT'))
	define("DOC_ROOT", $_SERVER['DOCUMENT_ROOT'].'/FMS/');
# Custom Error Log File
if (!defined('ERR_LOG_FILE'))
 	define("ERR_LOG_FILE", DOC_ROOT."err_log.txt");

 class dbClass
 {
	 
	 /**********************************************************************
	 # FUNCTION TO INSERT INTO A SCHEMA
	 **********************************************************************/
	 public function insertSchema($schemaName, $fieldsList, $valuesList)
	 {
		try
		{ 
			global $pdoConObj;

			$queryString	=	"";
			$schemaPrfx		=	"tbl_";
			$schemaName		=	$schemaPrfx.$schemaName;
			$errorMessage	=	"";
			$insertedID		=	"";
			
			$insertQry		=	"INSERT INTO {$schemaName} ($fieldsList) VALUES ($valuesList)";
			//echo "Query String :".$insertQry;
			$insertStatement=	$pdoConObj->prepare($insertQry);
			$insertStatement->execute();
			$insertedID	   .=	$pdoConObj->lastInsertId();
		}
		catch(PDOException $e)
		{
			$errorMessage	.= "\n***************************************";
			$errorMessage	.=  "\n Error Date :".date("M-j-Y D, h:i:s A");
			$errorMessage	.=	"\n Error While executing  INSERT Query Over :".$schemaName;
			$errorMessage	.=	"\n QUERY :: ".$insertQry;
			$errorMessage	.=	"\n MESSAGE :".$e->getMessage();
			$errorMessage	.=	"\n CODE :".$e->getCode();
			$errorMessage	.=	"\n FILE :".$e->getFile();
			$errorMessage	.=	"\n LINE :".$e->getLine();
			
			logClass::printLog($errorMessage);
			//error_log($errorMessage, 3, ERR_LOG_FILE);
		}
		
		if($insertedID)
			return $insertedID;
		else
			return 0;
			
	}
	
	 /**********************************************************************
	 # FUNCTION TO INSERT INTO A SCHEMA WHERE NOT EXISTS
	 **********************************************************************/
	 public function insertSchemaWhereNOTExists($schemaName, $fieldsList, $valuesList, $whereCondtion, $limit)
	 {
		try
		{ 
			global $pdoConObj;

			$queryString	=	"";
			$schemaPrfx		=	"tbl_";
			$schemaName		=	$schemaPrfx.$schemaName;
			$queryString	=	"";
			$errorMessage	=	"";
			$insertedID		=	"";
			$queryString	.=	($limit == '')	?  ''	:' LIMIT '.$limit;
			
			$insertQry		=	"INSERT INTO {$schemaName} ($fieldsList) ";
			$insertQry		.= 	"SELECT * FROM (SELECT $valuesList) AS TMP WHERE NOT EXISTS ";
			$insertQry		.= 	" ( SELECT $fieldsList FROM {$schemaName} WHERE $whereCondtion) $queryString";
			//echo "Query String :".$insertQry;
			$insertStatement=	$pdoConObj->prepare($insertQry);
			$insertStatement->execute();
			$insertedID	   .=	$pdoConObj->lastInsertId();
		}
		catch(PDOException $e)
		{
			$errorMessage	.= "\n***************************************";
			$errorMessage	.=  "\n Error Date :".date("M-j-Y D, h:i:s A");
			$errorMessage	.=	"\n Error While executing  INSERT Query Over :".$schemaName;
			$errorMessage	.=	"\n QUERY :: ".$insertQry;
			$errorMessage	.=	"\n MESSAGE :".$e->getMessage();
			$errorMessage	.=	"\n CODE :".$e->getCode();
			$errorMessage	.=	"\n FILE :".$e->getFile();
			$errorMessage	.=	"\n LINE :".$e->getLine();
		
			$fileContents 	= file_get_contents(ERR_LOG_FILE);
			file_put_contents(ERR_LOG_FILE, $errorMessage.$fileContents);
			//error_log($errorMessage, 3, ERR_LOG_FILE);
		}
		
		if($insertedID)
			return $insertedID;
		else
			return 0;
			
	}
	
	 /**********************************************************************
	 # FUNCTION TO DELETE INFORMATION FROM A SCHEMA
	 **********************************************************************/
	 public function removeFromSchema($schemaName, $delCondition)
	 {
		try
		{ 
			global $pdoConObj;
			$queryString	=	"";				
			$resultCount	=	"";
			$schemaPrfx		=	"tbl_";				
			$schemaName		=	$schemaPrfx.$schemaName;
			
			$deleteQry	=	"";
			$deleteQry	.= 	"DELETE FROM {$schemaName} WHERE $delCondition";
			//echo 'DELETE QUERY:'.$deleteQry;
			$deleteStatement =	$pdoConObj->prepare($deleteQry);
			$deleteStatement->execute();
			$affected_rows	=	$deleteStatement->rowCount();
			
		}
		catch(PDOException $e)
		{
			$errorMessage	.= "\n***************************************";
			$errorMessage	.=  "\n Error Date :".date("M-j-Y D, h:i:s A");
			$errorMessage	.=	"\n Error While executing  DELETE Query Over :".$schemaName;
			$errorMessage	.=	"\n QUERY :: ".$insertQry;
			$errorMessage	.=	"\n MESSAGE :".$e->getMessage();
			$errorMessage	.=	"\n CODE :".$e->getCode();
			$errorMessage	.=	"\n FILE :".$e->getFile();
			$errorMessage	.=	"\n LINE :".$e->getLine();
			
			$fileContents 	= file_get_contents(ERR_LOG_FILE);
			file_put_contents(ERR_LOG_FILE, $errorMessage.$fileContents);
			//error_log($errorMessage, 3, ERR_LOG_FILE);
		}
		if($affected_rows)
			return $affected_rows;
		else
			return 0;
	 }
	 
	 /**********************************************************************
	 # FUNCTION TO RETRIEVE INFORMATION FROM A SCHEMA
	 **********************************************************************/
	 public function getSchemaInfo($schemaName, $columnsList, $whereCondition, $groupByField, $orderByField, $sortDirection, $limit)
	 {
		try
		  { 
			  global $pdoConObj;
		
				$queryString	=	"";				
				$resultCount	=	"";
				$schemaPrfx		=	"tbl_";				
				$schemaName		=	$schemaPrfx.$schemaName;
				
				$queryString	=	"SELECT ".$columnsList. " FROM ".$schemaName;
				
				$queryString	.=	($whereCondition == '')?'':" WHERE ".$whereCondition;
				
				$queryString	.=	($groupByField == '')?'':' GROUP BY '.$groupByField;
				
				$queryString	.=	($orderByField == '')?'':' ORDER BY '.$orderByField;
				
				$queryString	.=	($sortDirection == '')? ' ': ' '.$sortDirection;
				
				$queryString	.=	($limit == '')?'':' LIMIT '.$limit;
				
				//echo "<br>Query String :".$queryString;
				//error_log($queryString, 3, ERR_LOG_FILE);
				
				$preparedStatement	=	$pdoConObj->prepare($queryString);
<<<<<<< HEAD
				$fileContents 	= file_get_contents(ERR_LOG_FILE);
				file_put_contents(ERR_LOG_FILE, $queryString.$fileContents);
=======
				
>>>>>>> 35415fc59dcbc37f70fa51090118fd6248b3102d
				$preparedStatement->execute();
				
				$resultCount	=	$preparedStatement->rowCount();
		 }
		  catch(PDOException $e)
		  { 
			$errorMessage	=	"";
			$errorMessage	.= "\n***************************************";
			$errorMessage	.=  "\n Error Date :".date("M-j-Y D, h:i:s A");
			$errorMessage	.=	"\n Error While executing  SELECT Query Over :".$schemaName;
			$errorMessage	.=	"\n QUERY :: ".$queryString;
			$errorMessage	.=	"\n MESSAGE :".$e->getMessage();
			$errorMessage	.=	"\n CODE :".$e->getCode();
			$errorMessage	.=	"\n FILE :".$e->getFile();
			$errorMessage	.=	"\n LINE :".$e->getLine();
			
			logClass::printLog($errorMessage);
		  }
		
		if($resultCount)
		{
			$resultsList	=	$preparedStatement->fetchAll(PDO::FETCH_ASSOC);
			return $resultsList;
		}
		else
			return NULL;
	 }
	 
	  /**********************************************************************
	 # FUNCTION TO RETRIEVE INFORMATION FROM A SCHEMA BY JOINS
	 **********************************************************************/
	 public function getSchemaInfoByJoin($columnsList, $joinStatement, $whereCondition, $groupByField, $orderByField, $sortDirection, $limit)
	 {
		try
		  { 
			  global $pdoConObj;
		
				$queryString	=	"";				
				
				$queryString	=	"SELECT ".$columnsList. " FROM ".$joinStatement;
				
				$queryString	.=	($whereCondition == '')?'':" WHERE ".$whereCondition;
				
				$queryString	.=	($groupByField == '')?'':' GROUP BY '.$groupByField;
				
				$queryString	.=	($orderByField == '')?'':' ORDER BY '.$orderByField;
				
				$queryString	.=	($sortDirection == '')? ' ': ' '.$sortDirection;
				
				$queryString	.=	($limit == '')?'':' LIMIT '.$limit;
				
				//echo "Query String :".$queryString;
				//error_log($queryString, 3, ERR_LOG_FILE);
				
				$preparedStatement	=	$pdoConObj->prepare($queryString);
				
				$preparedStatement->execute();
				
				$resultCount	=	$preparedStatement->rowCount();
		 }
		  catch(PDOException $e)
		  { 
			$errorMessage	=	"";
			$errorMessage	.= "\n***************************************";
			$errorMessage	.=  "\n Error Date :".date("M-j-Y D, h:i:s A");
			$errorMessage	.=	"\n Error While executing  JOIN Query";
			$errorMessage	.=	"\n QUERY :: ".$queryString;
			$errorMessage	.=	"\n MESSAGE :".$e->getMessage();
			$errorMessage	.=	"\n CODE :".$e->getCode();
			$errorMessage	.=	"\n FILE :".$e->getFile();
			$errorMessage	.=	"\n LINE :".$e->getLine();
			
			$fileContents 	= file_get_contents(ERR_LOG_FILE);
			file_put_contents(ERR_LOG_FILE, $errorMessage.$fileContents);
			//error_log($errorMessage, 3, ERR_LOG_FILE);
		  }
		
		if($resultCount)
		{
			$resultsList	=	$preparedStatement->fetchAll(PDO::FETCH_ASSOC);
			return $resultsList;
		}
		else
			return NULL;
	 }

	/**********************************************************************
	 # FUNCTION TO UPDATE A SCHEMA
	 **********************************************************************/
	 public function updateSchema($schemaName, $updateString, $upCond)
	 {
		try
		{ 
			global $pdoConObj;

			$queryString	=	"";
			$schemaPrfx		=	"tbl_";
			$schemaName		=	$schemaPrfx.$schemaName;
			
			$updateQry		=	"UPDATE {$schemaName} SET $updateString WHERE $upCond";			
			//echo $updateQry	;
			
			$updateStatement=	$pdoConObj->prepare($updateQry);
			$updateStatement->execute();
			$affected_rows	=	$updateStatement->rowCount();
		}
		catch(PDOException $e)
		{
			$errorMessage	=	"";
			$errorMessage	.= "\n***************************************";
			$errorMessage	.=  "\n Error Date :".date("M-j-Y D, h:i:s A");
			$errorMessage	.=	"\n Error While UPDATING :".$schemaName;
			$errorMessage	.=	"\n QUERY :: ".$updateQry;
			$errorMessage	.=	"\n MESSAGE :".$e->getMessage();
			$errorMessage	.=	"\n CODE :".$e->getCode();
			$errorMessage	.=	"\n FILE :".$e->getFile();
			$errorMessage	.=	"\n LINE :".$e->getLine();
			
			$fileContents 	= file_get_contents(ERR_LOG_FILE);
			file_put_contents(ERR_LOG_FILE, $errorMessage.$fileContents);
			//error_log($errorMessage, 3, ERR_LOG_FILE);
		}
		
		if($affected_rows)
			return $affected_rows;
		else
			return 0;
			
	}
	  // TETS FUNCTIONS
	  
	  public function updateSchemaTest($schemaName, $updateString, $upCond)
	 {
		try
		{ 
			global $pdoConObj;

			$queryString	=	"";
			$schemaPrfx		=	"tbl_";
			$schemaName		=	$schemaPrfx.$schemaName;
			
			$updateQry		=	"UPDATE {$schemaName} SET $updateString WHERE $upCond";			
			echo $updateQry	;
			
			//$updateStatement=	$pdoConObj->prepare($updateQry);
			//$updateStatement->execute();
			//$affected_rows	=	$updateStatement->rowCount();
		}
		catch(PDOException $e)
		{
			$errorMessage	=	"";
			$errorMessage	.= "\n***************************************";
			$errorMessage	.=  "\n Error Date :".date("M-j-Y D, h:i:s A");
			$errorMessage	.=	"\n Error While UPDATING :".$schemaName;
			$errorMessage	.=	"\n QUERY :: ".$updateQry;
			$errorMessage	.=	"\n MESSAGE :".$e->getMessage();
			$errorMessage	.=	"\n CODE :".$e->getCode();
			$errorMessage	.=	"\n FILE :".$e->getFile();
			$errorMessage	.=	"\n LINE :".$e->getLine();
			
			$fileContents 	= file_get_contents(ERR_LOG_FILE);
			file_put_contents(ERR_LOG_FILE, $errorMessage.$fileContents);
			//error_log($errorMessage, 3, ERR_LOG_FILE);
		}
		
		if($affected_rows)
			return $affected_rows;
		else
			return 0;
			
	}	
	 /**********************************************************************
	 # FUNCTION TO RETRIEVE INFORMATION FROM A SCHEMA
	 **********************************************************************/
	 public function getSchemaInfoTest($schemaName, $columnsList, $whereCondition, $groupByField, $orderByField, $sortDirection, $limit)
	 {
		try
		  { 
			  global $pdoConObj;
		
				$queryString	=	"";				
				$schemaPrfx		=	"tbl_";				
				$schemaName		=	$schemaPrfx.$schemaName;
				
				$queryString	=	"SELECT ".$columnsList. " FROM ".$schemaName;
				
				$queryString	.=	($whereCondition == '')?'':" WHERE ".$whereCondition;
				
				$queryString	.=	($groupByField == '')?'':' GROUP BY '.$groupByField;
				
				$queryString	.=	($orderByField == '')?'':' ORDER BY '.$orderByField;
				
				$queryString	.=	($sortDirection == '')? ' ': ' '.$sortDirection;
				
				$queryString	.=	($limit == '')?'':' LIMIT '.$limit;
				
				echo "<br>Query String :".$queryString;
				error_log($queryString, 3, ERR_LOG_FILE);
				
				$preparedStatement	=	$pdoConObj->prepare($queryString);
				
				$preparedStatement->execute();
				
				$resultCount	=	$preparedStatement->rowCount();
		 }
		  catch(PDOException $e)
		  { 
			$errorMessage	=	"";
			$errorMessage	.= "\n***************************************";
			$errorMessage	.=  "\n Error Date :".date("M-j-Y D, h:i:s A");
			$errorMessage	.=	"\n Error While executing  SELECT Query Over :".$schemaName;
			$errorMessage	.=	"\n QUERY :: ".$queryString;
			$errorMessage	.=	"\n MESSAGE :".$e->getMessage();
			$errorMessage	.=	"\n CODE :".$e->getCode();
			$errorMessage	.=	"\n FILE :".$e->getFile();
			$errorMessage	.=	"\n LINE :".$e->getLine();
			
			$fileContents 	= file_get_contents(ERR_LOG_FILE);
			file_put_contents(ERR_LOG_FILE, $errorMessage.$fileContents);
			//error_log($errorMessage, 3, ERR_LOG_FILE);
			
		  }
		
		if($resultCount)
		{
			$resultsList	=	$preparedStatement->fetchAll(PDO::FETCH_ASSOC);
			return $resultsList;
		}
		else
			return NULL;
	 }
	 
	 /**********************************************************************
	 # FUNCTION TO CHECK SEO-FRIENDLY-URL AVAILABILITY
	 **********************************************************************/
	 public function checkSEOURLAvailability($tableName, $columnName, $seoURL)
	 {
		global $pdoConObj;
		$schemaPrfx		=	"tbl_";
		$schemaName		=	$schemaPrfx.$tableName;
		
		$seoStatement = $pdoConObj->prepare("SELECT $columnName FROM $schemaName WHERE $columnName=:seourl");
		$seoStatement->execute(array(':seourl' => $seoURL));
		$seoCount = $seoStatement->rowCount();
		
		if($seoCount)
			return 'exist';
		else
			return 'not_exist';
		
	 }	 
	 /**********************************************************************
	 # FUNCTION TO GENERATE SEO-FRIENDLY-URL ALONG WITH ID PREFIX ( ex: vijay-chaudary-9)
	 **********************************************************************/
	 public function generateSEOURL($tableName, $columnName, $seoURL)
	 {
		global $pdoConObj;
		$schemaPrfx		=	"tbl_";
		$schemaName		=	$schemaPrfx.$tableName;
		$seoStatement = $pdoConObj->prepare("SELECT MAX($columnName) +1 AS NextInsertedID FROM $schemaName");
		$seoStatement->execute();
		$seoCount = $seoStatement->rowCount();
		
		if($seoCount)
		{
			$nextRowID = $seoStatement->fetchAll(PDO::FETCH_ASSOC);
			return $seoURL."-".$nextRowID[0]['NextInsertedID']; 
		}
		
	 }
	 
	   /**********************************************************************
	 # FUNCTION TO RETRIEVE INFORMATION FROM A SCHEMA BY JOINS
	 **********************************************************************/
	 public function getSchemaInfoByJoinTest($columnsList, $joinStatement, $whereCondition, $groupByField, $orderByField, $sortDirection, $limit)
	 {
		try
		  { 
			  global $pdoConObj;
		
				$queryString	=	"";				
				
				$queryString	=	"SELECT ".$columnsList. " FROM ".$joinStatement;
				
				$queryString	.=	($whereCondition == '')?'':" WHERE ".$whereCondition;
				
				$queryString	.=	($groupByField == '')?'':' GROUP BY '.$groupByField;
				
				$queryString	.=	($orderByField == '')?'':' ORDER BY '.$orderByField;
				
				$queryString	.=	($sortDirection == '')? ' ': ' '.$sortDirection;
				
				$queryString	.=	($limit == '')?'':' LIMIT '.$limit;
				
				echo "Query String :".$queryString;
				//error_log($queryString, 3, ERR_LOG_FILE);
				
				$preparedStatement	=	$pdoConObj->prepare($queryString);
				
				$preparedStatement->execute();
				
				$resultCount	=	$preparedStatement->rowCount();
		 }
		  catch(PDOException $e)
		  { 
			$errorMessage	=	"";
			$errorMessage	.= "\n***************************************";
			$errorMessage	.=  "\n Error Date :".date("M-j-Y D, h:i:s A");
			$errorMessage	.=	"\n Error While executing  JOIN Query";
			$errorMessage	.=	"\n QUERY :: ".$queryString;
			$errorMessage	.=	"\n MESSAGE :".$e->getMessage();
			$errorMessage	.=	"\n CODE :".$e->getCode();
			$errorMessage	.=	"\n FILE :".$e->getFile();
			$errorMessage	.=	"\n LINE :".$e->getLine();
			
			$fileContents 	= file_get_contents(ERR_LOG_FILE);
			file_put_contents(ERR_LOG_FILE, $errorMessage.$fileContents);
			//error_log($errorMessage, 3, ERR_LOG_FILE);
		  }
		
		if($resultCount)
		{
			$resultsList	=	$preparedStatement->fetchAll(PDO::FETCH_ASSOC);
			return $resultsList;
		}
		else
			return NULL;
	 }
	
 }
?>