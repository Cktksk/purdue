<?php include "../../include/config.php"; ?>
<?php include "../../include/header.php"; ?>
<?php

	if (empty($_POST) == false)
	{
		$result = oci_parse($con, "UPDATE Faculties SET DepartmentID='" . $_POST['DepartmentID'] . "', Name='" . $_POST['Name'] . "' WHERE FacultyID='" . $_GET['id'] . "'");
		oci_execute($result);

		header("Location: index.php");
		exit;
	}

	$result = oci_parse($con, "SELECT * FROM Faculties WHERE FacultyID='" . $_GET['id'] . "'");
	oci_execute($result);
	$row = oci_fetch_array($result);

	$result2 = oci_parse($con, "SELECT * FROM Departments");
	oci_execute($result2);
	while($row2 = oci_fetch_array($result2))
	{
		if ($row['DEPARTMENTID'] == $row2['DEPARTMENTID'])
			$DepartmentID .= "<option value='" . $row2['DEPARTMENTID'] . "' selected='true'>" . $row2['NAME'] . "</option>\n";
		else
			$DepartmentID .= "<option value='" . $row2['DEPARTMENTID'] . "'>" . $row2['NAME'] . "</option>\n";
	}

?>
<p>Hello Administrator. You are currently editing a faculty:<p>
<form action="edit.php?id=<?php echo $row['FACULTYID']; ?>" method="post">
	<table cellpadding="0" cellspacing="0">
		<tr>
			<td><b>Department: </b></td>
			<td><select name="DepartmentID"><?php echo $DepartmentID; ?></select></td>
		</tr>
		<tr>
			<td><b>Name: </b></td>
			<td><input name="Name" type="text" value="<?php echo $row['NAME']; ?>" /></td>
		</tr>
	</table>
	<br />
	<input type="submit" value="Edit Faculty" />
</form>
<div class="home">
	<a href="<?php echo $RootDirectory; ?>admin/index.php">Click here to return to the menu</a>
</div>
<?php include "../../include/footer.php"; ?>