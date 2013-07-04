<?php
	if(gettype($this->task->due_date) === 'string')
	{
		$this->task->due_date 	= date_create($this->task->due_date);
		$this->task->modified 	= date_create($this->task->modified);
		$this->task->created 	= date_create($this->task->created);
	}
?>
<div class="span6 well well-small">
	<label for="title">Title</label>
	<input class="span12" type="text" placeholder="Title" name="title" value="<?php echo $this->task->title; ?>">		
	<label for="summary">Summary</label>
	<textarea class="span12" name="summary" rows="5"><?php echo $this->task->summary; ?></textarea>
</div>
<div class="span6 well well-small">
	<label for="due_date">Due Date:</label>
	<input type="datetime-local" name="due_date" value="<?php echo date_format($this->task->due_date, 'Y-m-d\TH:i:s'); ?>" />
	<label for="urgency">Urgent:</label>
	<div class="btn-group" data-toggle="buttons-radio">
		<button class="btn" type="button" name="urgency" value="1">Yes</button>
		<button class="btn active" type="button" name="urgency" value="0">No</button>
	</div>
	<input type="hidden" name="task_id" value="<?php echo $this->task->task_id; ?>">
	<input type="hidden" name="user_id" value="<?php echo $this->task->user_id; ?>">
	<input type="hidden" name="created" value="<?php echo date_format($this->task->created, 'Y-m-d\TH:i:s'); ?>">
</div>
