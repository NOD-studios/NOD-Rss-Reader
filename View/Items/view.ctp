<div class="items view">
<h2><?php echo __('Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($item['Item']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($item['Item']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($item['Item']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feed'); ?></dt>
		<dd>
			<?php echo $this->Html->link($item['Feed']['name'], array('controller' => 'feeds', 'action' => 'view', $item['Feed']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base'); ?></dt>
		<dd>
			<?php echo h($item['Item']['base']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tags'); ?></dt>
		<dd>
			<?php echo h($item['Item']['tags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feed'); ?></dt>
		<dd>
			<?php echo h($item['Item']['feed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Item'); ?></dt>
		<dd>
			<?php echo h($item['Item']['id_item']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($item['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($item['Item']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Authors'); ?></dt>
		<dd>
			<?php echo h($item['Item']['authors']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contributors'); ?></dt>
		<dd>
			<?php echo h($item['Item']['contributors']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Copyright'); ?></dt>
		<dd>
			<?php echo h($item['Item']['copyright']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($item['Item']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Permalink'); ?></dt>
		<dd>
			<?php echo h($item['Item']['permalink']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($item['Item']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Links'); ?></dt>
		<dd>
			<?php echo h($item['Item']['links']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Source'); ?></dt>
		<dd>
			<?php echo h($item['Item']['source']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($item['Item']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($item['Item']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item'), array('action' => 'edit', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Item'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feeds'), array('controller' => 'feeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feed'), array('controller' => 'feeds', 'action' => 'add')); ?> </li>
	</ul>
</div>
