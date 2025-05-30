<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin: {{ $admin->name }} {{ $admin->lastname }}</title>
    <style>
        /* General body and container styles (reused from create/index) */
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

        /* Validation and success/error message styling */
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
        <h1>Edit Admin: {{ $admin->name }} {{ $admin->lastname }}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <p>{{ session('error') }}</p>
            </div>
        @endif

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

        <form action="{{ route('admin.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <input type="hidden" name="id" value="{{ $admin->id }}">

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
            </div>

            <div>
                <label for="lastname">Lastname:</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $admin->lastname) }}" required>
            </div>

            <div>
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', $admin->phoneNumber) }}" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
            </div>

            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="{{ old('address', $admin->address ?? '') }}" required>
            </div>

            <div>
                <label for="password">New Password (optional):</label>
                <input type="password" id="password" name="password">
            </div>

            <div>
                <label for="password_confirmation">Confirm New Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.index') }}" class="back-button">Back to Admin List</a>
                <button type="submit" class="submit-button">Update Admin</button>
            </div>
        </form>
    </div>
</body>
</html>
