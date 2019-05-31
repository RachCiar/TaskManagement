/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
//jQuery for hiding buttons
    $("#task").hide();
    //Onclick event when "Plus" button is clicked form displays
    $("#button").click(function () {
        $("#task").show();
    });
    //makes boxes sortable and updates the order when dragged around
    $(function () {
        $("#leftContainer ul").sortable({opacity: 0.6, cursor: 'move', update: function () {
                var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
                $.post("updateDB.php", order, function (theResponse) {

                });
            }
        });
    });
//Make both boxes sortable
    $(function () {
        $("#toDoListArray, #completedTasks").sortable(
                {connectWith: ".sortableBox"})
                .disableSelection();
    });
//Onclick event when "Add" button is clicked.

    $("#submit").click(function () {

        var newTask = document.getElementById("taskItem").value;
        var newTaskUrlStr = "taskIteminUrl=" + newTask;
        $.post("add.php", newTaskUrlStr, function (response) {
            $("#responseMessage").html(response);
            $("#taskItem").val("");
            refreshTask("newTask");
        });
    });

    //Delete task when move to trash button is clicked
    $("#btn").click(function () {


        deleteTask();

    });

    //update event when item is moved to "Task Complete" box.
    $(function () {
        $("#rightContainer ul").sortable({opacity: 0.6, cursor: 'move', update: function () {
                var order = $(this).sortable("serialize");
                taskComplete(order);
            }
        });
    });


//Mark the Task Complete
    function taskComplete(order) {
        $.post("taskComplete.php", order, function () {
            alert("Inside taskComplete(): " + order);
            $("#responseMessage").html("");
            $("#responseMessage").append("The task(s) have been updated");
            refreshTask("showTaskCompleted");
        });
    }

//Update the task list
    function refreshTask(taskType) {
        alert(taskType);
        var url = "getAllTasks.php?taskType=" + taskType;
        $.get(url, null, function (response) {
            alert(response);
            if (taskType === "newTask") {
                $("#toDoListArray").html(response);
            }
            if (taskType === "showTaskCompleted") {
                $("#completedTasks").html(response);
            }
            $("#responseMessage").html("");
            $("#responseMessage").append("Task list has been refreshed.");
//            setTimeout(function () {
//                $('#responseMessage').remove();
//            }, 2000);
        });
    }

//Delete tasks

    function deleteTask() {
        //confirm("Are you sure?");
        // if(confirm) {
        // ajax dialogue
    //}else{};
        $.post("deleteTask.php", null, function () {
            $("#responseMessage").html("");
            $("#responseMessage").append("The completed task(s) have been deleted");
            refreshTask("showTaskCompleted");
        });
    }



});
