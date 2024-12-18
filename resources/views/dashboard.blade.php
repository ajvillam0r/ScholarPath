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
        /* Add scroll functionality for the modal */
#scholarModal .bg-white {
    max-height: 80vh; /* Ensure it does not exceed the viewport height */
    overflow-y: scroll; /* Enable vertical scrolling */
}

/* Hide scrollbar and scroll box for webkit browsers (Chrome, Safari) */
#scholarModal .bg-white::-webkit-scrollbar {
    width: 0px; /* Set width to 0 to hide the scrollbar */
    height: 0px; /* Set height to 0 if it's a horizontal scrollbar */
}

/* Hide scrollbar for Firefox */
#scholarModal .bg-white {
    scrollbar-width: none; /* For Firefox */
}

    </style>
</head>
<body class="bg-gray-100">
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Attach event listeners when the DOM content is fully loaded
        document.getElementById('scholarshipType').addEventListener('change', toggleGPAField);
        document.getElementById('gpa').addEventListener('input', setCategory);
        
        // Attach event listeners for table rows and edit buttons
        const rows = document.querySelectorAll('table tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', () => selectRow(row));
            const editButton = row.querySelector('.edit-button');
            if (editButton) {
                editButton.addEventListener('click', (event) => {
                    event.stopPropagation(); // Prevent row selection
                    editScholar(editButton);
                });
            }
        });
    });

    let selectedRow = null;

    function selectRow(row) {
        // Remove highlight and Edit button from the previous selection
        if (selectedRow) {
            selectedRow.classList.remove("bg-blue-100", "text-blue-700");
            const editButton = selectedRow.querySelector(".edit-button");
            if (editButton) editButton.classList.add("hidden");
        }

        // Highlight the selected row
        row.classList.add("bg-blue-100", "text-blue-700");
        selectedRow = row;

        // Show the Edit button in the Action column
        const editButton = row.querySelector(".edit-button");
        if (editButton) editButton.classList.remove("hidden");
    }

    function editScholar(button) {
        const row = button.closest("tr");

        document.getElementById("editSection").classList.remove("hidden");

        document.getElementById("editName").value = row.cells[1].textContent;
        document.getElementById("editCourse").value = row.cells[2].textContent;
        document.getElementById("editYearLevel").value = row.cells[3].textContent;
        document.getElementById("editScholarshipType").value = row.cells[4].textContent;
        document.getElementById("editGpa").value = row.cells[5].textContent;
        document.getElementById("editCategory").value = row.cells[6].textContent;
    }

    function saveChanges() {
        if (selectedRow) {
            selectedRow.cells[1].textContent = document.getElementById("editName").value;
            selectedRow.cells[2].textContent = document.getElementById("editCourse").value;
            selectedRow.cells[3].textContent = document.getElementById("editYearLevel").value;
            selectedRow.cells[4].textContent = document.getElementById("editScholarshipType").value;
            selectedRow.cells[5].textContent = document.getElementById("editGpa").value;
            selectedRow.cells[6].textContent = document.getElementById("editCategory").value;

            document.getElementById("editSection").classList.add("hidden");
        }
    }

    function cancelEdit() {
        document.getElementById("editSection").classList.add("hidden");
    }

    // The rest of your existing functions remain unchanged
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
            document.getElementById('gpa').value = ''; // Reset GPA field
            document.getElementById('category').value = ''; // Reset Category field
        }
    }

    function setCategory() {
        const gpaInput = document.getElementById('gpa');
        const categoryField = document.getElementById('category');

        const gpa = parseFloat(gpaInput.value);
        if (isNaN(gpa)) {
            categoryField.value = ''; // Clear the category if GPA is invalid
            return;
        }

        if (gpa >= 98 && gpa <= 100) {
            categoryField.value = 'Category 1';
        } else if (gpa >= 95 && gpa <= 97) {
            categoryField.value = 'Category 2';
 } else if (gpa >= 90 && gpa <= 94) {
            categoryField.value = 'Category 3';
        } else {
            categoryField.value = ''; // Outside GPA range, no category assigned
        }
    }

    function validateForm(event) {
        const scholarshipType = document.getElementById('scholarshipType').value;
        const studentId = document.getElementById('studentId').value.trim();
        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const course = document.getElementById('course').value.trim();
        const yearLevel = document.getElementById('yearLevel').value.trim();
        const gpaInput = document.getElementById('gpa');

        if (!studentId || !firstName || !lastName || !course || !yearLevel) {
            alert('Please fill in all required fields.');
            event.preventDefault();
            return;
        }

        if (scholarshipType === 'Academic Scholars') {
            const gpa = parseFloat(gpaInput.value);

            if (isNaN(gpa)) {
                alert('Please enter a valid GPA for Academic Scholars.');
                event.preventDefault();
                return;
            }
        
            if (gpa < 90) {
                showErrorPopup();
                event.preventDefault();
                return;
            }
        }

        showSuccessPopup();
    }

    function showErrorPopup() {
        const errorPopup = document.getElementById('errorPopup');
        errorPopup.classList.remove('hidden'); // Make the popup visible

        setTimeout(() => {
            errorPopup.classList.add('hidden');
        }, 800); // Popup will disappear after 800 ms
    }

    function showSuccessPopup() {
        const popup = document.getElementById('successPopup');
        popup.classList.remove('hidden');
        setTimeout(() => popup.classList.add('hidden'), 2000);
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
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form for Adding Scholar -->
            <form action="{{ route('add.scholar') }}" method="POST" onsubmit="validateForm(event)">
                @csrf
                <div class="mb-4">
                    <label for="scholarshipType" class="block text-sm font-medium text-gray-700">Select Scholarship Type</label>
                    <select id="scholarshipType" name="scholarshipType" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50" onchange="toggleGPAField()" required>
                        <option value="" disabled selected>Select Scholarship Type</option>
                        <option value="Academic Scholars">Academic Scholars</option>
                        <option value="Presidential Scholars">Presidential Scholars</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Scholar Information (Left Column) -->
                    <div>
                        <div class="mb-4">
                            <label for="studentId" class="block text-sm font-medium text-gray-700">Student ID</label>
                            <input type="text" id="studentId" name="studentId" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50" required>
                        </div>
                        <div class="mb-4">
                            <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" id="lastName" name="lastName" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50" required>
                        </div>
                        <div class="mb-4">
                            <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50" required>
                        </div>
                        <div class="mb-4">
                            <label for="middleName" class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" id="middleName" name="middleName" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50">
                        </div>
                    </div>

                    <!-- Course and Year Level (Right Column) -->
                    <div>
                        <div class="mb-4">
                            <label for="course" class="block text-sm font-medium text-gray-700">Course</label>
                            <input type="text" id="course" name="course" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50" required>
                        </div>
                        <div class="mb-4">
                            <label for="yearLevel" class="block text-sm font-medium text-gray-700">Year Level</label>
                            <input type="number" id="yearLevel" name="yearLevel" min="1" max="5" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border border-black border-opacity-10 shadow-50" required>
                        </div>

                        <!-- GPA and Category (Hidden Fields) -->
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

                <button type="submit" class="mt-4 w-full py-2 px-4 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700">Add Scholar</button>
            </form>
        </div>

        <!-- Error Popup -->
        <div id="errorPopup" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-50 w-1/3 text-center">
                <p class="text-red-600 font-bold">Not Qualified. GPA must not below 90.</p>
            </div>
        </div>


        <!-- Modal for Managing Scholarships -->
        <div id="scholarModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-8 rounded-lg w-11/12 md:w-3/4 max-w-6xl shadow-2xl relative">
                <h3 class="text-3xl font-semibold mb-4 text-blue-500">Manage Scholarships</h3>
                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-700 text-3xl">&times;</button>

                <!-- Editable Inputs -->
                <div id="editSection" class="hidden mb-4">
                    <h4 class="text-xl font-semibold mb-2 text-blue-600">Edit Scholar Details</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="editName" class="block text-gray-700 font-semibold">Name:</label>
                            <input id="editName" type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Enter full name" />
                        </div>
                        <div>
                            <label for="editCourse" class="block text-gray-700 font-semibold">Course:</label>
                            <input id="editCourse" type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Enter course" />
                        </div>
                        <div>
                            <label for="editYearLevel" class="block text-gray-700 font-semibold">Year Level:</label>
                            <input id="editYearLevel" type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Enter year level" />
                        </div>
                        <div>
                            <label for="editScholarshipType" class="block text-gray-700 font-semibold">Scholarship Type:</label>
                            <select id="editScholarshipType" class="w-full px-4 py-2 border rounded-lg">
                                <option value="" disabled selected>Select scholarship type</option>
                                <option value="Academic Scholars">Academic Scholars</option>
                                <option value="Presidential Scholars">Presidential Scholarship</option>
                                <option value="Athlete">Athletics</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div id="editGpaField" class="hidden">
                            <label for="editGpa" class="block text-gray-700 font-semibold">GPA:</label>
                            <input id="editGpa" type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Enter GPA" />
                        </div>
                        <div id="editCategoryField" class="hidden">
                            <label for="editCategory" class="block text-gray-700 font-semibold">Category:</label>
                            <input id="editCategory" type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Enter category" readonly />
                        </div>
                    </div>
                    <div class="flex mt-4">
                        <button onclick="saveChanges()" class="bg-green-500 text-white px-4 py-2 rounded-lg">Save Changes</button>
                        <button onclick="cancelEdit()" class="ml-4 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Cancel</button>
                        <!-- Delete Button -->
                        <button onclick="deleteScholar()" class="ml-4 bg-red-500 text-white px-4 py-2 rounded-lg">Delete Scholar</button>
                    </div>
                </div>


                <!-- Table -->
                <div class="overflow-y-auto max-h-[600px]">
                    <table class="min-w-full table-auto border-collapse">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="px-4 py-2 text-left font-semibold text-blue-700">Student ID</th>
                                <th class="px-4 py-2 text-left font-semibold text-blue-700">Name</th>
                                <th class="px-4 py-2 text-left font-semibold text-blue-700">Course</th>
                                <th class="px-4 py-2 text-left font-semibold text-blue-700">Year Level</th>
                                <th class="px-4 py-2 text-left font-semibold text-blue-700">Scholarship Type</th>
                                <th class="px-4 py-2 text-left font-semibold text-blue-700">GPA</th>
                                <th class="px-4 py-2 text-left font-semibold text-blue-700">Category</th>
                                <th class="px-4 py-2 text-left font-semibold text-blue-700">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($scholars as $scholar)
                                <tr class="hover:bg-gray-200 cursor-pointer" onclick="selectRow(this)">
                                    <td class="px-4 py-2 border-b">{{ $scholar->student_id }}</td>
                                    <td class="px-4 py-2 border-b">{{ $scholar->first_name }} {{ $scholar->last_name }}</td>
                                    <td class="px-4 py-2 border-b">{{ $scholar->course }}</td>
                                    <td class="px-4 py-2 border-b">{{ $scholar->year_level }}</td>
                                    <td class="px-4 py-2 border-b">{{ $scholar->scholarship_type }}</td>
                                    <td class="px-4 py-2 border-b">{{ $scholar->gpa }}</td>
                                    <td class="px-4 py-2 border-b">{{ $scholar->category }}</td>
                                    <td class="px-4 py-2 border-b text-center">
                                        <button class="hidden edit-button bg-blue-500 text-white px-3 py-1 rounded" onclick="editScholar(this)">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-2 text-center text-gray-500">No scholars found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
