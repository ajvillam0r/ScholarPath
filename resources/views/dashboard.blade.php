<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarPath Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .shadow-50 {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }
    </style>
    <script>
        function toggleGPAField() {
            const scholarshipType = document.getElementById('scholarshipType').value;
            const gpaField = document.getElementById('gpaField');
            const categoryField = document.getElementById('categoryField');
            if (scholarshipType === 'Academic Scholars') {
                gpaField.classList.remove('hidden');
                categoryField.classList.remove('hidden');
            } else {
                gpaField.classList.add('hidden');
                categoryField.classList.add('hidden');
            }
        }

        function setCategory() {
            const gpa = parseFloat(document.getElementById('gpa').value);
            const category = document.getElementById('category');
            if (gpa >= 98 && gpa <= 100) {
                category.value = 'Category 1';
            } else if (gpa >= 95 && gpa <= 97) {
                category.value = 'Category 2';
            } else if (gpa >= 90 && gpa <= 94) {
                category.value = 'Category 3';
            } else {
                category.value = '';
            }
        }

        function validateForm(event) {
            const scholarshipType = document.getElementById('scholarshipType').value;
            const studentId = document.getElementById('studentId').value.trim();
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const course = document.getElementById('course').value.trim();
            const yearLevel = document.getElementById('yearLevel').value.trim();
            const gpa = parseFloat(document.getElementById('gpa').value);

            if (!studentId || !firstName || !lastName || !course || !yearLevel || (scholarshipType === 'Academic Scholars' && !gpa)) {
                alert('Please fill in all required fields.');
                event.preventDefault();
                return;
            }

            if (scholarshipType === 'Academic Scholars' && gpa < 90) {
                alert('GPA must be 90 or above for Academic Scholars.');
                event.preventDefault();
            }
        }

        function openModal() {
            document.getElementById('scholarModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('scholarModal').classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-blue-600 text-white p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">ScholarPath Dashboard</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="#" class="hover:underline">Home</a></li>
                    <li><a href="#" onclick="openModal()" class="hover:underline">Manage Scholarships</a></li>
                    <li><a href="#" class="hover:underline">Profile</a></li>
                    <li><a href="#" class="hover:underline">Logout</a></li>
                </ul>                
            </nav>
        </header>

        <!-- Main Form Section -->
        <div class="p-6 max-w-4xl mx-auto mt-10 bg-white rounded-lg shadow-50">
            <h2 class="text-2xl font-bold mb-6">Scholar Details</h2>
            <form onsubmit="validateForm(event)">
                <div class="mb-4">
                    <label for="scholarshipType" class="block text-sm font-medium text-gray-700">Select Scholarship Type</label>
                    <select id="scholarshipType" name="scholarshipType" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50" onchange="toggleGPAField()">
                        <option>Select Scholarship Type</option>
                        <option>Academic Scholars</option>
                        <option>Presidential Scholars</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="mb-4">
                            <label for="studentId" class="block text-sm font-medium text-gray-700">Student ID</label>
                            <input type="text" id="studentId" name="studentId" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50">
                        </div>
                        <div class="mb-4">
                            <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" id="lastName" name="lastName" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50">
                        </div>
                        <div class="mb-4">
                            <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50">
                        </div>
                        <div class="mb-4">
                            <label for="middleName" class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" id="middleName" name="middleName" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50">
                        </div>
                    </div>
                    <div>
                        <div class="mb-4">
                            <label for="course" class="block text-sm font-medium text-gray-700">Course</label>
                            <input type="text" id="course" name="course" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50">
                        </div>
                        <div class="mb-4">
                            <label for="yearLevel" class="block text-sm font-medium text-gray-700">Year Level</label>
                            <input type="number" id="yearLevel" name="yearLevel" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50">
                        </div>
                        <div id="gpaField" class="mb-4 hidden">
                            <label for="gpa" class="block text-sm font-medium text-gray-700">GPA</label>
                            <input type="number" step="0.01" id="gpa" name="gpa" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50" oninput="setCategory()">
                        </div>
                        <div id="categoryField" class="mb-4 hidden">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <input type="text" id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50" readonly>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Add Scholar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Popup Modal -->
        <div id="scholarModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-4xl relative">
                <div class="flex justify-between items-center border-b pb-2 mb-4">
                    <h2 class="text-xl font-bold">Scholar Details</h2>
                    <button onclick="closeModal()" class="text-red-500 text-lg font-bold">&times;</button>
                </div>
                <div id="scholarContent" class="overflow-auto max-h-96">
                    <p>Loading...</p>
                </div>
                <div class="flex justify-end pt-4">
                    <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Close
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-blue-600 text-white p-4 text-center">
            <p>&copy; 2024 ScholarPath. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
