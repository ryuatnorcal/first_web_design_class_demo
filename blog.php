<?php
/* here is just scratch of blog functions */

function blog()
{

	setupSQL();
	
}

function testSQL()	// HERE IS TEST AREA
{
		$SQL=openSQL();
		mysql_select_db("ryuatnor_blog", $SQL);
		$result = mysql_query("SELECT * FROM blog");
?>
		<table style="width:100%;">
			<tr>
				<td>ID</td>
				<td>User</td>
				<td>Email</td>
				<td>Pw</td>
				<td>key</td>
			</tr>
<?php
		while($row = mysql_fetch_array($result))
		{
?>
			<tr>
				<td><?= $row['ID']; ?></td> 
				<td><?= $row['User']; ?></td>
				<td><?= $row['Email']; ?></td>
				<td><?= $row['pw']; ?></td>
				<td><?= $row['PRIMARY']; ?></td>
			</tr>
<?php
		}
		// [FIXED] RIGHT NOW WE HAVE PROBLEM AT PRIMARY ID. 
		// MYSQL STORE 0 AS PRIMARY ID. 
?>
		</table>
<?
		closeSQL($SQL);
	}
	function setupSQL()
	{
?>
	<h1>setupSQL</h1>
<?php
		$SQL = openSQL();
		// create table 
		if (!$SQL){	die('Could not connect: ' . mysql_error());	}
		mysql_select_db("ryuatnor_blog", $SQL);
		//mysql_query("DROP TABLE blog",$SQL);		// when you need to drop the table user this line
		
		
		$SQLtable = "CREATE TABLE blog
		(
			ID MEDIUMINT NOT NULL AUTO_INCREMENT, 
			Email varchar(50),
			User varchar(15),
			pw varchar(15),
			PRIMARY KEY(ID),
			article LONGTEXT,
			title TINYTEXT,
			tag SET,
			time TIMESTAMP()
			
		)";

		// Execute query
		if(!mysql_query($SQLtable,$SQL)){die('Error 1: ' . mysql_error());}
		else{ echo "table user has created "; }
		
		mysql_select_db("mizmonet_mainblog", $SQL);
		//mysql_query("DROP TABLE microposts",$SQL); 	// when you need to drop the table user this line 
		
		$SQLtable = "CREATE TABLE microposts
		(
			blogID int NOT NULL AUTO_INCREMENT, 
			PRIMARY KEY(blogID),
			username CHAR(20),
			comment TINYTEXT
			
		)";

		// Execute query
		if(!mysql_query($SQLtable,$SQL)){die('Error 2: ' . mysql_error());}
		else{ echo "table micropost has created ";}
	
		closeSQL($SQL);
	}
	function openSQL()
	{
		$SQLhost="localhost";
		$SQLuser="ryuatnor_admin";
		$SQLpw="abcdefg";
		$SQLdatabase="ryuatnor_blog";
		
		$SQL_connect = mysql_connect($SQLhost,$SQLuser,$SQLpw);
		return $SQL_connect;
	}
	function closeSQL($connection)
	{
		mysql_close($connection);
	}

?>
