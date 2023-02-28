<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
    .container{
        max-width: 65%;
        max-height: 100%;
        height: 80%;
        margin: auto;
        background-color: rgb(200, 255, 255);
        padding: 4%;
        border-radius: 100px;
    }
    .todolist{
        padding: 10px;
        margin: 20px auto;
        background-color: bisque;
        border: 5px solid;
    }
    .inputs{
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 20px;
    }
    .sub-input{
        display: flex;
        flex-direction: row;
        gap: 20px;
    }
    .desc{
        word-break: break-all;
        font-family: verdana;
        font-size: 16px ;
    }
    .button{
        padding: 0px 12px;
        margin-left: auto;
        background-color: cornflowerblue;
        color: black;
        font-size: 20px;
        border-radius: 100px;
    }
    .remove{
        color: black;
        background-color: red;
        margin: 10px;
        height: 36px;
        width: 61px;
        font-size: larger;
        font-weight: bold;
    }

    #newTitle{
        height: 35px;
        width: 80%;
    }

    button{
        height: 44px;
        width: 45px;
        background-color: cornflowerblue;
        color: black;
        font-size: xx-large;
        border-radius: 100px;
        float: right;
    }
    button, input[type=button]{cursor: pointer;}

    h1{
        text-align: center;
    }
    table{
        min-height:200px;
    }
    tbody{
        height: 100%;
        list-style-type: disclosure-closed ;
        overflow-y: scroll;
        margin-top: 0px;
        margin-bottom: 0px;
    }
    td{
        width: 4%;
    }
    input{
        padding: 5px 10px;
        font-size: medium;
        font-family: verdana;
    }
    </style>
</head>
<body onload="initialyze()">
    <div class="container">
        <h1>ToDoList</h1>
        <form class="inputs" >
            <div class="sub-input">
                <input type="text" id="Title" placeholder="Titulo" size="20">
                <input type="date" id="DeadLine">
                <input class='button' type="reset" value="Limpar" onmouseover="PointerEvent">
                <input class="button" type="button" value="Adicionar" onclick="saveTasks()" onmouseover="PointerEvent" style="margin-left: 0px;"><br>
            </div>
            <textarea id="Desc" cols="300" rows="5 placeholder="Descrição..." style="resize: none; font-size: 18px; font-family: verdana; margin-bottom: 2%;"></textarea>
        </form>

        <div class="todolist">
                <table>
                    <tbody>

                    </tbody>
                </table>
        </div>
    </div>

</body>
<script type='text/javascript'>

function initialyze() {
    getTasks();
}

function getTasks() {
    $.ajax({
        type: "GET",
        url: `/todolist`,
        success: function (data) {
            console.log(data);

            if (data.length > 0) {
                const table = document.getElementsByTagName('tbody')[0];
                table.innerHTML = "";
                for (var i = 0; i <data.length; i++) {
                    try{
                        const row = table.insertRow(i);
                        const cell1 = row.insertCell(0);
                        const cell2 = row.insertCell(1);
                        const cell3 = row.insertCell(2);
                        cell1.innerHTML += "<h2 class='desc'>" + data[i].task + " || " + data[i].deadline + "</h2>";
                        cell2.innerHTML += "<p class='desc'>" + data[i].description+"</p>";
                        cell3.innerHTML += "<button class='remove' onclick=deleteTask("+ data[i].id +")>X</button>";
                        cell3.innerHTML += "<button class='remove' onclick='openEditModal(${data[i].id},'${data[i].task}','${data[i].Desc}','${data[i].DeadLine}')' id-data=" + data[i].id + ">Edit</button>";
                        
                    }catch(error){
                        console.log(error);
                    }
                }
            } else {
                var row = table.insertRow(0);
                var cell = row.insertCell(0);

                cell.innerHTML = 'No tasks';
            }            
        },
        error: function (error) {
            alert(`Error ${error}`);
        }
    })
}

function saveTasks() {
    var task1 = document.getElementById('Title').value;
    var task2 = document.getElementById('Desc').value;
    var task3 = document.getElementById('DeadLine').value;
    $.ajax({
        type: "POST",
        url: "/todolist",
        data: {
            task: task1,
            description: task2,
            deadline: task3,
        },
        success: function (data) {
            console.log(data);
            getTasks();
        },
        error: function (error) {
            alert(`Error ${error}`);
        }
    })
}

function deleteTask(id) {
    $.ajax({
        type: "DELETE",
        url: `/todolist/${id}`,
        success: function (data) {
            console.log(data);
            getTasks();
        },
        error: function (error) {
            alert(`Error ${error}`);
        }
    })
}

function openEditModal(id,Task, Desc, DeadLine) {
    $('#edit').modal('show');
    $('#task-id').val(id);
    $('#task-task').val(Task);
    $('#task-desc').val(Desc);
    $('#task-deadline').val(DeadLine);
}

function edit() {
    var id = $('#task-id').val();
    var description = $('#task-description').val();
    var task1 = document.getElementById('Title').value;
    var task2 = document.getElementById('Desc').value;
    var task3 = document.getElementById('DeadLine').value;
    $.ajax({
        type: "PUT",
        url: `/todolist/${id}`,
        data: {
            task: task1,
            description: task2,
            deadline: task3,
        },
        success: function (data) {
            console.log(data);
            getTasks();
        },
        error: function (error) {
            alert(`Error ${error}`);
        }
    })
}

</script>
</html>
