<div class="items index">
	<h2><?php echo __('Items'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('feed_id'); ?></th>
            <th><?php echo $this->Paginator->sort('permalink'); ?></th>
            <th><?php echo $this->Paginator->sort('content_plain'); ?></th>
			<th><?php echo $this->Paginator->sort('base'); ?></th>
			<th><?php echo $this->Paginator->sort('link'); ?></th>
            <th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($items as $item): ?>
	<tr>
		<td><?php echo h($item['Item']['id']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['title']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($item['Feed']['name'], array('controller' => 'feeds', 'action' => 'view', $item['Feed']['id'])); ?>
		</td>
        <td><?php echo h($item['Item']['permalink']); ?>&nbsp;</td>
        <td><?php echo substr(h($item['Item']['content_plain']), 0, 200); ?>...&nbsp;</td>
		<td><?php echo h($item['Item']['base']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['link']); ?>&nbsp;</td>
        <td><?php echo h($item['Item']['date']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['updated']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $item['Item']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Fetch All'), array('controller' => 'feeds', 'action' => 'add_all_items')); ?></li>
		<li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Feeds'), array('controller' => 'feeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feed'), array('controller' => 'feeds', 'action' => 'add')); ?> </li>
	</ul>
</div>
