<?php
    session_start();
    include("connect.php");
    include_once("controllers/header.php");
        //Login Part 
      if(isset($_SESSION['UserLoggedIn']))   // Checking whether the session is already there or not if 
        // true then header redirect it to the home page directly 
      {
      header("Location:home.php"); 
      }
      
?>
<div class="container-full">
<div class="flex flex-col lg:flex-row min-h-lg items-center justify-center px-4 sm:px-6 lg:px-8">
  <div class="w-full max-w-lg space-y-8">
    <div>
        <a href="index.html" class="logo text-center">MATH<span>LAND</span></a>
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-white">Connectez-vous à votre compte</h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Ou
        <a href="register.php" class="font-medium text-red hover:text-red-500">Créez votre compte</a>
      </p>
      <?php 
        if(isset($_GET['Error'])){
          echo "<p class='bg-red-400 text-center my-5 p-2 rounded-md font-semibold'> S'il vous plait verifier votre cordonners </p>";
        }
      ?>
    </div>
    <form class="mt-8 space-y-6" id="loginin" name="loginin" action="signin.php" method="post">
      <input type="hidden" name="remember" value="true">
      <div class="-space-y-px rounded-md shadow-sm">
        <div>
          <label for="email-address"> <i class="far fa-envelope"></i> Adresse E-mail</label>
          <input id="email-address" name="email" type="email" autocomplete="email" required class="my-5 relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 bg-black text-white placeholder-gray-500 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm" placeholder="Adresse Email">
        </div>
        <div>
          <label for="password"><i class="fas fa-key"></i> Mot de passe</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required class="my-5 relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 bg-black text-white placeholder-gray-500 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm" placeholder="Mot de passe">
        </div>
      </div>

      <div class="flex items-center justify-end">
        <div class="text-sm">
          <a href="#" class="font-medium text-right content-end	 text-red hover:text-red-500">Mot de passe oublié?</a>
        </div>
      </div>

      <div>
        <button type="submit" form="loginin" name="loginin" class="group relative flex w-full justify-center rounded-md border border-transparent bg-red-500 py-2 px-4 text-sm font-medium text-white hover:bg-transparent hover:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <!-- Heroicon name: mini/lock-closed -->
            <svg class="h-5 w-5 text-white group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
          </span>
          Sign in
        </button>
      </div>
    </form>
  </div>
  <div class="basis-1/2">
        <img src="assets/einch.png" class="mx-auto w-4/5 alt="einchtein">
  </div>
</div>
</div>
<?php
    include("controllers/footer.php");
?>