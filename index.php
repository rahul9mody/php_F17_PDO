<!DOCTYPE html>

<html>
<head>
	<title>pdo</title>
</head>
<body>


<?php

	session_start();

    $dsn = 'mysql:host=sql2.njit.edu;dbname=*****'; 
    $username = '*****';
    $password = '**********';

    try  
    {
        $db = new PDO($dsn, $username, $password);
        echo "<h1>Connected successfully<h1><br>";
    } 
    catch (PDOException $e) 
    {
        $error_message = $e->getMessage();
        
        exit();
    }
    
   $query = "SELECT * FROM todos"; 
   $statement = $db->prepare($query);
   $statement->execute();

   $products = $statement->fetchAll();
   $statement->closeCursor();

  ?>
  <h3>before for</h3>
  <?php foreach ($products as $product) { ?>
  <tr>
  	<td><?php echo $product['owneremail']; ?></td>
  </tr>
  <?php } ?>

  	<?php
  	$username  = "test@njit.edu";
	$query = "SELECT fname FROM accounts WHERE email= :username";
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$statement->execute();
	$results = $statement->fetchAll();
	$statement->closeCursor();

	$first; 
	foreach ($results as $result) 
	{
		$first = $result['fname'];
		print "<h1>Fname = $first </h1>";

	}

	$email = "mjlee@njit.edu";
	//$not = 0;
	$query = "SELECT * FROM todos WHERE owneremail= :email";
	$statement = $db->prepare($query);
	$statement->bindValue(':email', $email);
	//$statement->bindValue(':not', $not);
	$statement->execute();

	$results = $statement->fetchAll();
	$statement->closeCursor();

	

	//$results = $statement->fetchAll();
	//$statement->closeCursor();
	?>
	<?php foreach ($results as $result) { ?>
  <tr>
  	<td><?php echo $result['message']; ?></td>
  	<td><?php echo $result['duedate']; ?></td>
  	<td><?php echo $result['createddate']; ?></td>
  </tr>
  <?php } ?>

	?>


</body>
</html>
