<!DOCTYPE html> 
<html> 
	<head> 
		<title> Fetch Data From Database </title> 
		<style>
      body{
        background-image: url(../images/g1.jpg);
        background-size: cover;
        background-repeat: no-repeat;
      }
      .tdr{
        text-align: center;
      }
      .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 10px 25px;
        text-align: center;
        margin-top: 60px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
      }
      #delete {
        background-color: #f44336; /* Red */
        color: black;
        border-radius: 9px;
        padding: 8px 15px;
      }
      #delete:hover {
        background-color: #ff7961; /* Lighter red on hover */
      }
      #update {
        background-color: #008CBA; /* Blue */
        color: white;
        border-radius: 9px;
        padding: 8px 15px;
      }
      #update:hover {
        background-color: #5bc0de; /* Lighter blue on hover */
      }
      #link1 {
        color: black;
        text-decoration: none;
        font-size: 15px;
      }
      #link2 {
        color: white;
        text-decoration: none;
        font-size: 15px;
      }
		</style>
	</head> 

	<body bgcolor="lightgreen"> 
		<table align="center" border="1px" style="width:1000px; line-height:40px;"> 
			<tr> 
				<th colspan="6"><h2>Complaint Record</h2></th> 
			</tr> 
			<tr>
				<th> Email </th> 
				<th> Name </th> 
				<th> Room Number </th> 
        <th> Floor Number </th> 
				<th> Message </th>
				<th> Actions </th>
			</tr> 
			<?php 
				include 'connection.php';
				$sql = "select * from message_table ";
				$query = mysqli_query($conn, $sql);
				while($row1 = mysqli_fetch_array($query)) { 
			?> 
			<tr> 
				<td class="tdr"><?php echo $row1['email']; ?></td> 
				<td class="tdr"><?php echo $row1['Name']; ?></td> 
				<td class="tdr"><?php echo $row1['Room_Num']; ?></td> 
        <td class="tdr"><?php echo $row1['Floor_Num']; ?></td> 
				<td class="tdr"><?php echo $row1['Messages']; ?></td>
				<td style="width: 180px;">
					<center>
						<button id="delete"><a href="Delete.php?email=<?php echo $row1['email']; ?>" id="link1">Delete</a></button>
						<button id="update"><a href="update.php?email=<?php echo $row1['email']; ?>" id="link2">Update</a></button>
					</center>
				</td>
			</tr> 
			<?php 
				} 
			?> 
		</table>

		<center>
			<button class="button"><a href="../dashboard/home.php" style="text-decoration: none; color: white;">Home Page</a></button>
		</center>
	</body> 
</html>
