<?php

if (!defined('ABSPATH'))
	exit;

?>

<?php if (!empty($args['breadcrumb'])): ?>
	<div class="breadcrumb">
		<?php foreach ($args['breadcrumb'] as $key => $crumb): ?>

			<?php if (!empty($crumb[1]) && sizeof($args['breadcrumb']) !== $key + 1): ?>
				<a href="<?php echo $crumb[1] ?>" class="breadcrumb-item"><?php echo $crumb[0] ?></a>
			<?php else: ?>
				<span class="breadcrumb-item"><?php echo $crumb[0]; ?></span>
			<?php endif; ?>

			<?php if (sizeof($args['breadcrumb']) !== $key + 1): ?>
				<span class="breadcrumb-item delimiter"><?php echo $args['delimiter']; ?></span>
			<?php endif; ?>

		<?php endforeach; ?>
	</div>
<?php endif; ?>