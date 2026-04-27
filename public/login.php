<?php 
session_start();
if(isset($_SESSION["username"])){
  header("location: ./dashboard.php");
}
include '../includes/header.php';
?>

<div class="flex min-h-full flex-col justify-center items-center px-6 py-12 lg:px-8">
  <?php 
  if(isset($_GET["message"])){
    if($_GET["message"] == "registersuccess"){
      echo '<p class="text-green-400">You have successfully registered,you can login now</p>';
    }  
  }
  ?>
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="../scripts/authprocess.php" method="POST" name="login" class="space-y-6">
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input id="email" type="email" name="email" required autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 -outline-offset-1 border border-gray-400 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
          <div class="text-sm">
            <a href="#" class="font-semibold text-blue-600 hover:text-blue-300">Forgot password?</a>
          </div>
        </div>
        <div class="mt-2">
          <input id="password" type="password" name="password" required placeholder="••••••••" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 -outline-offset-1 border border-gray-400 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
      </div>
      <?php 
        if(isset($_GET["error"])){
          if($_GET["error"] == "invalidcredentials"){
            echo "<p class='text-red-500'>Invalid credentials</p>";
          }
        }
      ?>
      <div>
        <button type="submit" name="login" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm/6 text-gray-500">
      Don’t have an account yet?
      <a href="register.php" class="font-semibold text-blue-600 hover:text-blue-300">Sign up</a>
    </p>
  </div>
</div>
<?php include '../includes/footer.php'; ?>