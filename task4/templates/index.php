<html>
    <head>
		<link href="templates/style.css" rel="stylesheet"></link>
		<meta charset="utf-8">
    </head>

    <body>


		<div class="global-box">

			<div class="header">
			</div>
			<div class="content">
				<?php
					if (isset($result))
					{
						if(is_array($result) && !empty($result))
						{
							echo "<table>";
							foreach ($result as $dataRow)
							{
								echo '<tr>';
								foreach ($dataRow as $r)
								{
									echo "<td>".$r."</td>";
								}
								echo '</tr>';
							}
	
							echo '</table>';
						}
						if(is_string($result))
							echo $result;
						}
				?>
				<form method="post" action="">
				<input type="submit" name="selectAll" value="SELECT">выбрать записи user9
				</form>
				<form method="post" action="">перезаписать<p><input type="text" name="string"/><input type="submit" name="updateRow">
				</form>
				<form method="post" action="">добавить запись<p><input type="text" name="string"/><input type="submit" name="addRow">
				</form>
				<form method="post" action="">
				<input type="submit" name="deleteRow" value="DELETE">удалить запись user9
				</form>
			</div>
		</div>

</body>

</html>