<div id="tasklistr" class="row-fluid">
	<div class="navbar">
		<div class="navbar-inner">
			<a href="#" class="brand">Tasklistr</a>
			<button class="btn btn-primary pull-right add-task-btn">Add Task</button>
		</div>
	</div>
	<div class="accordian" id="tasklistr-accordian">
	<?php foreach($this->list as $index => $row):
	
		$row->due_date 	= date_create($row->due_date);
		$row->modified 	= date_create($row->modified);
		$row->created 	= date_create($row->created);
	?>
		<div class="accordian-group well well-small">
			<div class="accordian-heading">
				<h3><a href="#collapse-<?php echo $index; ?>" class="accordian-toggle" data-toggle="collapse" data-parent="#tasklistr-accordian">
					<?php echo $row->title; ?>
				</a></h3>
			</div>
			<div class="accordian-body collapse" id="collapse-<?php echo $index; ?>">
				<div class="accordian-inner">
					<div class="tabbable">
						<div class="row-fluid">
							<div class="span8">
								<ul class="nav nav-tabs">
									<li><a href="#display-tab-<?php echo $index; ?>" data-toggle="tab" class="display-tab">Display</a></li>
									<li><a href="#edit-tab-<?php echo $index; ?>" data-toggle="tab" class="edit-tab">Edit</a></li>
								</ul>
							</div>
							<div class="span4">
								<div class="nav pull-right">
									<a href="#save-task-<?php echo $index; ?>" class="btn disabled save-task-btn">Save</a>
									<a href="#" data-task-id="<?php echo $row->task_id; ?>" class="btn del-task-btn">Delete</a>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content">
						<div class="display-pane tab-pane row-fluid active" id="display-tab-<?php echo $index; ?>">
							<div class="span7">
								<h4>Summary:</h4>
								<p class="taskSummary"><?php echo $row->summary; ?></p>
							</div>
							<div class="span5">
								<table class="table">
									<tr>
										<th>Due Date:</th>
										<td><?php echo date_format($row->due_date, 'M jS G:ia'); ?></td>
									</tr>
									<tr>
										<th>Modified Date:</th>
										<td><?php echo date_format($row->modified, 'M jS G:ia'); ?></td>
									</tr>
									<tr>
										<th>Created Date:</th>
										<td><?php echo date_format($row->created, 'M jS G:ia'); ?></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="edit-pane tab-pane row-fluid" id="edit-tab-<?php echo $index; ?>">
							<form class="save-task-form" id="save-task-<?php echo $index; ?>">
								<div class="span6 well well-small">
									<label for="title">Title</label>
									<input class="span12" type="text" placeholder="Title" name="title" value="<?php echo $row->title; ?>" required>		
									<label for="summary">Summary</label>
									<textarea class="span12" name="summary" rows="5" placeholder="<?php echo $row->summary; ?>"><?php echo $row->summary; ?></textarea>
								</div>
								<div class="span6 well well-small">
									<label for="due_date">Due Date:</label>
									<input type="datetime-local" name="due_date" value="<?php echo date_format($row->due_date, 'Y-m-d\TH:i:s'); ?>" />
									<label for="urgency">Urgent:</label>
									<div class="btn-group" data-toggle="buttons-radio">
										<button class="btn" type="button" name="urgency" value="1">Yes</button>
										<button class="btn active" type="button" name="urgency" value="0">No</button>
									</div>
									<input type="hidden" name="task_id" value="<?php echo $row->task_id; ?>">
									<input type="hidden" name="user_id" value="<?php echo $this->user_id; ?>">
									<input type="hidden" name="created" value="<?php echo date_format($row->created, 'Y-m-d\TH:i:s'); ?>">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	</div> <!-- div.accordian -->
	<div class="footer row-fluid">
		<div class="span12 navbar">
			<div class="navbar-inner">
				<span class="brand">Tasklistr Footer</span>
			</div>
		</div>
	</div>

	<div id="blankTask" style="display:none;">
		<div class="accordian-group well well-small">
			<div class="accordian-heading">
				<h3><a href="#collapse-N" class="accordian-toggle" data-toggle="collapse" data-parent="#tasklistr-accordian">
					Title
				</a></h3>
			</div>
			<div class="accordian-body collapse" id="collapse-N">
				<div class="accordian-inner">
					<div class="tabbable">
						<div class="row-fluid">
							<div class="span8">
								<ul class="nav nav-tabs">
									<li><a href="#display-tab-N" data-toggle="tab" class="display-tab">Display</a></li>
									<li><a href="#edit-tab-N" data-toggle="tab" class="edit-tab">Edit</a></li>
								</ul>
							</div>
							<div class="span4">
								<div class="nav pull-right">
									<a href="#save-task-N" class="btn disabled save-task-btn">Save</a>
									<a href="#" data-task-id="" class="btn del-task-btn">Delete</a>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content">
						<div class="display-pane tab-pane row-fluid active" id="display-tab-N">
							<div class="span7">
								<h4>Summary:</h4>
								<p class="taskSummary"></p>
							</div>
							<div class="span5">
								<table class="table">
									<tr>
										<th>Due Date:</th>
										<td>N/A</td>
									</tr>
									<tr>
										<th>Modified Date:</th>
										<td>N/A</td>
									</tr>
									<tr>
										<th>Created Date:</th>
										<td>N/A</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="edit-pane tab-pane row-fluid" id="edit-tab-N">
							<form class="save-task-form" id="save-task-N">
								<div class="span6 well well-small">
									<label for="title">Title</label>
									<input class="span12" type="text" placeholder="Title" name="title" value="" required>		
									<label for="summary">Summary</label>
									<textarea class="span12" name="summary" rows="5"></textarea>
								</div>
								<div class="span6 well well-small">
									<label for="due_date">Due Date:</label>
									<input type="datetime-local" name="due_date" value="" />
									<label for="urgency">Urgent:</label>
									<div class="btn-group" data-toggle="buttons-radio">
										<button class="btn" type="button" name="urgency" value="1">Yes</button>
										<button class="btn active" type="button" name="urgency" value="0">No</button>
									</div>
									<input type="hidden" name="task_id" value="">
									<input type="hidden" name="user_id" value="<?php echo $this->user_id; ?>">
									<input type="hidden" name="created" value="">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- div.accordian-group -->
	</div>
</div>

<div id="delete-modal" class="modal hide fade" tabindex="-1">
	<div class="modal-header">
		<h3>Delete Task?</h3>
	</div>
	<div class="modal-body">
		<form id="delete-modal-form">
			<input type="hidden" name="task_id" value="">
		</form>
		<button id="delete-modal-btn" class="btn">Delete</button>
		<button id="cancel-modal-btn" class="btn">Cancel</button>
	</div>
</div>