<!-- Modal -->
<div id="userModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-blue-900">
                Ajouter un utilisateur
            </h2>

            <button onclick="closeModal()" 
                class="text-gray-500 hover:text-red-500 text-2xl font-bold">
                &times;
            </button>
        </div>

        <!-- Form -->
        <form action="admin/functions.php" method="POST" class="space-y-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <div>
                    <label class="block text-sm font-semibold text-blue-900 mb-1">
                        First name
                    </label>
                    <input type="text" name="firstname"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-blue-900 mb-1">
                        Last name
                    </label>
                    <input type="text" name="lastname"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

            </div>

            <div>
                <label class="block text-sm font-semibold text-blue-900 mb-1">
                    Email
                </label>
                <input type="email" name="email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>

            <div>
                <label class="block text-sm font-semibold text-blue-900 mb-1">
                    Password
                </label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>

            <div>
                <label class="block text-sm font-semibold text-blue-900 mb-1">
                    Role
                </label>
                <select name="role_id"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="">Select role</option>
                    <option value="1">Admin</option>
                    <option value="2">Teacher</option>
                    <option value="3">Student</option>
                </select>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="button" onclick="closeModal()"
                    class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                    Cancel
                </button>

                <button type="submit" name="add-user"
                    class="px-5 py-2 rounded-lg bg-blue-900 text-white hover:bg-blue-800">
                    Add user
                </button>
            </div>

        </form>
    </div>
</div>

<script>
function openModal() {
    const modal = document.getElementById("userModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function closeModal() {
    const modal = document.getElementById("userModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
}
</script>