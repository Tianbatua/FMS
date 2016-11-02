<?php
####################################################################
#	File Name	:	menu_todo.php
#	Location	:	/webroot/menus
####################################################################
?>

<div class="container">
	<h2>ToDo App</h2>


	<form ng-submit="createTask()">
		<input class="form-control todos__create-input" placeholder="What do I need to do?" ng-model="createTaskInput" />
		<button class="btn btn-success todos__create-button">Create Task</button>
	</form>

	<table class="table table-striped">
		<tr>
			<th>Completed?</th>
			<th>Task</th>
			<th>Actions</th>
		</tr>
		<tr ng-repeat="todo in todos">
			<td><input type="checkbox" ng-checked="todo.isCompleted" ng-click="onCompletedClick(todo)" /></td>
			<td>
			     <span ng-if="!todo.isEditing" class="todos__task" ng-class="{'todos__task--completed': todo.isCompleted}" >{{todo.task}}
			     </span>

			     <form ng-submit="updateTask(todo)">
			     	<input ng-if="todo.isEditing" 
			     	       class="form-control todos__update-input" 
			     	       ng-value="todo.task" 
			     	       ng-model="todo.updatedTask" />
			     </form>
			</td>
			<td>
				<button ng-if="!todo.isEditing" 
				        class="btn btn-info" 
				        ng-click='onEditClick(todo)'>
				        Edit
				</button>
				<button ng-if="!todo.isEditing" 
				        class="btn btn-danger"
				        ng-click="deleteTask(todo)">
				        Delete
				</button>

				<button ng-if="todo.isEditing" 
				        class="btn btn-primary" 
				        ng-click="updateTask(todo)" >				        
				        Save
				</button>
				<button ng-if="todo.isEditing" 
				        class="btn btn-default" 
				        ng-click="onCancelClick(todo)">
				        Cancel
				</button>
			</td>
		</tr>

	</table>
</div>