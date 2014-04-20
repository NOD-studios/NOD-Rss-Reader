<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Add Item'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('content');
		echo $this->Form->input('feed_id');
		echo $this->Form->input('base');
		echo $this->Form->input('tags');
		echo $this->Form->input('feed');
		echo $this->Form->input('id_item');
		echo $this->Form->input('description');
		echo $this->Form->input('category');
		echo $this->Form->input('authors');
		echo $this->Form->input('contributors');
		echo $this->Form->input('copyright');
		echo $this->Form->input('date');
		echo $this->Form->input('permalink');
		echo $this->Form->input('link');
		echo $this->Form->input('links');
		echo $this->Form->input('source');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Feeds'), array('controller' => 'feeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feed'), array('controller' => 'feeds', 'action' => 'add')); ?> </li>
	</ul>
</div>
