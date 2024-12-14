<!DOCTYPE html>
<html>
<head>
    <title>Login - ScholarPath</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
        /* Hide the arrows in number input */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-500 to-indigo-600 font-roboto">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-10 rounded-lg shadow-2xl w-full max-w-md">
            <div class="text-center mb-8">
                <img alt="ScholarPath logo" class="mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/u16ksT3brB4YHdEfVsvDdB7Nw1QS9BeAlDJsfm2M0VD0iwznA.jpg" width="100" />
                <h1 class="text-4xl font-bold text-blue-600">ScholarPath</h1>
                <p class="text-gray-700">Scholarship Office Staff Login</p>
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium" for="staff-id">Staff ID Number</label>
                    <input 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        id="staff-id" 
                        name="staff_id" 
                        placeholder="Enter your ID" 
                        required 
                        type="number" 
                        min="0" />
                    <p class="text-red-500 text-sm mt-1 hidden" id="staff-id-error">Please enter a valid Staff ID Number.</p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium" for="password">Password</label>
                    <input 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password" 
                        required 
                        type="password" />
                    <p class="text-red-500 text-sm mt-1 hidden" id="password-error">Password is required.</p>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                            id="remember" 
                            name="remember" 
                            type="checkbox" />
                        <label class="ml-2 text-gray-900" for="remember">Remember me</label>
                    </div>
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">Forgot your password?</a>
                </div>
                <button 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    type="submit">
                    Login
                </button>
            </form>
            <p class="mt-8 text-center text-gray-700">Don't have an account? <a class="text-blue-600 hover:underline" href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
</body>
</html>
