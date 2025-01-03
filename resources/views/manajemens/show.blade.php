<x-layout>
    <x-slot name="title">Halaman Manajemen Tugas</x-slot>
    <x-slot name="card_title">Daftar Tugas</x-slot>
    <x-slot name="card_footer">@Terbit</x-slot>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>To-Do List</title>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <style>
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
                float: left; /* Kontainer tetap di sisi kiri */
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
                <a href="#">Show All</a>
            </div>
            <div class="todo-input">
                <input type="text" id="taskInput" class="form-control" placeholder="Enter task">
                <button class="btn btn-primary" id="addTaskBtn">Add</button>
            </div>
            <ul id="todoList" class="todo-list"></ul>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const tasks = @json($manajemens);
                const todoList = document.getElementById('todoList');
                const taskInput = document.getElementById('taskInput');
                const addTaskBtn = document.getElementById('addTaskBtn');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Set default headers for Axios
                axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

                // Render tasks from backend
                tasks.forEach(task => renderTask(task));

                // Add task event
                addTaskBtn.addEventListener('click', () => {
                    const taskText = taskInput.value.trim();
                    if (taskText === '') {
                        alert('Please enter a task.');
                        return;
                    }

                    axios.post('http://terbit.wuaze.com/manajemen', { manajemen: taskText })
                        .then(response => {
                            renderTask(response.data);
                            taskInput.value = '';
                        })
                        .catch(error => alert('Error adding task: ' + error.message));
                });

                // Render a single task
                function renderTask(task) {
                    const listItem = document.createElement('li');
                    listItem.classList.add('todo-item');

                    listItem.innerHTML = `
                        <input type="checkbox" class="form-check-input" ${task.is_completed ? 'checked' : ''} 
                            onchange="toggleTaskCompletion(this, ${task.id})">
                        <span class="${task.is_completed ? 'completed' : ''}">${task.manajemen}</span>
                        <button onclick="removeTask(${task.id}, this)"><i class="fa fa-times"></i></button>
                    `;

                    todoList.appendChild(listItem);
                }

                // Toggle task completion
                window.toggleTaskCompletion = (checkbox, taskId) => {
                    const isCompleted = checkbox.checked;
                    const taskSpan = checkbox.nextElementSibling;

                    taskSpan.classList.toggle('completed', isCompleted);

                    axios.put(`/manajemen/${taskId}`, { is_completed: isCompleted })
                        .then(response => {
                            console.log('Task updated:', response.data);
                        })
                        .catch(error => {
                            alert('Error updating task: ' + error.message);
                            checkbox.checked = !isCompleted;
                        });
                };

                // Remove a task
                window.removeTask = (taskId, button) => {
                    const listItem = button.parentElement;

                    axios.delete(`/manajemen/${taskId}`)
                        .then(response => {
                            listItem.remove();
                            console.log(response.data.message);
                        })
                        .catch(error => {
                            alert('Error deleting task: ' + error.message);
                        });
                };
            });
        </script>

        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    </body>
    </html>
</x-layout>
