<?php 
    session_start();
    include("connect.php");
    include_once("controllers/header.php");
        //Login part 
      if (!isset($_SESSION['AdminLoggedIn']))   // Checking whether the session is already there or not if 
        // true then header redirect it to the home page directly 
      {
      header("Location:rooterLogin.php"); 
      } 
      $id = $_SESSION['AdminId'];
      $username = $_SESSION['AdminUser'];
?>
    <header class="my-4 flex flex-row ">
        <div class="w-64 text-center p-5 mt-1">
            <a href="logout.php" class="btn logout-btn"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
        <div class="logo text-center">MATH<span>LAND</span></div>
        <div class="Account-menu w-64 m-4">
            <div class="flex flex-col">
                <div class="mb-1">
                <i class="far fa-user-circle text-xl"></i>
                <?php 
                  //search
                $sql = "SELECT * FROM admin WHERE username = '$username' AND id = '$id'";
                $result = mysqli_query($connection, $sql) or die("Failed to query database ".mysqli_error($connection));
                //compare
                $row = mysqli_fetch_array($result);
                if (($row['username'] == $username) && ($row['id'] == $id)){
                    echo $row['username'];
                }
                ?>
                </div>
                <div>
                <a class="btn logout-btn text-sm" href="home.php">
                RETOUR A L'ACCUEIL
                </a>
                </div>
            </div>
        </div>
        </header>


<div class="flex flex-row">
    <aside class="flex-1 w-1/4">
        <h3>Menu Administrateur</h3>
        <ul>
            <a href="?Users"><li class="class">Liste des utilisateurs</li></a>
            <a href="?Cours"><li class="class">Gérer les cours</li></a>
            <a href="?Exercices"><li class="class">Gérer les exercices</li></a>
        </ul>
    </aside>
    <main class="mainclass flex-2 w-3/4">
    <?php 
        if(isset($_GET['Users'])){

    ?>
    <div class="my-4">
    <button class="my-4 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700" onclick="toggleModal('addadmin')">Ajouter un Admin</button>
        
        <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="addadmin">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-900 opacity-75" />
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-black px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <label>Ajouter un admin</label>

                <form name="add_admin" method="post">
                    <label for="username">Pseudo</label>
                    <input type="text" name="username" class="w-full bg-gray-900 w-32 p-2 mt-2 mb-3" />
                    <label for="username">Mot de passe</label>
                    <input type="text" name="password" class="w-full bg-gray-900 w-32 p-2 mt-2 mb-3" />
                <input type="submit" class="btn btn-info" name="add_admin" value="submit" >
                </form>
                <?php
                if (isset($_POST['add_admin']))
                { 
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $query = "INSERT INTO `admin`(`username`, `password`) VALUES ('$username','$password')";
                    if ($connection->query($query) === TRUE) {
                        header('location: rooter.php?Users');
                    } else {
                        echo "Error: " . $query . "<br>" . $connection->error;
                    }
                }
                ?>
            </div>
            <div class="bg-black px-4 py-3 text-right">
                <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal('addadmin')"><i class="fas fa-times"></i> Cancel</button>
            </div>
            </div>
        </div>
        </div>
    </div>

    <table class="border-collapse border border-spacing-2 ...">
    <thead>
        <tr>
        <th class="border px-3 py-1.5 border-rose-400 ...">id</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Nom & Prenom</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Email</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">n telephone</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">balance</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Membre</th>
        <th class="border px-3 py-1.5 border-rose-400 ..."></th>

        </tr>
    </thead>
    <tbody>
        <?php 
           //search
           $sql = "SELECT * FROM users";
           $result = mysqli_query($connection, $sql) or die("Failed to query database ".mysqli_error($connection));
           //compare
           if (mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["id"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["firstname"]." ".$row["lastname"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["email"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["mobilenumber"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["balance"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ...">
        <?php 
        if ($row["is_active"]== 1){
            echo "Oui";
        }
        else{
            echo "Non";
        }
         ?>
        </td>
        <td class="border px-3 py-1.5 border-rose-400 ...">
        <button class="py-2 px-4 bg-yellow-500 text-white rounded hover:bg-yellow-700" onclick="toggleModal('manage')">Gérer</button>
        
        <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="manage">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-900 opacity-75" />
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-black px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <label>Ajouter un solde</label>

                <form name="add_balance" method="post">
                <input type="text" name="amount" class="w-full bg-gray-900 w-32 p-2 mt-2 mb-3" />
                <input type="submit" class="btn btn-info" name="addbalance" value="submit" >
                </form>
                <?php
                $id = $row["id"];
                if (isset($_POST['addbalance']))
                { 
                    $amount = $_POST['amount'];
                    $query = "UPDATE `users` SET balance = '$amount' WHERE id = '$id'";
                    if ($connection->query($query) === TRUE) {
                        header('location: rooter.php?Users');
                    } else {
                        echo "Error: " . $query . "<br>" . $connection->error;
                    }
                }
                ?>
            </div>
            <div class="bg-black px-4 py-3 text-right">
                <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal('manage')"><i class="fas fa-times"></i> Cancel</button>
            </div>
            </div>
        </div>
        </div>

        </td>
        </tr>
        <?php 
            }
            } else {
                echo "0 results";
            }
        ?>
    </tbody>
    </table>
    <?php } //Users list ?>


    <!-- Coues Part -->
    <?php 
        if(isset($_GET['Cours'])){

    ?>
    <div class="my-4">
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-4 rounded-full" onclick="toggleModal('CourAjout')">Ajouter un cours</button>
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-4 rounded-full">Lister les cours</button>
    </div>
    
    <!-- Ajout cours modal -->
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="CourAjout">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-900 opacity-75" />
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-black px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <label>Ajouter un cour</label>

                <form name="add_file" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" class="btn btn-info" value="Upload file" name="submit">
                </form>
                <?php
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                  if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                  } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                  }
                }
                ?>
            </div>
            <div class="bg-black px-4 py-3 text-right">
                <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal('CourAjout')"><i class="fas fa-times"></i> Cancel</button>
            </div>
            </div>
        </div>
        </div>
    </div>

    <table class="border-collapse border border-spacing-2 ...">
    <thead>
        <tr>
        <th class="border px-3 py-1.5 border-rose-400 ...">id</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Nom & Prenom</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Email</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">n telephone</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">balance</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Membre</th>
        <th class="border px-3 py-1.5 border-rose-400 ..."></th>

        </tr>
    </thead>
    <tbody>
        <?php 
           //search
           $sql = "SELECT * FROM users";
           $result = mysqli_query($connection, $sql) or die("Failed to query database ".mysqli_error($connection));
           //compare
           if (mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["id"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["firstname"]." ".$row["lastname"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["email"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["mobilenumber"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["balance"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ...">
        <?php 
        if ($row["is_active"]== 1){
            echo "Oui";
        }
        else{
            echo "Non";
        }
         ?>
        </td>
        <td class="border px-3 py-1.5 border-rose-400 ...">
        <a href="#" class="text-amber-300">Gérer</a>
        </td>
        </tr>
        <?php 
            }
            } else {
                echo "0 results";
            }
        ?>
    </tbody>
    </table>
    <?php } //Users list ?>

    </main>
</div>