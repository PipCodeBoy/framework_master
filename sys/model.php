<?php

	class Model{

		protected $db;
		protected $stmt;

		function __construct(){
			$this->db=DB::singleton();
			//die($this->db);
		}

		function query($query)
		{
			$this->stmt=$this->db->prepare($query);

		}

		function bind($param,$value,$type=null)
		{
			switch ($value) {
				case is_int($value):
					$type=PDO::PARAM_INT;
					break;
				case is_string($value):
					$type=PDO::PARAM_STR;
					break;
				default:
					$type=PDO::PARAM_STR;
					break;
			}

			$this->stmt->bindValue($param,$value,$type);
		}

		function execute()
		{
			//die($this->stmt);
			$this->stmt->execute();
		}

		function resultSet()
		{
			$results = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			return $results;
		}

		function single()
		{
			$results = $this->stmt->fetch(PDO::FETCH_ASSOC);
			return $results;
		}

		function rowCount()
		{
			$result = $this->stmt->rowCount();
			return $result;
		}

		function lastinsertID()
		{
			$lastId = $this->db->lastInsertId();
			return $lastId;
		}

		function beginTransaction()
		{
			$this->db->beginTransaction();
		}

		function endTransaction()
		{
			$this->db->commit();
		}

		function cancelTransaction()
		{
			$this->db->rollback();
		}

		function debugDumpParams()
		{
			$this->stmt->debugDumpParams();
		}
	}