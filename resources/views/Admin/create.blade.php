<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Admin</title>
    <style>
        /* General body and container styles (reused from index) */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 600px; /* Adjusted max-width for form page */
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 20px;
        }

        /* Form specific styles */
        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 22px); /* Account for padding and border */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        /* Button styling */
        .form-buttons {
            display: flex;
            justify-content: space-between; /* Space out buttons */
            margin-top: 20px;
        }
        .submit-button, .back-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none; /* For the back button which is an anchor */
            display: inline-block; /* For the back button */
            text-align: center;
        }
        .submit-button {
            background-color: #007bff;
            color: white;
            transition: background-color 0.2s ease;
        }
        .submit-button:hover {
            background-color: #0056b3;
        }
        .back-button {
            background-color: #6c757d; /* Grey */
            color: white;
            transition: background-color 0.2s ease;
        }
        .back-button:hover {
            background-color: #5a6268;
        }

        /* Validation and success message styling */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 16px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert ul {
            margin: 0;
            padding-left: 20px;
            list-style-type: disc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create New Admin</h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <h3>Validation Errors:</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="lastname">Lastname:</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
            </div>

            <div>
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required>
            </div>

            <div>
                <label for="username">Username (max 15 chars):</label>
                <input type="text" id="username" name="username" maxlength="15" value="{{ old('username') }}" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.index') }}" class="back-button">Back to Admin List</a>
                <button type="submit" class="submit-button">Create Admin</button>
            </div>
        </form>
    </div>
</body>
</html>
