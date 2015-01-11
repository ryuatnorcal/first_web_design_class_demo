<!DOCUMENT TYPE html>
<html>
<head>
	<title>:: mizmo ::</title>
	<link rel="stylesheet" type="text/css" href="design.css" />
	<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="design.js"></script> 
	<!-- Facebook like button -->
	<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</head>
<body>
	<div id="wrapper">
	
		<div id="cont_wrap">
			<div id="header">
			
			</div>
			<div id="left">
				<h1>Menu</h1>
				<ul>
					<li><a href="index.php?p=0" alt="Go to Home">HOME</a></li>
					<li><a href="index.php?p=1" alt="Go to About">ABOUT</a></li>
					<li><a href="index.php?p=2" alt="Go to Demo">DEMO</a></li>
					<li><a href="index.php?p=3" alt="Go to Blog">BLOG</a></li>
					<li><a href="index.php?p=4" alt="Go to Contact">CONTACT</a></li>
					<li><a href="index.php?p=7" alt="login">Login</a></li>
				<ul>
			</div>
			<div id="right">
<?php
			$user=$_POST['user'];
			$pw=$_POST['pw'];
			$page=$_GET['p'];
			$error;
			$sub=$_GET['sub'];
			$blogtitle=$_POST['blogtitle'];
			$article=$_POST['article'];
			$id=$_POST['ID'];
			if(empty($id)){$id=$_GET['i'];}

	// MAIL FORM VARIABLES 
			$mailto = "rmatsuda686@gmail.com";
			$fullName=$_POST['fullName'];
			$firstName=$_POST['firstName'];
			$lastName=$_POST['lastName'];
			$address1=$_POST['address1'];
			$address2=$_POST['address2'];
			$phone=$_POST['phone'];
			$city=$_POST['city'];
			$states=$_POST['state'];
			$zip=$_POST['zip'];
			$email=$_POST['email'];
			$comment=$_POST['comment'];
			$company=$_POST['company']; 
			$head = "**** [Mail From Web Page] **** \n".
			"This message was sent from ". $category . " page. \n \n".
			"From       : ". $email."\n \n";
			// body for comments
			$body = "Name      : ".$firstName.", ".$lastName."\n".
					 "Company   : ".$company."\n".
					 "Email     : ".$email."\n".
					 "Phone     : ".$phone."\n".
					 "Address 1 : ".$address1."\n".
					 "Address 2 : ".$address2."\n".
					 "City      : ".$city."\n".
					 "State     : ".$states."\n".
					 "ZIP       : ".$zip."\n".
					 "Comment   : \n".$comment."\n \n";
	
			$footer = "\n \n **** [End Of Message ] **** \n \n";
			
			$title = "[ WEB PAGE NOTIFICATION ] ";
	// *** VARIABLES
	
			if(empty($page))
				$page = 0;
			/*
			if(!empty($user) && !empty($pw))
			{
					$expire=time()+60*60*24*30;
					setcookie("user",$user, $expire);	
			}*/
				
			switch($page)
			{
				case 0: origin();	break;
				case 1: about(); break;
				case 2: demo();	break;
				case 3: blog($id); break;
				case 4: contact(); break;
				case 5: $result=login($user,$pw); 
								if($result == false){origin();} 
								break;
				case 6: mail("$mailto","$title","$head"."$body"."$footer");
  							sentMail();
  							break;
  			case 7: cms($user,$pw,$error,$sub); break;
  			case 8: post($sub,$blogtitle,$article,$id); break;	//ADDED NEW FUNCTION, THIS FUNCTION SEND RECEIVE THE POST ARTICLES 
			}
			
			function sentMail()
			{
?>
				<div id="contents">
					<h1>Sent Massage Successfully </h1>
					<p> You have sent a message to the site owner ! </p>
				</div>
<?php
			}
			function login($user,$pw)
			{
				// here is login function
				if(($user == "drpepper") && ($pw = "sky306"))
					return true;
				return false;
			}
			function origin()
			{
?>
				<div id="contents">
					<h1>Welcome to mizmo! </h1>
					<p> This web page is my promotion web page <br />
				</div>
<?php
			}
			
			function about()
			{
?>
				<div id="contents">
					<h1>About </h1>
					<p> This web page is my promotion web page </p>
				</div>
<?php
			}
			
			function demo()
			{
?>
				<div id="contents">
					<h1>Demo</h1>
					<p> This web page is my promotion web page </p>
					<a href="http://ryu.keepskatinbro.com/contents/blog/blog.php" alt="Blog System" target="_blank">[PHP & MySQL] Blog System 2010 Summer</a><br />
					<a href="/projects/php/main/project/public_html/index.html" alt="HTML Class Project" target="_blank">[CISW 320] Introduction to Web Site Development 2010 Spring</a>
				</div>
<?php				
			}
			function blog($id)
			{
?>
				<div id="contents">
					<h1>blog</h1>
					<p> This web page is my promotion web page </p>
<?php
				$SQL=openSQL();
				mysql_select_db("ryuatnor_blog", $SQL);
				$result = mysql_query("SELECT * FROM blog ORDER BY time DESC LIMIT 0,10");
?>
		
		<table style="width:100%;">
			<tr style="background:#000000; color:#ffffff;">
				<td>title</td>
				<td>time</td>
			</tr>	
<?php
		while($row = mysql_fetch_array($result))
		{
?>
			<tr>
				<!--<td><a href="index.php?p=3&i=<?= $row['ID']; ?>" class="select"><?= $row['title']; ?></a></td>-->
				<td><a class="select" id="<?= $row['ID']; ?>"><?= $row['title']; ?></a></td>
				<td><?= $row['time']; ?></td>
			</tr>
			
			<div id="popup" class="<?= $row['ID']; ?>">
			<a id="popupClose" class="<?= $row['ID']; ?>">X</a>
			<div id="blog_wrapper">
					<h1><?= $row['title']; ?></h1>
					<p><?= $row['article']; ?></p>
					<span style="float:right;"><?= $row['time']; ?></span>
			</div>
			<div id="fb-root"></div>
			<div class="fb-like" data-send="true" data-width="450" data-show-faces="true"></div>
		</div>
		<div id="bkpopup" class="<?= $row['ID']; ?>"></div>
<?php
		}
?>
		</table>
<?php
		// [FIXED] RIGHT NOW WE HAVE PROBLEM AT PRIMARY ID. 
		// MYSQL STORE 0 AS PRIMARY ID.
		/*****************************************************
			PUT POPUP BOX WITH JQUERY
		*****************************************************
		$query = "SELECT * FROM blog WHERE ID=".$id;
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result))
		{
?>
	<!--	<div id="popup">
			<a id="popupClose" style="float:right;">X</a>
					<h1><?= $row['title']; ?></h1>
					<p><?= $row['article']; ?></p>
					<span style="float:right;"><?= $row['time']; ?></span>
		</div>
		<div id="bkpopup"></div>-->
<?php
		}*/
		closeSQL($SQL);
?>		
				</div>
<?php
				
			}
			
			function cms($user,$pw,$error,$sub)
			{
				$userkey="drpepper";
				$pwkey="sky306";
				$error;
				
				if(empty($user)||empty($pw))
				{
?>
					<h1>Login <?php echo $user; ?></h1>
						<p> Please use your username and password to login your Dash Board <br />
							You may not have username and password because Dash Board is only for this site owner....<br />
							If you are normal user, Please go back to main pages 
						</p>
						
					<div id="login_form">
					<form id='form' method='post' action='index.php?p=7'>
					<table>
						<tr>
							<td>User</td>
							<td><input class="input" id='user' name='user' type='text' /></td>
						</tr>
						<tr>
							<td>Pass Word</td>
							<td><input class="input" id='pw' name='pw' type='password' /></td>
						</tr>
						<tr>
							<td><input type="submit" value="Log In" /></td>
						</tr>
						</form>
					</table>
					</div>
					
<?php
				}
				else if((($user!=$userkey)||($pw!=$pwkey))&&($error<3))
				{
?>
					<p>Ooops User name or/and password didn't much!</p>
					<div id="login_form">
					<form id='form' method='post' action='index.php?p=7'>
					<table>
						<tr>
							<td>User</td>
							<td><input class="input" id='user' name='user' type='text' /></td>
						</tr>
						<tr>
							<td>Pass Word</td>
							<td><input class="input" id='pw' name='pw' type='password' /></td>
						</tr>
						<tr>
							<td><input type="submit" value="Log In" /></td>
						</tr>
						</form>
					</table>
					</div>
<?php
					$error++;
				}
				else if((($user!=$userkey)||($pw!=$pwkey))&&($error=3))
				{
?>
					<p>Do YoU ReAlLy HaVe YoUr AcCoUnT? <br />
						yOuR UsErNaMe AnD PasS wOrd ArE iN yOuR bOOk sHelL !!<br />
						HaCckInG iS iLLiGaL !!<br />
					</p>
<?php					
			
				}
				else if((($user==$userkey)&&($pw==$pwkey))||($_COOKIE['user']==$userkey)&&($_COOKIE['pw']==$pwkey))
				{
					$expire=time()+60*60*24*30;
					setcookie("user",$user, $expire);	
					setcookie("pw",$pw,$expire);
?>
				
				<h1>Dash Board <?php print $user; ?></h1>
				<div id="submenu">
					<ul>
						<li><a href="index.php?p=8&sub=1" alt="New Blog">New Blog</a></li>
						<li><a href="index.php?p=8&sub=2" alt="New Blog" >Edit Blog</a></li>
						<li><a href="index.php?p=8&sub=3" alt="New Blog" >Elase Blog</a></li>
						<li><a href="index.php?p=8&sub=4" alt="New Blog">Add news</a></li>
						<li><a href="index.php?p=8&sub=5" alt="New Blog">delete news</a></li>
						<li><a href="index.php?p=8&sub=6" alt="View blog list">View Blog List </a></li>
						<li><a href="index.php?p=8&sub=7" alt="View news list">View News List </a></li>
					</ul>
				</div>
				
<?php
				}
				
			}
		function post($sub,$title,$article,$id)
		{
			switch($sub)
					{
						case 0: home(); break;
						case 1: new_blog($title,$article); break;
						case 2: edit_blog($id,$title,$article); break;
						case 3: erase_blog($id,$title,$article); break;
						case 4: add_news(); break;
						case 5: delete_news(); break;
						case 6: list_blog(); break;
						case 7: list_news(); break;
						case 22: setupSQL(); break;
					}
		}
	function erase_blog($id,$title,$article)
	{
		$SQL=openSQL();
		mysql_select_db("ryuatnor_blog", $SQL);
		$result = mysql_query("SELECT * FROM blog ORDER BY time DESC");
		if(empty($id))
		{
?>
		<div id="contents">
		<h1>Dash Board :: Delete Blog</h1>
		<div id="submenu">
			<ul>
				<li><a href="index.php?p=8&sub=1" alt="New Blog">New Blog</a></li>
				<li><a href="index.php?p=8&sub=2" alt="New Blog" >Edit Blog</a></li>
				<li><a href="index.php?p=8&sub=3" alt="New Blog" >Elase Blog</a></li>
				<li><a href="index.php?p=8&sub=4" alt="New Blog">Add news</a></li>
				<li><a href="index.php?p=8&sub=5" alt="New Blog">delete news</a></li>
				<li><a href="index.php?p=8&sub=6" alt="View blog list">View Blog List </a></li>
				<li><a href="index.php?p=8&sub=7" alt="View news list">View News List </a></li>
			</ul>
		</div>
		<table style="width:100%;">
			<tr style="background:#000000; color:#ffffff;">
				<td>*</td>
				<td>ID</td>
				<td>title</td>
				<td>time</td>
				<td>key</td>
			</tr>
			<form id='form' method='post' action='index.php?p=8&sub=3'>
<?php
		while($row = mysql_fetch_array($result))
		{
?>
			<tr>
				<td><input type="radio" name="ID" value="<?= $row['ID']; ?>" /></td>
				<td><?= $row['ID']; ?></td> 
				<td><?= $row['title']; ?></td>
				<td><?= $row['time']; ?></td>
				<td><?= $row['PRIMARY']; ?></td>
			</tr>
<?php
		}
		// [FIXED] RIGHT NOW WE HAVE PROBLEM AT PRIMARY ID. 
		// MYSQL STORE 0 AS PRIMARY ID. 
?>
		</table>
		<input type="submit" value="Delete!" />
		</form>
<?php
		}
		else if(!empty($id))
		{
			$user_db = "DELETE FROM blog WHERE ID=".$id;
			if(!mysql_query($user_db,$SQL)){die('Error0@delete: ' . mysql_error());}
				else{
?>
					<h1>Dash Board :: Successed Post Deliting Blog</h1>
					<div id="submenu">
						<ul>
							<li><a href="index.php?p=8&sub=1" alt="New Blog">New Blog</a></li>
							<li><a href="index.php?p=8&sub=2" alt="New Blog" >Edit Blog</a></li>
							<li><a href="index.php?p=8&sub=3" alt="New Blog" >Elase Blog</a></li>
							<li><a href="index.php?p=8&sub=4" alt="New Blog">Add news</a></li>
							<li><a href="index.php?p=8&sub=5" alt="New Blog">delete news</a></li>
							<li><a href="index.php?p=8&sub=6" alt="View blog list">View Blog List </a></li>
							<li><a href="index.php?p=8&sub=7" alt="View news list">View News List </a></li>
						</ul>
					</div>
					<p>Your post was successfully stored at SQL table :9</p>
<?php
			}
		}
		closeSQL($SQL);
	}
	function edit_blog($id,$title,$article)
	{
		
		$SQL=openSQL();
		mysql_select_db("ryuatnor_blog", $SQL);
		$result = mysql_query("SELECT * FROM blog ORDER BY time DESC");
		if(empty($id))
		{
?>
		<div id="contents">
		<h1>Dash Board :: Edit Blog</h1>
		<div id="submenu">
			<ul>
				<li><a href="index.php?p=8&sub=1" alt="New Blog">New Blog</a></li>
				<li><a href="index.php?p=8&sub=2" alt="New Blog" >Edit Blog</a></li>
				<li><a href="index.php?p=8&sub=3" alt="New Blog" >Elase Blog</a></li>
				<li><a href="index.php?p=8&sub=4" alt="New Blog">Add news</a></li>
				<li><a href="index.php?p=8&sub=5" alt="New Blog">delete news</a></li>
				<li><a href="index.php?p=8&sub=6" alt="View blog list">View Blog List </a></li>
				<li><a href="index.php?p=8&sub=7" alt="View news list">View News List </a></li>
			</ul>
		</div>
		<div>
		<table style="width:100%;">
			<tr style="background:#000000; color:#ffffff;">
				<td>*</td>
				<td>ID</td>
				<td>title</td>
				<td>time</td>
				<td>key</td>
			</tr>
			<form id='form' method='post' action='index.php?p=8&sub=2'>
<?php
		while($row = mysql_fetch_array($result))
		{
?>
			<tr>
				<td><input type="radio" name="ID" value="<?= $row['ID']; ?>" /></td>
				<td><?= $row['ID']; ?></td> 
				<td><?= $row['title']; ?></td>
				<td><?= $row['time']; ?></td>
				<td><?= $row['PRIMARY']; ?></td>
			</tr>
<?php
		}
		// [FIXED] RIGHT NOW WE HAVE PROBLEM AT PRIMARY ID. 
		// MYSQL STORE 0 AS PRIMARY ID. 
?>
		</table>
		<input type="submit" value="Edit!" />
		</form>
		</div>
<?php
		}
		else if(!empty($id)&&((empty($article))||(empty($title))))
		{
			$selector = "SELECT * FROM blog WHERE ID=".$id;
			$result = mysql_query($selector);
			while($row = mysql_fetch_array($result))
			{
?>
			<div id="contents">
		<h1>Dash Board :: Edit Blog</h1>
		<div id="submenu">
			<ul>
				<li><a href="index.php?p=8&sub=1" alt="New Blog">New Blog</a></li>
				<li><a href="index.php?p=8&sub=2" alt="New Blog" >Edit Blog</a></li>
				<li><a href="index.php?p=8&sub=3" alt="New Blog" >Elase Blog</a></li>
				<li><a href="index.php?p=8&sub=4" alt="New Blog">Add news</a></li>
				<li><a href="index.php?p=8&sub=5" alt="New Blog">delete news</a></li>
				<li><a href="index.php?p=8&sub=6" alt="View blog list">View Blog List </a></li>
				<li><a href="index.php?p=8&sub=7" alt="View news list">View News List </a></li>
			</ul>
		</div>
		<form id='form' method='post' action='index.php?p=8&sub=2&i= <?= $id; ?> '>
			<table>
				<tr>
					<td>Title</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<th colspan='2'><input class="input" size='71' id='blogtitle' name='blogtitle' type='text' value="<?= $row['title']; ?>" /></th>
				</tr>
				<tr>
					<th colspan='2'><textarea class="input" id='article' name='article' rows='8' cols='55' value="<?= $row['article']; ?>"></textarea></th>
				</tr>
				<tr>
					<td><input type="submit" value="Post !! " /></td>
				</tr>
			</table>
		</form>
		</div>
<?php
			}
		}
		else if((!empty($article))&&(!empty($title))&&(!empty($id)))
		{
			$article = html_to_SQL($article);
			$user_db = "UPDATE blog SET article='".$article."', title='".$title."' WHERE ID=".$id;
			if(!mysql_query($user_db,$SQL)){die('Error@editing: ' . mysql_error());}
				else{
?>
					<h1>Dash Board :: Successed Post Editing Blog</h1>
					<div id="submenu">
						<ul>
							<li><a href="index.php?p=8&sub=1" alt="New Blog">New Blog</a></li>
							<li><a href="index.php?p=8&sub=2" alt="New Blog" >Edit Blog</a></li>
							<li><a href="index.php?p=8&sub=3" alt="New Blog" >Elase Blog</a></li>
							<li><a href="index.php?p=8&sub=4" alt="New Blog">Add news</a></li>
							<li><a href="index.php?p=8&sub=5" alt="New Blog">delete news</a></li>
							<li><a href="index.php?p=8&sub=6" alt="View blog list">View Blog List </a></li>
							<li><a href="index.php?p=8&sub=7" alt="View news list">View News List </a></li>
						</ul>
					</div>
					<p>Your post was successfully stored at SQL table :9</p>
<?php
			}
		} 
		closeSQL($SQL);
	}
	
	function new_blog($title,$article)
	{
		if(empty($title)||empty($article))
		{
?>
		<div id="contents">
		<h1>Dash Board :: Post New Blog</h1>
		<div id="submenu">
			<ul>
				<li><a href="index.php?p=8&sub=1" alt="New Blog">New Blog</a></li>
				<li><a href="index.php?p=8&sub=2" alt="New Blog" >Edit Blog</a></li>
				<li><a href="index.php?p=8&sub=3" alt="New Blog" >Elase Blog</a></li>
				<li><a href="index.php?p=8&sub=4" alt="New Blog">Add news</a></li>
				<li><a href="index.php?p=8&sub=5" alt="New Blog">delete news</a></li>
				<li><a href="index.php?p=8&sub=6" alt="View blog list">View Blog List </a></li>
				<li><a href="index.php?p=8&sub=7" alt="View news list">View News List </a></li>
			</ul>
		</div>
		<form id='form' method='post' action='index.php?p=8&sub=1'>
			<table>
				<tr>
					<td>Title</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<th colspan='2'><input class="input" size='71' id='blogtitle' name='blogtitle' type='text' /></th>
				</tr>
				<tr>
					<th colspan='2'><textarea class="input" id='article' name='article' rows='8' cols='55' ></textarea></th>
				</tr>
				<tr>
					<td><input type="submit" value="Post !! " /></td>
				</tr>
			</table>
		</form>
		</div>
<?php
		}
		else if(!empty($title)&&!empty($article))
		{	
			$SQL= openSQL();				
			if (!$SQL){	die('Could not connect: ' . mysql_error());	}
			mysql_select_db("ryuatnor_blog", $SQL);
			$article = html_to_SQL($article);
			
			$user_db = "INSERT INTO blog (article,title) VALUES ('$article','$title')";
				if(!mysql_query($user_db,$SQL)){die('Error@newPost : ' . mysql_error());}
				else{
?>
					<h1>Dash Board :: Successed Post New Blog</h1>
					<div id="submenu">
						<ul>
							<li><a href="index.php?p=8&sub=1" alt="New Blog">New Blog</a></li>
							<li><a href="index.php?p=8&sub=2" alt="New Blog" >Edit Blog</a></li>
							<li><a href="index.php?p=8&sub=3" alt="New Blog" >Elase Blog</a></li>
							<li><a href="index.php?p=8&sub=4" alt="New Blog">Add news</a></li>
							<li><a href="index.php?p=8&sub=5" alt="New Blog">delete news</a></li>
							<li><a href="index.php?p=8&sub=6" alt="View blog list">View Blog List </a></li>
							<li><a href="index.php?p=8&sub=7" alt="View news list">View News List </a></li>
						</ul>
					</div>
					<p>Your post was successfully stored at SQL table :9</p>
<?php				
				}
			closeSQL($SQL);
		}
	}

	/*
	THE TABLE BLOG HAS ....
	ID MEDIUMINT NOT NULL AUTO_INCREMENT, 
			Email varchar(50),
			User varchar(15),
			pw varchar(15),
			article LONGTEXT,
			title TINYTEXT,
			time TIMESTAMP,
			PRIMARY KEY(ID)
	*/
	
	function list_blog()
	{
		$SQL=openSQL();
		mysql_select_db("ryuatnor_blog", $SQL);
		$result = mysql_query("SELECT * FROM blog ORDER BY time DESC");
?>
		<div id="contents">
		<h1>Dash Board :: Post New Blog</h1>
		<div id="submenu">
			<ul>
				<li><a href="index.php?p=8&sub=1" alt="New Blog">New Blog</a></li>
				<li><a href="index.php?p=8&sub=2" alt="New Blog" >Edit Blog</a></li>
				<li><a href="index.php?p=8&sub=3" alt="New Blog" >Elase Blog</a></li>
				<li><a href="index.php?p=8&sub=4" alt="New Blog">Add news</a></li>
				<li><a href="index.php?p=8&sub=5" alt="New Blog">delete news</a></li>
				<li><a href="index.php?p=8&sub=6" alt="View blog list">View Blog List </a></li>
				<li><a href="index.php?p=8&sub=7" alt="View news list">View News List </a></li>
			</ul>
		</div>
		<table style="width:100%;">
			<tr>
				<td>ID</td>
				<td>title</td>
				<td>time</td>
				<td>key</td>
			</tr>
		
<?php
		while($row = mysql_fetch_array($result))
		{
?>
			<tr>
				<td><?= $row['ID']; ?></td> 
				<td><?= $row['title']; ?></td>
				<td><?= $row['time']; ?></td>
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
		mysql_query("DROP TABLE blog",$SQL);		// when you need to drop the table user this line
		
		
		$SQLtable = "CREATE TABLE blog
		(
			ID MEDIUMINT NOT NULL AUTO_INCREMENT, 
			article LONGTEXT,
			title TEXT,
			time TIMESTAMP,
			PRIMARY KEY(ID)
		)";

		// Execute query
		if(!mysql_query($SQLtable,$SQL)){die('Error 1: ' . mysql_error());}
		else{ echo "table user has created <BR />"; }
		
		mysql_select_db("ryuatnor_blog", $SQL);
		mysql_query("DROP TABLE microposts",$SQL); 	// when you need to drop the table user this line 
		
		$SQLtable = "CREATE TABLE microposts
		(
			blogID int NOT NULL AUTO_INCREMENT, 
			PRIMARY KEY(blogID),
			username CHAR(20),
			time TIMESTAMP,
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
function html_to_SQL($string)
{
	/***********************************************************
		USEstr_replace TO REPLACE THE STRING VALUE 
	***********************************************************/
	//$string = addcslashes($string);
	$s = htmlspecialchars($string,ENT_QUOTES);
	//$s = html_entity_decode($string);
	print $s;
	return $s;
}
function SQL_to_html($string)
{
	return $string;
}
function htmlEncodeText($string) 
{ 
  $pattern = '<([a-zA-Z0-9\.\, "\'_\/\-\+~=;:\(\)?&#%![\]@]+)>'; 
  preg_match_all ('/' . $pattern . '/', $string, $tagMatches, PREG_SET_ORDER); 
  $textMatches = preg_split ('/' . $pattern . '/', $string); 

  foreach ($textMatches as $key => $value) { 
   $textMatches [$key] = htmlentities ($value); 
  } 

  for ($i = 0; $i < count ($textMatches); $i ++) { 
   $textMatches [$i] = $textMatches [$i] . $tagMatches [$i] [0]; 
  } 

  return implode ($textMatches); 
} 
			
			
			function contact()
			{
				$user_email;
				$title;
				$msg;
				$email = "rmatsuda686@gmail.com";
				if(empty($user_email))
				{
?>
				<div id="contents">
					<h1>contact</h1>
					<tbody>
						<p> This web page is my promotion web page </p>
						<table>
							<form id='form' method='post' action='index.php?p=6'>
							 	<tr>
							 		<td>First Name : </td>
							 		<td><input class="input" id='firstName' name='firstName' type='text' /></td>
							 		<td>Last Name : </td>
							 		<td><input class="input" id='lastName' name='lastName' type='text' /></td>
						 		</tr>
						 		<tr>
							 		<td>Company : </td>
							 		<td><input class="input" id='company' name='company' type='text' /></td>
							 		<td>Email :</td>
							 		<td><input class="input" id='Email' name='email' type='text' /></td>
						 		</tr>
						 		<tr>
							 		<td>Phone :</td>
							 		<td><input class="input" id='phone' name='phone' type='text' /></td>
							 		<td>Address 1 :</td>
							 		<td><input class="input" id='address1' name='address1' type='text' /></td>
						 		</tr>
						 		<tr>
							 		<td>Address 2 :</td>
							 		<td><input class="input" id='address2' name='address2' type='text' /></td>
							 		<td>City :</td>
							 		<td><input class="input" id='city' name='city' type='text' /></td>
						 		</tr>
						 		<tr>
							 		<td>State :</td>
							 		<td><input class="input" id='state' name='state' type='text' /></td>
							 		<td>Zip :</td>
							 		<td><input class="input" id='zip' name='zip' type='text' /></td>
						 		</tr>
						 		<tr>
							 		<td>Comment:</td>
							 		<td>&nbsp;</td>
							 		<td>&nbsp;</td>
							 		<td>&nbsp;</td>
							 		
						 		</tr>
						 		<tr>
						 			<td>&nbsp;</td>
									<th colspan='3'><textarea class="input" id='comment' name='comment' rows='8' cols='55' ></textarea></th>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><input class="input" type='submit' /></td>
									<td>&nbsp;</td>
								</tr>
							</form>
							</table>
						</tbody>
				</div>
<?php		
				}
				else if(!valid())
				{
						// HERE IS ERROR MESSAGE
				}
				else if(valid())
				{
						// HERE IS CONFURM MESSASGE
				}		
			}
			
?>
			</div>
			<div id="footer">
			
			</div>
		</div>
	</div>
</body>
</html>
