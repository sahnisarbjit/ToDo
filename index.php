<html>
<head>
    <title>Todo List</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/underscore.js"></script>
    <script type="text/javascript" src="js/backbone.js"></script>
    <script type="text/javascript" src="js/todo.js"></script>
    <script id="new-edit-template" type="text/template">
        
    </script>
    <script id="list-template" type="text/template">
        <table>
            <tr>
                <th>Status</th>
                <th>Task</th>
                <th>Created On</th>
                <th>Due On</th>
                <th>Done On</th>
            </tr>
            <% tasks.each(function(task) { %>
                <tr>
                    <td>
                        <input class="status" type="checkbox" <% if (task.get('task_status' == 'done')) { %>checked="checked"<% } %> /></td>
                    <td><%= task.get('task') %></td>
                    <td><%= task.get('created') %></td>
                    <td><%= task.get('due') %></td>
                    <td>
                        <% if (task.get('task_status') == 'done') { %>
                            <%= task.get('finished') %></td>
                        <% } else { %>
                            --
                        <% } %>
                </tr>
            <% }); %>
        </table>
    </script>
</head>

<body>
    <h1>Hello</h1>
    <h1>Hello2</h1>

    <div id="container">
        <div id="todo-list"></div>
    </div>
</body>

</html>