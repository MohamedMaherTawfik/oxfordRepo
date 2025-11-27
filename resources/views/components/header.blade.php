<header class="bg-white shadow-sm" style="background-color: #e4ce96">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Search Bar -->
        <div class="flex items-center w-full max-w-md">
            <div class="relative w-full">
                <input type="text" placeholder="Search..."
                    class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>

        <!-- User Dropdown -->
        <div class="flex items-center ml-4">
            <div class="relative" id="userDropdown">
                <button id="dropdownButton" class="flex items-center focus:outline-none">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-8 h-8 rounded-full mr-2"
                        alt="User profile">
                    <span class="text-sm font-medium">Sarah Johnson</span>
                    <i class="fas fa-chevron-down ml-2 text-xs text-gray-500" id="dropdownArrow"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdownMenu"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden">
                    <ul>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownArrow = document.getElementById('dropdownArrow');

        // Toggle dropdown on button click
        dropdownButton.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
            dropdownArrow.classList.toggle('rotate-180');
        });

        // Keep dropdown open when clicking inside it
        dropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            dropdownMenu.classList.add('hidden');
            dropdownArrow.classList.remove('rotate-180');
        });
    });
</script>
