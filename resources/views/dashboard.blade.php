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
        .hidden-div {
            display: none;
            height: 2.5rem; /* Adjust the height to match the height of the text */
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
            return;
        }

        // Show success popup
        document.getElementById('successPopup').classList.remove('hidden');
        setTimeout(() => {
            document.getElementById('successPopup').classList.add('hidden');
        }, 2000); // Hide after 2 seconds
    }

    function openModal() {
        document.getElementById('scholarModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('scholarModal').classList.add('hidden');
    }
</script>

<!-- Success Popup -->
<div id="successPopup" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-50 w-1/3 text-center">
        <p class="text-green-600 font-bold">Added Successfully!</p>
    </div>
</div>

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
                    <li>
                        <!-- Logout Link -->
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:underline">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Welcome Message (Hidden Div) -->
        <div class="hidden-div"></div>
        <div class="p-6 max-w-4xl mx-auto mt-10 bg-white rounded-lg shadow-50">
            <h2 class="text-2xl font-bold mb-6">Welcome, {{ Str::before(Auth::user()->name, ' ') }}!</h2>
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
                    </div>
                </div>

                <button type="submit" class="mt-4 w-full py-2 px-4 bg-blue-600 text-white font-bold rounded-md">Submit</button>
            </form>
        </div>

        <!-- Modal for Managing Scholarships -->
        <div id="scholarModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg w-1/3 shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Manage Scholarships</h3>
                <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-700">×</button>
                <!-- Modal content -->
                <p>Scholarship Management Options Here...</p>
            </div>
        </div>
    </div>
</body>
</html>
