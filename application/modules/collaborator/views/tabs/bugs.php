<table class="table table-striped table-hover b-t b-light text-sm hover">
			<thead>
				<tr>
					<th><?=lang('bug_no')?></th>
					<th><?=lang('reporter')?></th>
					<th><?=lang('bug_status')?></th>
					<th><?=lang('priority')?></th>
					<th><?=lang('date')?></th>
				</tr> </thead> <tbody>
				<?php
								if (!empty($bugs)) {
				foreach ($bugs as $key => $bug) { ?>
				
				<tr class="success">
				<td><a class="text-info" href="<?=base_url()?>collaborator/bug_view/details/<?=$bug->bug_id?>"><?=$bug->issue_ref?></a></td>
				<td><?=ucfirst($bug->username)?></td>
				<td><?=$bug->bug_status?></td>
				<td><?=$bug->priority?></td>
				<td><?=strftime("%b %d, %Y", strtotime($bug->reported_on));?></td>
				</tr>
				<?php  }} else{ ?>
				<tr>
					<td></td><td><?=lang('nothing_to_display')?></td><td></td><td></td><td></td>
				</tr>
				<?php } ?>
				
				
				
			</tbody>
		</table>