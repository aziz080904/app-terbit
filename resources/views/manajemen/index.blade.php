<x-layout>
    <x-slot name="title">Halaman Manajemen Tugas</x-slot>
    <x-slot name="card_title">Daftar Tugas</x-slot>
    <x-slot name="card_footer">@Terbit</x-slot>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To-Do List</title>
        <style>
            /* Styling mirip dengan file kedua */
            body {
                font-family: 'Heebo', sans-serif;
                background-color: #f8f9fa;
                margin: 0;
                padding: 0;
            }
            .todo-container {
                width: 400px;
                background: #fff;
                border-radius: 10px;
                padding: 20px;
                margin: 20px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                float: left;
            }
            .todo-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }
            .todo-input {
                display: flex;
                gap: 10px;
                margin-bottom: 15px;
            }
            .todo-input input {
                flex-grow: 1;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            .todo-input button {
                padding: 8px 15px;
                border: none;
                border-radius: 5px;
                background-color: #007bff;
                color: white;
                cursor: pointer;
            }
            .todo-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .todo-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid #ddd;
                padding: 10px 0;
            }
            .todo-item:last-child {
                border-bottom: none;
            }
            .todo-item span {
                flex-grow: 1;
                margin-left: 20px;
            }
            .todo-item span.completed {
                text-decoration: line-through;
                color: #6c757d;
            }
            .todo-item button {
                background: transparent;
                border: none;
                color: #dc3545;
                cursor: pointer;
            }
            .todo-item button:hover {
                color: #a71d2a;
            }
            .form-check-input {
                margin-right: 10px;
            }
        </style>
    </head>
    <body>
        <div class="todo-container">
            <div class="todo-header">
                <h6>To-Do List</h6>
            </div>

            <!-- Form untuk menambah tugas -->
            <form action="{{ route('manajemen.store') }}" method="POST" class="todo-input">
                @csrf
                <input type="text" name="manajemen" placeholder="Enter task" required>
                <button type="submit">Add</button>
            </form>

            <!-- Daftar Tugas -->
            <ul class="todo-list">
                @foreach ($manajemens as $task)
                    <li class="todo-item {{ $task->is_completed ? 'completed' : '' }}">
                        <form action="{{ route('manajemen.update', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="checkbox" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                        </form>
                        <span class="{{ $task->is_completed ? 'completed' : '' }}">{{ $task->manajemen }}</span>
                        <form action="{{ route('manajemen.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </body>
    </html>
</x-layout>