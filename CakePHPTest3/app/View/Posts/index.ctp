<h2>記事一覧</h2>

<table width="50%">
<?php foreach ($posts as $post) : ?>
<tr>
<td>
<?php
//debug($posts)
// echo h($post['Post']['title']);
//
echo $this->Html->link($post['Post']['title'], '/posts/view/'.$post['Post']['id']);
?>
</td>
<td>
<?php echo $this->Html->link('編集', array('action'=>'edit', $post['Post']['id'])); ?>&nbsp;&nbsp;
</td>
<td>
<?php
    echo $this->Form->postLink('削除', array('action'=>'delete', $post['Post']['id']),
    array('confirm'=>'sure?'));
?>
</td>
</tr>
<?php endforeach; ?>
</table>

<h2>Add Post</h2>
<?php
echo $this->Html->link('Add Post', array('controller'=>'posts','action'=>'add'));
?>