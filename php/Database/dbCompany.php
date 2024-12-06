<?php

declare(strict_types=1);

namespace Database;

use Data\dLog;

use Toolkit\{
 Log
 ,Check
 ,Valid
};

class dbCompany extends Table implements iDatabase
{
	const CLASS_ID = 10;
	
	private static $classQueries = array();
	private static $dLog;
	private static $dbCompany_Site;
	
	public function __construct(){
		parent::__construct();
		self::$classQueries = self::qGet(self::CLASS_ID);
		self::$dLog = new dLog();
		self::$dbCompany_Site = new dbCompany_Site();
	}
	
	public static function Insert(array $array = array()): bool
	{
		if (! empty($array) && Valid::vString(self::$classQueries['Insert'])) {
			$returnData = (
				self::qRun(
					array(
						'query' => self::$classQueries['Insert']
						,'vData' => $array
					)
				)->rowCount() > 0
			);
			
			$lastCompanyId = self::getConnection()->lastInsertId();
			
			self::$dLog->Insert(
				array(
					'logType' => 0
					,'logAction' => 0
					,'logCategory' => self::CLASS_ID
					,'logText' => 'ID: '.$lastCompanyId
					,'userId' => $array['userId']
					,'logBool' => $returnData
				)
			);
			
			self::$dbCompany_Site->Insert(
				array(
					'userId' => $array['userId']
					,'companyId' => $lastCompanyId
					,'companySiteName' => 'Cégközpont'
					,'companySiteDesc' => '-'
					,'companySiteTypeId' => 2
				)
			);
			
			return $returnData;
		} else {
			return false;
		}
	}
	
	public static function Select(array $array = array(), string $type = ''): array
	{
		if (Valid::vString(self::$classQueries['Select'][$type])) {
			if (
				(
					$tempVar = self::qRun(
						array(
							'query' => self::$classQueries['Select'][$type]
							,'vData' => $array
						)
					)
				)->rowCount() > 0
			) {
				return $tempVar->fetchAll();
			} else {
				return array();
			}
		} else {
			return array();
		}
	}
	
	public static function Update(array $array = array(), string $type = ''): bool
	{
		if (! empty($array) && Valid::vString(self::$classQueries['Update'])) {
			$returnData = (
				self::qRun(
					array(
						'query' => self::$classQueries['Update']
						,'vData' => $array
					)
				)->rowCount() > 0
			);
			
			self::$dLog->Insert(
				array(
					'logType' => 0
					,'logAction' => 1
					,'logCategory' => self::CLASS_ID
					,'logText' => 'ID: '.$array['companyId']
					,'userId' => $array['userId']
					,'logBool' => $returnData
				)
			);
			
			return $returnData;
		} else {
			return false;
		}
	}
	
	public static function Delete(array $array = array(), string $type = ''): bool
	{
		if (! empty($array) && Valid::vString(self::$classQueries['Delete'])) {
			$returnData = (
				self::qRun(
					array(
						'query' => self::$classQueries['Delete']
						,'vData' => $array
					)
				)->rowCount() > 0
			);
			
			self::$dLog->Insert(
				array(
					'logType' => 0
					,'logAction' => 2
					,'logCategory' => self::CLASS_ID
					,'logText' => 'ID: '.$array['companyId']
					,'userId' => $array['userId']
					,'logBool' => $returnData
				)
			);
			
			return $returnData;
		} else {
			return false;
		}
	}
	
	public static function Class_Id(): int
	{
	return self::CLASS_ID;
	}
	
	public static function Check( ): bool
	{
	return (! self::qCheck(self::CLASS_ID));
	}

}