<?php

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

include("../includes/connection.php");
include("../student/functions.php"); 

$userId = $_SESSION['userid'];


$user = getUserProfile($conn, $userId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f8fafc]">

<div class=" md:p-10 max-w-3xl mx-auto">
  

    <div class="relative overflow-hidden bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100">
        
        <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-700"></div>

        <div class="px-8 pb-8">
            <div class="relative flex justify-between items-end -mt-12 mb-8">
                <div class="p-1.5 bg-white rounded-full shadow-lg">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-blue-500 to-blue-400 border-4 border-white flex items-center justify-center text-white text-3xl font-bold">
                        <?= strtoupper(substr($user['firstname'], 0, 1)); ?>
                    </div>
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-all active:scale-95 shadow-md shadow-blue-200">
                    Edit Profile
                </button>
            </div>

            <div class="mb-10">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?>
                </h2>
                <p class="text-blue-600 font-medium flex items-center gap-1 mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <?= htmlspecialchars($user['class_name'] ?? 'Non assignée'); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-100 pt-8">
                
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Prénom</label>
                    <div class="text-gray-700 font-medium bg-gray-50 px-4 py-3 rounded-xl border border-gray-100">
                        <?= htmlspecialchars($user['firstname']); ?>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nom</label>
                    <div class="text-gray-700 font-medium bg-gray-50 px-4 py-3 rounded-xl border border-gray-100">
                        <?= htmlspecialchars($user['lastname']); ?>
                    </div>
                </div>

                <div class="space-y-1 md:col-span-2">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Email Professionnel</label>
                    <div class="flex items-center gap-3 text-gray-700 font-medium bg-gray-50 px-4 py-3 rounded-xl border border-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <?= htmlspecialchars($user['email']); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>