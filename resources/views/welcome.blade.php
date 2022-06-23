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
        background-color: rgb(0, 255, 255);
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
        width: 35px;
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
    ul{
        height: 100%;
        list-style-type: disclosure-closed ;
        overflow-y: scroll;
        margin-top: 0px;
        margin-bottom: 0px;
    }
    li{
        margin-right: 9px;
    }
    hr{
        margin-top: 0px;
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
            <div id="list" style="height: 200px; background-color: bisque;">
            </div>
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
        url: "/todolist",
        success: function (data) {
            console.log(data);
            var Tasks = [];
            if(data.length> 0){
                var list = "<ul>";
                Tasks.forEach(data => {
                    list += "<button class='remove' onclick='edit(this)' id-data=" + data[i].id + ">X</button>"
                    list += "<button class='remove' onclick=deleteTask(this) id-data=" + data[i].id + ">X</button>"
                    list += "<hr><li><h2 class='desc'>" + data.data.Title + " || "
                    list += data[i].data.DeadLine + "</h2>"
                    list += "<p class='desc'>" + data[i].data.Description+"</p></li>"
                });
                list += "</ul>";
                document.getElementById("list").innerHTML = list;
                document.getElementById("Title").value = "";
            }
            
        },
        error: function (error) {
            alert(`Error ${error}`);
        }
    })
}

function saveTasks() {
    const task1 = document.getElementById('Title').value;
    const task2 = document.getElementById('Desc').value;
    const task3 = document.getElementById('DeadLine').value;
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

function openEditModal(id, description) {
    $('#list').modal('show');
    $('#task-id').val(id);
    $('#task-description').val(description);
}

function edit() {
    var id = $('#task-id').val();
    var description = $('#task-description').val();
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
