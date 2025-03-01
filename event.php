<?php
	include_once 'conn.php';
	function insert($cname)
	{
		$conn=connection();
		$sql="select * from event_type where ename='$ename'";
		//echo $sql;
		$result=$conn->query($sql);
		//print_r($result);
		if($result->num_rows == 0 )
		{ 	
			$sql="insert into event_type values(NULL,'$ename')";
			$conn->query($sql);
			echo "<script>alert('event_name is Added!')</script>";
		}
		else
		{
			echo "<script>alert('event_name already exist!')</script>";
		}

		
		$conn->close();
	}
	
function update($cid,$cname)
	{
		$conn=connection();
		$sql="update event_type set ename='$ename' where eid=$eid";
		$conn->query($sql);
		$conn->close();
		
	}
	function display()
	{
		$conn=connection();
		$sql="select * from event_type";
		$result=$conn->query($sql);
		$conn->close();
		return $result;	
	}