<?php 
$arrayUsers=$params['arrayUsers'];
?>
<a href="?controller=users&action=insert">agregar</a>
<table border=1>
	<tr>
		<th>id</th><th>name</th><th>email</th><th>password</th>
		<th>description</th><th>photo</th><th>code</th><th>city</th>
		<th>pet</th><th>language</th>
		<th>Action</th>
	</tr>
	<?php foreach($arrayUsers as $key => $user):?>
		<tr>
		<?php 
		foreach ($user as $value):		
		?>
			<td>
			<?=$value; ?>
			</td>
		<?php endforeach;?>
		<td>
		<a href="?action=update&id=<?=$key?>">Editar</a>
		<a href="?action=delete&id=<?=$key?>">Borrar</a>
		</td>
		</tr>
	<?php endforeach;?>
</table>