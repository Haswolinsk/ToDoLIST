/* import './bootstrap';



var Tasks = [];

function idGenerator(){
    var timestamp = new Date();

    var id = 
    timestamp.getHours().toString() + 
    timestamp.getMinutes().toString() + 
    timestamp.getSeconds().toString() +
    timestamp.getMilliseconds().toString();

    return id
}

function createTask(taskTitle, taskDesc, taskDeadLine){
    var Title = {
        id: idGenerator(),
        data: {
            Title: taskTitle,
            Description: taskDesc,
            DeadLine: taskDeadLine
        }
    };

    Tasks.push(Title);
}



function deleteTask(id){
    console.log(Element)

    Tasks = Tasks.filter(Title => Title.id != id);

    updateScreen();
}


function newTitle(){
    var taskTitle = document.getElementById("Title").value;
    var taskDesc = document.getElementById("Desc").value;
    var taskDeadLine = document.getElementById("DeadLine").value;

    if(document.getElementById("Title").value){
        createTask(taskTitle, taskDesc, taskDeadLine);
    }
    
    updateScreen();
}

function updateScreen(){
    var list = "<ul>";

    Tasks.forEach(Task => {
        list += "<button class='remove' onclick=removeTask(this) id-data=" + Task.id + ">Apagar Tarefa</button>"
        list += "<hr><li><p class='desc'>" + Task.data.Title + " || "
        list += Task.data.DeadLine + "</p>"
        list += "<p class='desc'>" + Task.data.Description+"</p></li>"

    });
    list += "</ul>";
    

    document.getElementById("list").innerHTML = list;
    document.getElementById("Title").value = "";
}

function removeTask(Element){
    console.log(Element)

    var id = Element.getAttribute("id-data");

    deleteTask(id);
    updateScreen();
}


 */