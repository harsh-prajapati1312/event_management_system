function update1($is_aprove,$booking_no)
	{
		$conn=connection();
		$sql="update booking set is_aprove= Aprove where booking_id='$booking_id';
		$conn->query($sql);
		$conn->close();
		
	}