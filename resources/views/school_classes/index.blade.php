<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
         @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="mb-4">School Classes</h1>
        <a href="{{ route('school-classes.create') }}" class="btn btn-primary mb-3">Add New Class</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th width="180px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                <tr>
                    <td>{{ $class->id }}</td>
                    <td>{{ $class->name }}</td>
                    <td>
                        <a href="{{ route('school-classes.show', $class->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('school-classes.edit', $class->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('school-classes.destroy', $class->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
         <div class="mt-4">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">View All Students</a>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">View All Subjects</a>
        </div>
    </div>

</body>
</html>