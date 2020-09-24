<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php if (!empty($breadcrumb)): ?>
	<div class="breadcrumb">
		<?php foreach ($breadcrumb as $key => $crumb): ?>

			<?php if (!empty($crumb[1]) && sizeof($breadcrumb) !== $key + 1): ?>
				<a href="<?php echo $crumb[1] ?>" class="breadcrumb-item"><?php echo $crumb[0] ?></a>
			<?php else: ?>
				<span class="breadcrumb-item"><?php echo $crumb[0]; ?></span>
			<?php endif; ?>

			<?php if (sizeof($breadcrumb) !== $key + 1): ?>
				<span class="breadcrumb-item delimiter"><?php echo $delimiter; ?></span>
			<?php endif; ?>

		<?php endforeach; ?>
	</div>
<?php endif; ?>