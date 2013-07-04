(function($){

	$.tasklistr = function (elem) {
		var $tasklistr = $(elem),

			base = this,
			methods = {},

			$accordian = $tasklistr.children('#tasklistr-accordian'),

			$blankTask = $('#blankTask').contents(),
			$accordianBtn = $blankTask.find('.accordian-toggle'),
			$accordianPane = $blankTask.find('.accordian-body'),
			$tabDisplayBtn = $blankTask.find('.display-tab'),
			$tabDisplayPane = $blankTask.find('.display-pane'),
			$tabEditBtn = $blankTask.find('.edit-tab'),
			$tabEditPane = $blankTask.find('.edit-pane'),
			$saveTaskBtn = $blankTask.find('.save-task-btn'),
			$saveTaskForm = $blankTask.find('.save-task-form'),

			$deleteModal = $('#delete-modal'),
			$deleteModalBtn = $deleteModal.find('#delete-modal-btn'),
			$deleteModalForm = $('#delete-modal-form'),
			$deleteModalInput = $deleteModalForm.find('input[name="task_id"]');

		$.data(elem, 'tasklistr', $tasklistr);

		$tasklistr.init = function () {
			$('.add-task-btn').click(function (evt) {
				$tasklistr.addTask.call(base);
			});

			$('.save-task-btn').each(function() {
				var $el = $(this),
					formIdStr = $el.attr('href'),
					$taskForm = $(formIdStr);

				$el.click(function (evt) {
					$el = $(this);
					formIdStr = $el.attr('href');
					$taskForm = $(formIdStr);

					evt.preventDefault();
					if (!$el.hasClass('disabled')) {
						var $displayView	=	$el.closest('.accordian-body')
												.find('.display-pane'),
							$taskHeading	=	$el.closest('.accordian-group')
												.find('.accordian-heading > h3 > a');

						$tasklistr.saveTask.call(base, $taskForm, $displayView, $taskHeading);
						$el.addClass('disabled');
					}
				});

				$taskForm.change(function (evt) {
					$thatSaveBtn = $(this).closest('.accordian-body')
									.find('.save-task-btn');
					if($thatSaveBtn.hasClass('disabled')) {
						$thatSaveBtn.removeClass('disabled');
					}
				});
			});

			$('.del-task-btn').each(function() {
				var $el = $(this);

				$el.click(function(evt) {
					evt.preventDefault();
					var taskId = $el.attr('data-task-id'),
						$taskNode = $el.closest('.accordian-group');

					$deleteModalInput
					.val(taskId);

					$deleteModalBtn.data('taskNode', $taskNode);
					$deleteModal.modal('show');
				});
			});

			$deleteModalBtn.click(function() {
				$tasklistr.deleteTask.call(base, $(this).data('taskNode'));

				$deleteModal.modal('hide');
			});
		};

		$tasklistr.init();


		$tasklistr.addTask = function () {
			var taskNumber = $accordian.children().length,
				accordianStr = 'collapse-' + taskNumber,
				displayTabStr = 'display-tab-' + taskNumber,
				editTabStr = 'edit-tab-' + taskNumber,
				saveTaskStr = 'save-task-' + taskNumber;

			$accordianBtn.attr('href', '#' + accordianStr);
			$accordianPane.attr('id', accordianStr);

			$tabDisplayBtn.attr('href', '#' + displayTabStr);
			$tabDisplayPane.attr('id', displayTabStr);

			$tabEditBtn.attr('href', '#' + editTabStr);
			$tabEditPane.attr('id', editTabStr);

			$saveTaskBtn.attr('href', '#' + saveTaskStr);
			$saveTaskForm.attr('id', saveTaskStr);

			$blankTask.clone(true).appendTo('#tasklistr-accordian');

			return $tasklistr;
		};

		$tasklistr.saveTask = function ($taskForm, $displayView, $taskHeading) {
			var taskInfo		=	{},
				$taskInput		=	$taskForm.find(':input'),
				$urgentInactive =	$taskInput
									.filter('button[name="urgency"]')
									.not('.active');

			$taskInput = $taskInput.not($urgentInactive);

			$taskInput.each(function(idx, elem) {
				$elem = $(elem);
				taskInfo[$elem.attr('name')] = $elem.val();
			});

			console.log(taskInfo);

			$.ajax({
				url:'index.php?option=com_tasklistr&controller=add&format=raw&tmpl=component',
				type:'POST',
				data:taskInfo,
				dataType:'JSON',
				success:function(data) {
					$taskHeading.text(data.row.title);
					$displayView.html(data.displayHtml);
					$taskForm.html(data.editHtml);
					$taskInput.filter('[name="task_id"]')
					.val(data.row.task_id);
					$taskInput.filter('[name="created"]')
					.val(data.row.task_id);
				},
				error:function(xhr,err) {
					console.log(xhr);
				}
			});

			return $tasklistr;
		};

		$tasklistr.deleteTask = function ($taskNode) {
			var taskInfo = {};

			taskInfo['task_id'] = $deleteModalInput.val();

			$.ajax({
				url:'index.php?option=com_tasklistr&controller=delete&format=raw&tmpl=component',
				type:'POST',
				data:taskInfo,
				dataType:'JSON',
				success:function(data) {
					$taskNode.fadeOut();
				},
				error:function(xhr,err) {
					console.log(err);
				}
			});
		};

	};


	$.fn.tasklistr = function (hook) {
		if (!this.data('tasklistr')) {
			this.each(function () {
				new $.tasklistr(this);
			});
		} else if (typeof hook === 'string') {
			var $tasklistr = this.data('tasklistr');
			$tasklistr[hook]();
		}
	};
}(jQuery));