
<header class="bg-blue-900 text-white px-8 py-5 flex justify-end items-center">
    <div class="flex items-center gap-4">
        <span>
            <?= htmlspecialchars($_SESSION['firstname'] ?? 'student'); ?>
        </span>

        <a href="../scripts/logout.php" class="bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700">
            Logout
        </a>
    </div>
</header>