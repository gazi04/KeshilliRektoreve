<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 1200px;
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
        .top-controls {
            display: flex;
            justify-content: space-between; /* Space out create button and filters */
            align-items: center; /* Vertically align items */
            margin-bottom: 20px;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }
        .create-button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            white-space: nowrap; /* Prevent button text from wrapping */
        }
        .create-button:hover {
            background-color: #218838;
        }

        /* Search and Filter Styles */
        .filter-form {
            display: flex;
            gap: 10px; /* Space between filter elements */
            align-items: center;
            flex-wrap: wrap;
            margin-left: auto; /* Pushes the form to the right if space allows */
        }
        .filter-form input[type="text"],
        .filter-form select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .filter-form button {
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }
        .filter-form button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9e9e9;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a, .pagination span {
            padding: 8px 12px;
            margin: 0 4px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #007bff;
            background-color: #fff;
        }
        .pagination a:hover {
            background-color: #e9e9e9;
        }
        .pagination .active span {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .pagination .disabled span {
            color: #aaa;
            cursor: not-allowed;
            background-color: #f8f8f8;
        }

        .pagination svg {
            width: 16px;
            height: 16px;
            vertical-align: middle;
        }
        .pagination span.relative.inline-flex.items-center span {
            font-size: 14px;
        }

        .action-button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin-right: 5px;
        }
        .edit-button {
            background-color: #007bff;
            color: white;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .activate-button {
            background-color: #28a745;
            color: white;
        }
        .activate-button:hover {
            background-color: #218838;
        }
        .deactivate-button {
            background-color: #dc3545;
            color: white;
        }
        .deactivate-button:hover {
            background-color: #c82333;
        }
        .action-form {
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        /* Message styling */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 16px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Users</h1>

        {{-- Success/Error Messages --}}
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

        <div class="top-controls">
            <a href="{{ route('admin.create') }}" class="create-button">Create Admin</a>

            {{-- Search and Filter Form --}}
            <form action="{{ route('admin.index') }}" method="GET" class="filter-form">
                <input type="text" name="search" placeholder="Search admins..." value="{{ request('search') }}">
                <select name="status">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                {{-- New Order By Select --}}
                <select name="order_by">
                    <option value="latest" {{ request('order_by') == 'latest' || !request('order_by') ? 'selected' : '' }}>Order by Latest</option>
                    <option value="name_asc" {{ request('order_by') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="name_desc" {{ request('order_by') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                </select>
                <button type="submit">Apply Filters</button>
                @if (request()->filled('search') || request()->filled('status') || request()->filled('order_by'))
                    <a href="{{ route('admin.index') }}" class="action-button" style="background-color: #6c757d; color: white;">Reset</a>
                @endif
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->lastname }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phoneNumber }}</td>
                        <td>{{ $admin->address }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>
                            @if ($admin->isActive)
                                <span style="color: green; font-weight: bold;">Active</span>
                            @else
                                <span style="color: red; font-weight: bold;">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if ($admin->isActive)
                                <form action="{{ route('admin.deactivate') }}" method="POST" class="action-form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $admin->id }}">
                                    <button type="submit" class="action-button deactivate-button">Deactivate</button>
                                </form>
                            @else
                                <form action="{{ route('admin.activate') }}" method="POST" class="action-form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $admin->id }}">
                                    <button type="submit" class="action-button activate-button">Activate</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.edit') }}" method="GET" class="action-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                <button type="submit" class="action-button edit-button">Edit</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">No admin users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Laravel's pagination links --}}
        <div class="pagination">
            {{ $admins->links() }}
        </div>
    </div>
</body>
</html>
