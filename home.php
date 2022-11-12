<?php 
    session_start();
    include("connect.php");
    include_once("controllers/header.php");
        //Login Part 
      if (!isset($_SESSION['UserLoggedIn']))   // Checking whether the session is already there or not if 
        // true then header redirect it to the home page directly 
      {
      header("Location:login.php"); 
      }
      $email = $_SESSION['email'];
      $id = $_SESSION['id'];
?>
    <header class="my-4 flex flex-row ">
        <div class="w-64 text-center p-5 mt-1">
            <a href="logout.php" class="btn logout-btn"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
        <div class="logo text-center">MATH<span>LAND</span></div>
        <div class="Account-menu w-64 m-4">
            <div class="flex flex-col">
                <div>
                <i class="far fa-user-circle text-xl"></i>
                <?php 
                  //search
                $sql = "SELECT * FROM users WHERE email = '$email' AND id = '$id'";
                $result = mysqli_query($connection, $sql) or die("Failed to query database ".mysqli_error($connection));
                //compare
                $row = mysqli_fetch_array($result);
                if (($row['email'] == $email) && ($row['id'] == $id)){
                    echo $row['firstname']." ".$row['lastname'];
                
                ?>
                </div>
                <div>
                <i class="fas fa-money-bill-wave"></i>
                <?php 
                    echo $row['balance'];
                }
                ?>
                </div>
                <div>
                <button class="text-white bg-red-500 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-1.5 text-center dark:bg-red-500 dark:hover:bg-red-500 dark:focus:ring-red-800" type="button">
                gérer votre compte
                </button>
                </div>
            </div>
        </div>
        </header>


<div class="flex flex-row">
    <aside class="flex-1 w-1/4">
        <h3>Choisissez Votre Classe</h3>
        <ul>
            <li class="class">1 ere année</li>
            <li class="class">2 eme année</li>
                <li class="branche">> Economique</li>
                <li class="branche">> Sc. Informqtiaue</li>
                <li class="branche">> Sc. Experimental</li>
            <li class="class">3 eme année</li>
                <li class="branche">> Economique</li>
                <li class="branche">> Sc. Informqtiaue</li>
                <li class="branche">> Sc. Experimental</li>
            <li class="class">4 eme année</li>
                <li class="branche">> Economique</li>
                <li class="branche">> Sc. Informqtiaue</li>
                <li class="branche">> Sc. Experimental</li>

        </ul>
    </aside>
    <main class="mainclass flex-2 w-3/4">
 test       
    </main>
</div>