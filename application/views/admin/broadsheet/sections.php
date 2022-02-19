<option value=""><?php echo $this->lang->line('select'); ?></option>
<?php
if($sections->num_rows() > 0)
{
	foreach($sections->result() as $section)
	{
	?>
		<option value="<?php echo $section->id; ?>"><?php echo $section->section; ?></option>
	<?php
	}
}
?>