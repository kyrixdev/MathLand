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
            <a href="?Devoir"><li class="class">Gérer les devoirs</li></a>

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
        <th class="border px-3 py-1.5 border-rose-400 ...">Niveau</th>
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
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["level"]; ?></td>
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
    
    <!-- Ajout cours modal -->
            <div class="">
                <h3 class="text-lg font-bold">Ajouter un cour</h3>
                <br>
                <!-- The data encoding type, enctype, MUST be specified as below -->
                <form enctype="multipart/form-data" method="POST">
                    <label for="classes">Choissesez la class</label>  
                    <select name="class_select">
                        <option value="7EM">7 ème année</option>
                        <option value="8EM">8 ème année</option>
                        <option value="9EM">9 ème année</option>
                        <option value="">---- Lycee ----</option>
                        <option value="1ER">1ère année</option>
                        <option value="2ECO">2ème année Economie et services</option>
                        <option value="2SC">2ème année Sciences</option> 
                        <option value="2SI">2ème année Technologie de l'informatique</option> 
                        <option value="3ECO">3ème année Economie et Gestion</option> 
                        <option value="3MA">3ème année Mathématiques</option> 
                        <option value="3SC">3ème année Sc.Exprémentales</option> 
                        <option value="3SI">3ème année Sc.Informatique</option> 
                        <option value="3TE">3ème année Sc.Technique</option> 
                        <option value="4ECO">4ème année Economie et Gestion</option> 
                        <option value="4MA">4ème année Mathématiques</option> 
                        <option value="4SC">4ème année Sc.Exprémentales</option> 
                        <option value="4SI">4ème année Sc.Informatique</option> 
                        <option value="4TE">4ème année Sc.Technique</option> 
                    </select>
                    <br>

                    <!-- Name of input element determines name in $_FILES array -->
                    <input name="cours_file" type="file" /> 
                    <br>
                    <input type="submit" name="cours_upload" class="submit_btn" value="Ajouter une fichier" />  
                </form>

                <?php
                if (isset($_POST['cours_upload'])) {
                    echo "<p>" . $_POST['cours_file'] . " => file input successfull</p>";
                    $target_dir = "uploads/";   // Directory where the file is going to be placed
                    $file_name = $_FILES['cours_file']['name'];     // The file name
                    $file_tmp = $_FILES['cours_file']['tmp_name'];      // File in the PHP tmp folder      
                    $date = date("Y-m-d H:i:s");    
                    $class = $_POST['class_select'];                  
                    if (move_uploaded_file($file_tmp, $target_dir . $file_name)) {          // Checks that file has been moved
                        $query = "INSERT INTO `courses` (`name`, `class`, `date`) VALUES ( '$file_name', '$class', '$date')";
                        if ($connection->query  ($query) === TRUE) {
                            header('location: rooter.php?Cours&success');
                        } else {
                            echo "Error: " . $query . "<br>" . $connection->error;
                        }       
                    } else {    // If file was not moved.
                        echo "no";
                    }
                }
                ?>
            </div>

    <table class="border-collapse border border-spacing-2 ...">
    <thead>
        <tr>
        <th class="border px-3 py-1.5 border-rose-400 ...">id</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Nom du fichier</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Class</th>
        <th class="border px-3 py-1.5 border-rose-400 ..."></th>

        </tr>
    </thead>
    <tbody>
        <?php 
           //search
           $sql = "SELECT * FROM courses";
           $result = mysqli_query($connection, $sql) or die("Failed to query database ".mysqli_error($connection));
           //compare
           if (mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["id"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["name"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["class"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ...">
            <a href="uploads/<?php echo $row["name"]; ?>" download="<?php echo $row["name"]; ?>" class="text-white bg-blue-500 hover:bg-blue-700 rounded px-2 py-1">Télécharger</a>
        <td class="border px-3 py-1.5 border-rose-400 ...">
        <a href='?Cours&delete=<?php echo $row["id"]; ?>' class="text-amber-300">Supprimer</a>    
            <?php 
            if(isset($_GET['delete'])) {
                $id = $_GET["delete"];
                $sql = "DELETE FROM courses WHERE id=$id";
                if ($connection->query ($sql) === TRUE) {
                    header("Location: rooter.php?Cours&delete=success");
                } else {
                    echo "Error deleting record: " . $connection->error;
                }
            }
            ?>
        </td>
        </tr>
        <?php 
            }
            } else {
                echo "0 results";
            }
            if(isset($_GET['success'])) {
                echo "<p class='text-green-500 font-bold my-5'>Fichier ajouté avec succès</p>";
            }
            if(isset($_GET['delete']) && $_GET['delete'] == "success") {
                echo "<p class='text-red-500 font-bold my-5'>Suppression réussie</p>";
            }
        ?>
    </tbody>
    </table>
    <?php } //Users list ?>


        <!-- Exercices Part -->
        <?php 
        if(isset($_GET['Exercices'])){

    ?>
    
    <!-- Ajout cours modal -->
            <div class="">
                <h3 class="text-lg font-bold">Ajouter un exercice</h3>
                <br>
                <!-- The data encoding type, enctype, MUST be specified as below -->
                <form enctype="multipart/form-data" method="POST">
                    <label for="classes">Choissesez la class</label>  
                    <select name="exercice_select">
                        <option value="7EM">7 ème année</option>
                        <option value="8EM">8 ème année</option>
                        <option value="9EM">9 ème année</option>
                        <option value="">---- Lycee ----</option>
                        <option value="1ER">1ère année</option>
                        <option value="2ECO">2ème année Economie et services</option>
                        <option value="2SC">2ème année Sciences</option> 
                        <option value="2SI">2ème année Technologie de l'informatique</option> 
                        <option value="3ECO">3ème année Economie et Gestion</option> 
                        <option value="3MA">3ème année Mathématiques</option> 
                        <option value="3SC">3ème année Sc.Exprémentales</option> 
                        <option value="3SI">3ème année Sc.Informatique</option> 
                        <option value="3TE">3ème année Sc.Technique</option> 
                        <option value="4ECO">4ème année Economie et Gestion</option> 
                        <option value="4MA">4ème année Mathématiques</option> 
                        <option value="4SC">4ème année Sc.Exprémentales</option> 
                        <option value="4SI">4ème année Sc.Informatique</option> 
                        <option value="4TE">4ème année Sc.Technique</option> 
                    </select>
                    <br>

                    <!-- Name of input element determines name in $_FILES array -->
                    <input name="exercice_file" type="file" /> 
                    <br>
                    <input type="submit" name="exercice_upload" class="submit_btn" value="Ajouter une fichier" />  
                </form>

                <?php
                if (isset($_POST['exercice_upload'])) {
                    echo "<p>" . $_POST['exercice_file'] . " => file input successfull</p>";
                    $target_dir = "uploads/";   // Directory where the file is going to be placed
                    $file_name = $_FILES['exercice_file']['name'];     // The file name
                    $file_tmp = $_FILES['exercice_file']['tmp_name'];      // File in the PHP tmp folder      
                    $date = date("Y-m-d H:i:s");    
                    $class = $_POST['exercice_select'];                  
                    if (move_uploaded_file($file_tmp, $target_dir . $file_name)) {          // Checks that file has been moved
                        $query = "INSERT INTO `Exercices` (`name`, `class`, `date`) VALUES ( '$file_name', '$class', '$date')";
                        if ($connection->query  ($query) === TRUE) {
                            header('location: rooter.php?Exercices&success');
                        } else {
                            echo "Error: " . $query . "<br>" . $connection->error;
                        }       
                    } else {    // If file was not moved.
                        echo "no";
                    }
                }
                ?>
            </div>

    <table class="border-collapse border border-spacing-2 ...">
    <thead>
        <tr>
        <th class="border px-3 py-1.5 border-rose-400 ...">id</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Nom du fichier</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Class</th>
        <th class="border px-3 py-1.5 border-rose-400 ..."></th>

        </tr>
    </thead>
    <tbody>
        <?php 
           //search
           $sql = "SELECT * FROM Exercices";
           $result = mysqli_query($connection, $sql) or die("Failed to query database ".mysqli_error($connection));
           //compare
           if (mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["id"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["name"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["class"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ...">
            <a href="uploads/<?php echo $row["name"]; ?>" download="<?php echo $row["name"]; ?>" class="text-white bg-blue-500 hover:bg-blue-700 rounded px-2 py-1">Télécharger</a>
        <td class="border px-3 py-1.5 border-rose-400 ...">
        <a href='?Cours&delete=<?php echo $row["id"]; ?>' class="text-amber-300">Supprimer</a>    
            <?php 
            if(isset($_GET['delete'])) {
                $id = $_GET["delete"];
                $sql = "DELETE FROM courses WHERE id=$id";
                if ($connection->query ($sql) === TRUE) {
                    header("Location: rooter.php?Cours&delete=success");
                } else {
                    echo "Error deleting record: " . $connection->error;
                }
            }
            ?>
        </td>
        </tr>
        <?php 
            }
            } else {
                echo "0 results";
            }
            if(isset($_GET['success'])) {
                echo "<p class='text-green-500 font-bold my-5'>Fichier ajouté avec succès</p>";
            }
            if(isset($_GET['delete']) && $_GET['delete'] == "success") {
                echo "<p class='text-red-500 font-bold my-5'>Suppression réussie</p>";
            }
        ?>
    </tbody>
    </table>
    <?php } //Users list ?>

       <!-- Devoirs Part -->
       <?php 
        if(isset($_GET['Devoir'])){

    ?>
    
    <!-- Ajout cours modal -->
            <div class="">
                <h3 class="text-lg font-bold">Ajouter un devoir</h3>
                <br>
                <!-- The data encoding type, enctype, MUST be specified as below -->
                <form enctype="multipart/form-data" method="POST">
                    <label for="classes">Choissesez la class</label>  
                    <select name="devoir_select">
                        <option value="7EM">7 ème année</option>
                        <option value="8EM">8 ème année</option>
                        <option value="9EM">9 ème année</option>
                        <option value="">---- Lycee ----</option>
                        <option value="1ER">1ère année</option>
                        <option value="2ECO">2ème année Economie et services</option>
                        <option value="2SC">2ème année Sciences</option> 
                        <option value="2SI">2ème année Technologie de l'informatique</option> 
                        <option value="3ECO">3ème année Economie et Gestion</option> 
                        <option value="3MA">3ème année Mathématiques</option> 
                        <option value="3SC">3ème année Sc.Exprémentales</option> 
                        <option value="3SI">3ème année Sc.Informatique</option> 
                        <option value="3TE">3ème année Sc.Technique</option> 
                        <option value="4ECO">4ème année Economie et Gestion</option> 
                        <option value="4MA">4ème année Mathématiques</option> 
                        <option value="4SC">4ème année Sc.Exprémentales</option> 
                        <option value="4SI">4ème année Sc.Informatique</option> 
                        <option value="4TE">4ème année Sc.Technique</option> 
                    </select>
                    <br>

                    <!-- Name of input element determines name in $_FILES array -->
                    <input name="devoir_file" type="file" /> 
                    <br>
                    <input type="submit" name="devoir_upload" class="submit_btn" value="Ajouter une fichier" />  
                </form>

                <?php
                if (isset($_POST['devoir_upload'])) {
                    echo "<p>" . $_POST['devoir_file'] . " => file input successfull</p>";
                    $target_dir = "uploads/";   // Directory where the file is going to be placed
                    $file_name = $_FILES['exercice_file']['name'];     // The file name
                    $file_tmp = $_FILES['exercice_file']['tmp_name'];      // File in the PHP tmp folder      
                    $date = date("Y-m-d H:i:s");    
                    $class = $_POST['exercice_select'];                  
                    if (move_uploaded_file($file_tmp, $target_dir . $file_name)) {          // Checks that file has been moved
                        $query = "INSERT INTO `Devoirs` (`name`, `class`, `date`) VALUES ( '$file_name', '$class', '$date')";
                        if ($connection->query  ($query) === TRUE) {
                            header('location: rooter.php?Devoirs&success');
                        } else {
                            echo "Error: " . $query . "<br>" . $connection->error;
                        }       
                    } else {    // If file was not moved.
                        echo "no";
                    }
                }
                ?>
            </div>

    <table class="border-collapse border border-spacing-2 ...">
    <thead>
        <tr>
        <th class="border px-3 py-1.5 border-rose-400 ...">id</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Nom du fichier</th>
        <th class="border px-3 py-1.5 border-rose-400 ...">Class</th>
        <th class="border px-3 py-1.5 border-rose-400 ..."></th>

        </tr>
    </thead>
    <tbody>
        <?php 
           //search
           $sql = "SELECT * FROM Exercices";
           $result = mysqli_query($connection, $sql) or die("Failed to query database ".mysqli_error($connection));
           //compare
           if (mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["id"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["name"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ..."><?php echo $row["class"]; ?></td>
        <td class="border px-3 py-1.5 border-rose-400 ...">
            <a href="uploads/<?php echo $row["name"]; ?>" download="<?php echo $row["name"]; ?>" class="text-white bg-blue-500 hover:bg-blue-700 rounded px-2 py-1">Télécharger</a>
        <td class="border px-3 py-1.5 border-rose-400 ...">
        <a href='?Cours&delete=<?php echo $row["id"]; ?>' class="text-amber-300">Supprimer</a>    
            <?php 
            if(isset($_GET['delete'])) {
                $id = $_GET["delete"];
                $sql = "DELETE FROM courses WHERE id=$id";
                if ($connection->query ($sql) === TRUE) {
                    header("Location: rooter.php?Cours&delete=success");
                } else {
                    echo "Error deleting record: " . $connection->error;
                }
            }
            ?>
        </td>
        </tr>
        <?php 
            }
            } else {
                echo "0 results";
            }
            if(isset($_GET['success'])) {
                echo "<p class='text-green-500 font-bold my-5'>Fichier ajouté avec succès</p>";
            }
            if(isset($_GET['delete']) && $_GET['delete'] == "success") {
                echo "<p class='text-red-500 font-bold my-5'>Suppression réussie</p>";
            }
        ?>
    </tbody>
    </table>
    <?php } //Users list ?>


    </main>
</div>