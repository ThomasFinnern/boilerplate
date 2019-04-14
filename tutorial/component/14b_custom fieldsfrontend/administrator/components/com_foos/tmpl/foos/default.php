<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$canChange  = true;
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row">
		<?php if (!empty($this->sidebar)) : ?>
            <div id="j-sidebar-container" class="col-md-2">
				<?php echo $this->sidebar; ?>
            </div>
		<?php endif; ?>
		<div class="<?php if (!empty($this->sidebar)) {echo 'col-md-10'; } else { echo 'col-md-12'; } ?>">
			<div id="j-main-container" class="j-main-container">
				<?php if (empty($this->items)) : ?>
					<div class="alert alert-warning">
						<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
					</div>
				<?php else : ?>
					<table class="table" id="fooList">
						<thead>
							<tr>
								<td style="width:1%" class="text-center">
									<?php echo HTMLHelper::_('grid.checkall'); ?>
								</td>
								<th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
									<?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_NAME'); ?>
								</th>
								<th scope="col" style="width:10%" class="d-none d-md-table-cell">
									<?php echo TEXT::_('JGRID_HEADING_ACCESS') ?>
								</th>
								<th scope="col" style="width:1%; min-width:85px" class="text-center">
									<?php echo Text::_('JSTATUS'); ?>
								</th>
								<th scope="col">
									<?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_ID'); ?>
								</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$n = count($this->items);
						foreach ($this->items as $i => $item) :
							?>
							<tr class="row<?php echo $i % 2; ?>">
								<td class="text-center">
									<?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
								</td>
								<td scope="row" class="has-context">
									<div>
										<?php echo $this->escape($item->name); ?>
									</div>
									<?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
									<a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
										<?php echo $editIcon; ?><?php echo $this->escape($item->name); ?>
									</a>
									<div class="small">
										<?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
									</div>

								</td>
								<td class="small d-none d-md-table-cell">
									<?php echo $item->access_level; ?>
								</td>
								<td class="text-center">
									<div class="btn-group">
										<?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'foos.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
									</div>	
								</td>
								<td class="d-none d-md-table-cell">
									<?php echo $item->id; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

				<?php endif; ?>
				<input type="hidden" name="task" value="">
				<input type="hidden" name="boxchecked" value="0">
				<?php echo HTMLHelper::_('form.token'); ?>
			</div>
		</div>
	</div>
</form>