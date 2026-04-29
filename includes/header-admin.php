<header class="bg-white/80 backdrop-blur-md border-b border-gray-100 px-8 py-4 flex justify-between items-center sticky top-0 z-40">
    <div>
        <h2 class="text-sm font-medium text-gray-400 uppercase tracking-widest">Dashboard Panel</h2>
    </div>

    <div class="flex items-center gap-6">
        <div class="flex items-center gap-3 border-r border-gray-200 pr-6">
            <div class="text-right">
                <p class="text-sm font-bold text-gray-800 leading-none">
                    <?= htmlspecialchars($_SESSION['firstname'] ?? 'Admin'); ?>
                </p>
                <span class="text-[10px] font-semibold text-green-500 uppercase tracking-tighter">Online</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-100 to-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 font-bold shadow-sm">
                <?= strtoupper(substr($_SESSION['firstname'] ?? 'A', 0, 1)); ?>
            </div>
        </div>

        <a href="../scripts/logout.php" class="flex items-center gap-2 text-gray-500 hover:text-red-600 font-semibold text-sm transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-red-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Logout
        </a>
    </div>
</header>