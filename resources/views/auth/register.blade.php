<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>ScholarPath Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-400 to-purple-500 font-roboto">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('path-to-your-logo.jpg') }}" alt="ScholarPath Logo" class="h-12">
            </div>
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Staff ID input field -->
                <div class="mb-4">
                    <label class="block text-gray-700" for="staff_id">Staff ID Number</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="staff_id" name="staff_id" maxlength="8" placeholder="Enter your Staff ID Number" type="number" required />
                    <p class="text-red-500 text-sm mt-1 hidden" id="staff-id-warning">Staff ID Number cannot exceed 8 digits.</p>
                </div>

                <!-- Name input field -->
                <div class="mb-4">
                    <label class="block text-gray-700" for="name">Name</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="name" name="name" placeholder="Enter your Name" type="text" required />
                </div>

                <!-- Email input field -->
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Recovery Email</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" name="email" placeholder="Enter your Recovery Email" type="email" required />
                </div>

                <!-- Password input field -->
                <div class="mb-4">
                    <label class="block text-gray-700" for="password">Password</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password" placeholder="Enter your Password" type="password" required />
                </div>

                <!-- Password confirmation input field -->
                <div class="mb-4">
                    <label class="block text-gray-700" for="password_confirmation">Confirm Password</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password_confirmation" name="password_confirmation" placeholder="Confirm your Password" type="password" required />
                </div>

                <!-- Register button -->
                <button class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">Register</button>
            </form>
        </div>
    </div>
    <script>
        function validateStaffID() {
            const staffIDInput = document.getElementById('staff_id');
            const warningMessage = document.getElementById('staff-id-warning');
            if (staffIDInput.value.length > 8) {
                warningMessage.classList.remove('hidden');
            } else {
                warningMessage.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
