<?php /* Smarty version 2.5.0, created on 2003-06-02 22:34:30
         compiled from classleft.tpl */ ?>
<?php if (count((array)$this->_tpl_vars['classleftindex'])):
    foreach ((array)$this->_tpl_vars['classleftindex'] as $this->_tpl_vars['subpackage'] => $this->_tpl_vars['files']):
?>
  <div class="package">
	<?php if ($this->_tpl_vars['subpackage'] != ""): ?><?php echo $this->_tpl_vars['subpackage']; ?>
<br /><?php endif; ?>
	<?php if (isset($this->_sections['files'])) unset($this->_sections['files']);
$this->_sections['files']['name'] = 'files';
$this->_sections['files']['loop'] = is_array($this->_tpl_vars['files']) ? count($this->_tpl_vars['files']) : max(0, (int)$this->_tpl_vars['files']);
$this->_sections['files']['show'] = true;
$this->_sections['files']['max'] = $this->_sections['files']['loop'];
$this->_sections['files']['step'] = 1;
$this->_sections['files']['start'] = $this->_sections['files']['step'] > 0 ? 0 : $this->_sections['files']['loop']-1;
if ($this->_sections['files']['show']) {
    $this->_sections['files']['total'] = $this->_sections['files']['loop'];
    if ($this->_sections['files']['total'] == 0)
        $this->_sections['files']['show'] = false;
} else
    $this->_sections['files']['total'] = 0;
if ($this->_sections['files']['show']):

            for ($this->_sections['files']['index'] = $this->_sections['files']['start'], $this->_sections['files']['iteration'] = 1;
                 $this->_sections['files']['iteration'] <= $this->_sections['files']['total'];
                 $this->_sections['files']['index'] += $this->_sections['files']['step'], $this->_sections['files']['iteration']++):
$this->_sections['files']['rownum'] = $this->_sections['files']['iteration'];
$this->_sections['files']['index_prev'] = $this->_sections['files']['index'] - $this->_sections['files']['step'];
$this->_sections['files']['index_next'] = $this->_sections['files']['index'] + $this->_sections['files']['step'];
$this->_sections['files']['first']      = ($this->_sections['files']['iteration'] == 1);
$this->_sections['files']['last']       = ($this->_sections['files']['iteration'] == $this->_sections['files']['total']);
?>
    <?php if ($this->_tpl_vars['subpackage'] != ""): ?><span style="padding-left: 1em;"><?php endif; ?>
		<?php if ($this->_tpl_vars['files'][$this->_sections['files']['index']]['link'] != ''): ?><a href="<?php echo $this->_tpl_vars['files'][$this->_sections['files']['index']]['link']; ?>
"><?php endif; ?><?php echo $this->_tpl_vars['files'][$this->_sections['files']['index']]['title']; ?>
<?php if ($this->_tpl_vars['files'][$this->_sections['files']['index']]['link'] != ''): ?></a><?php endif; ?>
    <?php if ($this->_tpl_vars['subpackage'] != ""): ?></span><?php endif; ?>
	 <br />
	<?php endfor; endif; ?>
  </div>
<?php endforeach; endif; ?>