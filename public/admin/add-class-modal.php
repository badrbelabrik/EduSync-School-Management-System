<!-- Modal -->
<div id="classModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-blue-900">
                Add a class
            </h2>

            <button onclick="closeAddModal()" 
                class="text-gray-500 hover:text-red-500 text-2xl font-bold">
                &times;
            </button>
        </div>

        <!-- Form -->
        <form action="../scripts/authprocess.php" method="POST" class="space-y-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <div>
                    <label class="block text-sm font-semibold text-blue-900 mb-1">
                        Class name
                    </label>
                    <input type="text" name="classname"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-blue-900 mb-1">
                        Classroom number
                    </label>
                    <input type="number" name="classroom_number"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

            </div>


            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="button" onclick="closeAddModal()"
                    class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                    Cancel
                </button>

                <button type="submit" name="add-class"
                    class="px-5 py-2 rounded-lg bg-blue-900 text-white hover:bg-blue-800">
                    Add class
                </button>
            </div>

        </form>
    </div>
</div>

<script>
function openAddModal() {
    const modal = document.getElementById("classModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function closeAddModal() {
    const modal = document.getElementById("classModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
}
</script>