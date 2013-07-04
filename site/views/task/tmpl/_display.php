<?php
/*	if(gettype($this->task->due_date) === 'string')
	{
		$this->task->due_date 	= date_create($this->task->due_date);
		$this->task->modified 	= date_create($this->task->modified);
		$this->task->created 	= date_create($this->task->created);
	}
*/?>
<div class="span7">
	<h4>Summary:</h4>
	<p class="taskSummary"><?php /*echo $this->task->summary;*/ ?></p>
</div>
<div class="span5">
	<table class="table">
		<tr>
			<th>Due Date:</th>
			<td><?php /*echo date_format($this->task->due_date, 'M jS G:ia');*/ ?></td>
		</tr>
		<tr>
			<th>Modified Date:</th>
			<td><?php /*echo date_format($this->task->modified, 'M jS G:ia');*/ ?></td>
		</tr>
		<tr>
			<th>Created Date:</th>
			<td><?php /*echo date_format($this->task->created, 'M jS G:ia');*/ ?></td>
		</tr>
	</table>
</div>