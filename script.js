/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

//jQuery for HIDING BUTTONS
    $("#task").hide();

//ONCLICK event when "Plus" button is clicked form displays
    $("#button").click(function () {
        $("#task").show();
    });

//makes boxes on left side sortable and updates the order when dragged around
    $(function () {
        $("#leftContainer ul").sortable({opacity: 0.6, cursor: 'move', update: function () {
                var order = $(this).sortable("serialize");
                $.post("updateDB.php", order, function (theResponse) {
                    newTask(order)
                    refreshTask("newTask");

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

//ONCLICK event when "Add" button is clicked.

    $("#submit").click(function () {

        var newTask = document.getElementById("taskItem").value;
        var newTaskUrlStr = "taskIteminUrl=" + newTask;
        $.post("add.php", newTaskUrlStr, function (response) {
            $("#responseMessage").html(response);
            $("#taskItem").val("");
            refreshTask("newTask");
        });
    });

    //DELETE TASK(S) when "Delete Completed Task(s) button is clicked
    $("#btn").click(function () {
        deleteTask();
    });

    //UPDATE event when item is moved to "Task Complete" box.
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
           // alert("Inside taskComplete(): " + order);
            updateMessageResponse();
            refreshTask("showTaskCompleted");
        });
    }


////When box is dragged from complete to new task
    function newTask(order) {
        $.post("newTask.php", order, function () {
         //  alert("Inside newTask(): " + order);
            updateMessageResponse();
            refreshTask("newTask");
        });

    }


//Update the task list
    function refreshTask(taskType) {
        //alert("Inside refreshTask(): " + taskType);
        var url = "getAllTasks.php?taskType=" + taskType;
        $.get(url, null, function (response) {
           // alert("Inside refreshTask(): + response" + response);
            if (taskType === "newTask") {
                $("#toDoListArray").html(response);
            }
            if (taskType === "showTaskCompleted") {
                $("#completedTasks").html(response);
            }
            updateMessageResponse();

        });
    }

//Delete tasks but give a confirm alert first.

    function deleteTask() {
        if (confirm("Are you sure you want to delete task(s)?")) {
            $.post("deleteTask.php", null, function () {
                deleteMessageResponse();
                refreshTask("showTaskCompleted");
            });
        } else {
            refreshTask("showTaskCompleted");
        }
    }
//response message when tasks have been updated
    function updateMessageResponse() {
        $("#responseMessage").html("");
        $("#responseMessage").append("The task(s) have been updated");
        $('#responseMessage').delay(2000).fadeOut();
    }

//response message when tasks have been deleted
    function deleteMessageResponse() {
        $("#responseMessage").html("");
        $("#responseMessage").append("The completed task(s) have been deleted");
        $('#responseMessage').delay(2000).fadeOut();
    }

});
