<?php
// Had l-logic ghir bach n-detectiw l-page l-current o n-baynouha "Active"
$current_page = $_GET['page'] ?? 'users';
?>

<aside class="w-72 bg-gradient-to-b from-blue-900 via-blue-900 to-indigo-950 text-white p-6 min-h-screen shadow-2xl flex flex-col">

    <div class="flex items-center gap-3 px-4 mb-12">
        <div class="bg-white/10 p-2 rounded-xl backdrop-blur-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            </svg>
        </div>
        <h1 class="text-2xl font-extrabold tracking-tight italic">Edu<span class="text-blue-400">Sync</span></h1>
    </div>

    <nav class="space-y-2 flex-1">
        <p class="px-4 text-xs font-semibold text-blue-300/50 uppercase tracking-widest mb-4">Main Menu</p>

        <a href="dashboard-admin.php?page=users" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group <?= $current_page == 'users' ? 'bg-blue-600 shadow-lg shadow-blue-900/50' : 'hover:bg-white/5 text-blue-100/80 hover:text-white' ?>">
            <span class="<?= $current_page == 'users' ? 'text-white' : 'text-blue-400 group-hover:scale-110' ?> transition-transform">👤</span>
            <span class="font-medium">Users Management</span>
        </a>

        <a href="dashboard-admin.php?page=classes" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group <?= $current_page == 'classes' ? 'bg-blue-600 shadow-lg shadow-blue-900/50' : 'hover:bg-white/5 text-blue-100/80 hover:text-white' ?>">
            <span class="<?= $current_page == 'classes' ? 'text-white' : 'text-blue-400 group-hover:scale-110' ?> transition-transform">🏫</span>
            <span class="font-medium">Classes</span>
        </a>

        <a href="dashboard-admin.php?page=courses" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group <?= $current_page == 'courses' ? 'bg-blue-600 shadow-lg shadow-blue-900/50' : 'hover:bg-white/5 text-blue-100/80 hover:text-white' ?>">
            <span class="<?= $current_page == 'courses' ? 'text-white' : 'text-blue-400 group-hover:scale-110' ?> transition-transform">📚</span>
            <span class="font-medium">Courses</span>
        </a>

        <a href="dashboard-admin.php?page=enrollments" 
           class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group <?= $current_page == 'enrollments' ? 'bg-blue-600 shadow-lg shadow-blue-900/50' : 'hover:bg-white/5 text-blue-100/80 hover:text-white' ?>">
            <span class="<?= $current_page == 'enrollments' ? 'text-white' : 'text-blue-400 group-hover:scale-110' ?> transition-transform">📝</span>
            <span class="font-medium">Enrollments</span>
        </a>

        <div class="pt-6">
            <p class="px-4 text-xs font-semibold text-blue-300/50 uppercase tracking-widest mb-4">Reports</p>
            <a href="dashboard-admin.php?page=stats" 
               class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group <?= $current_page == 'stats' ? 'bg-blue-600 shadow-lg shadow-blue-900/50' : 'hover:bg-white/5 text-blue-100/80 hover:text-white' ?>">
                <span class="<?= $current_page == 'stats' ? 'text-white' : 'text-blue-400 group-hover:scale-110' ?> transition-transform">📊</span>
                <span class="font-medium">Statistics</span>
            </a>
        </div>
    </nav>

  

</aside>