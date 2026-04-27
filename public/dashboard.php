<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include '../includes/header.php'; ?>
<div class="min-h-screen flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-lg border-r">
    <div class="p-6 text-xl font-bold text-indigo-600">MySpace</div>

    <nav class="px-4 space-y-2">
      <a class="block p-3 rounded-xl bg-indigo-50 text-indigo-600 font-medium" href="#">Home</a>
      <a class="block p-3 rounded-xl hover:bg-gray-100" href="#">My Profile</a>
      <a class="block p-3 rounded-xl hover:bg-gray-100" href="#">My Orders</a>
      <a class="block p-3 rounded-xl hover:bg-gray-100" href="#">Messages</a>
      <a class="block p-3 rounded-xl hover:bg-gray-100" href="#">Settings</a>
    </nav>
  </aside>

  <!-- Main -->
  <main class="flex-1 p-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-semibold">Welcome Mr <?php echo $_SESSION["firstname"]." ".$_SESSION["lastname"]  ?></h1>

      <div class="flex items-center gap-4">
        <input class="border rounded-xl px-4 py-2" placeholder="Search...">
        <div class="w-10 h-10 bg-indigo-600 text-white flex items-center justify-center rounded-full">
          <form action="#" method="post">
             <button type="submit" name="chekout">Log out</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

      <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">My Orders</p>
        <h2 class="text-3xl font-bold">12</h2>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Pending</p>
        <h2 class="text-3xl font-bold">3</h2>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Messages</p>
        <h2 class="text-3xl font-bold">5</h2>
      </div>

    </div>

    <!-- Content -->
    <div class="bg-white rounded-2xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">My Recent Activity</h2>

      <ul class="space-y-4">
        <li class="border-l-4 border-indigo-500 pl-3">
          Logged in to account
        </li>
        <li class="border-l-4 border-green-500 pl-3">
          Ordered a product
        </li>
        <li class="border-l-4 border-yellow-500 pl-3">
          Updated profile
        </li>
      </ul>
    </div>

  </main>
</div>
<?php include("../includes/footer.php"); ?>

</body>
</html>