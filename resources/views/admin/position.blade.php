<div class="container">
	<h3>Позиции</h3>
	<button class="btn btn-dark my-2" data-bs-toggle="modal" data-bs-target="#modnew">Добавить позицию</button>
	<div class="modal fade" id="modnew" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Добавить позицию</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form id="form">
							<div class="mb-3">
							  <input type="text" name="name" class="form-control" placeholder="Название">
							</div>
							<div class="mb-3">
							  <label for="formFile" class="form-label">Изображение позиции</label>
							  <input class="form-control" type="file" name="img" id="formFile">
							</div>
							<div class="mb-3">
							  <input type="text" name="price" class="form-control" placeholder="Цена">
							</div>
							<select class="form-select mb-3" name="menu">
								<option disabled>Чайхана#96</option>
								<?php
								$mysql = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
								$result = $mysql->query("SELECT * FROM catigories WHERE `menu` = 1");
								foreach($result as $row) {
								?>
									<option value=<?php echo $row['id']; ?>><?php echo $row['name']; ?></option>
								<?php
								}
								?>
								<option disabled>Пан-азиа</option>
								<?php
								$mysql = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
								$result = $mysql->query("SELECT * FROM catigories WHERE `menu` = 2");
								foreach($result as $row) {
								?>
									<option value=<?php echo $row['id']; ?>><?php echo $row['name']; ?></option>
								<?php
								}
								?>
								<option disabled>Мангал#1</option>
								<?php
								$mysql = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
								$result = $mysql->query("SELECT * FROM catigories WHERE `menu` = 3");
								foreach($result as $row) {
								?>
									<option value=<?php echo $row['id']; ?>><?php echo $row['name']; ?></option>
								<?php
								}
								?>
							</select>
							<div class="mb-3">
							  <textarea class="form-control" name="desc" rows="3" placeholder="Опиcание"></textarea>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="checkbox"  id="flexCheckDefault" name="main_page">
							  <label class="form-check-label" for="flexCheckDefault">
								Отображать на главной странице
							  </label>
							</div>
							<input type="hidden" name="action" value="add_menu">
							</form>
					  </div>
					  <div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-pos-add" form="form">Добавить</button>
					  </div>
					</div>
				  </div>
				</div>
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-1-tab" data-bs-toggle="pill" data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1" aria-selected="true">ЧайХана#96</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-2-tab" data-bs-toggle="pill" data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2" aria-selected="false">Пан-азиа</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-3-tab" data-bs-toggle="pill" data-bs-target="#pills-3" type="button" role="tab" aria-controls="pills-3" aria-selected="false">Мангал#1</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
  <div class="mt-3 border-top">
			<?php
			$mysql = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
			$result = $mysql->query("SELECT * FROM catigories WHERE `menu` = 1");
			$categories = [];
			foreach ($result as $row) {
				$categories[$row["id"]] = $row["name"];
			}
			$result = $mysql->query("SELECT `a`.*, `b`.`name` AS `cat_name` FROM menu AS a INNER JOIN catigories AS b ON `a`.`id_category` = `b`.`id` WHERE `menu` = 1");
			foreach ($result as $row) {
				?>
				<div class="border-bottom py-2 str-cat" data-bs-toggle="modal" data-bs-target="#mod<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></div>
				<div class="modal fade" id="mod<?php echo $row["id"]; ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel"><?php echo $row["name"]; ?></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form id="form<?php echo $row["id"]; ?>">
							<div class="mb-3">
							  <input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?>">
							</div>
							<div class="mb-3">
							  <label for="formFile" class="form-label"><img src="<?php echo $row['img']; ?>" width="100"></label>
							  <input class="form-control" type="file" name="img" id="formFile">
							</div>
							<div class="mb-3">
							  <input type="text" name="price" class="form-control" value="<?php echo $row["price"]; ?>">
							</div>
							<select class="form-select mb-3" name="menu" aria-label="Default select example">
								<?php
								foreach($categories as $key => $val) {
								?>
									<option value=<?php echo "'".$key."' "; if($row['id_category'] == $key) echo "selected"?>><?php echo $val; ?></option>
								<?php
								}
								?>
							</select>
							<div class="mb-3">
							  <textarea class="form-control" name="desc" rows="3"><?php echo $row["description"]; ?></textarea>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="checkbox"  id="flexCheckDefault<?php echo $row["id"]; ?>" name="main_page" <?php if($row['main_page']) echo "checked"?>>
							  <label class="form-check-label" for="flexCheckDefault<?php echo $row["id"]; ?>">
								Отображать на главной странице
							 </label>
							</div>
							<input type="hidden" name="action" value="edit_pos">
							<input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
							</form>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-danger btn-pos-delete" id="<?php echo $row["id"]; ?>">Удалить</button>
						<button type="submit" class="btn btn-primary btn-pos-save" form="form<?php echo $row["id"]; ?>">Сохранить</button>
					  </div>
					</div>
				  </div>
				</div>
				<?php
			}
			?>
		</div>
  </div>
  <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
	<div class="mt-3 border-top">
			<?php
			$mysql = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
			$result = $mysql->query("SELECT * FROM catigories WHERE `menu` = 2");
			$categories = [];
			foreach ($result as $row) {
				$categories[$row["id"]] = $row["name"];
			}
			$result = $mysql->query("SELECT `a`.*, `b`.`name` AS `cat_name` FROM menu AS a INNER JOIN catigories AS b ON `a`.`id_category` = `b`.`id` WHERE `b`.`menu` = 2");
			foreach ($result as $row) {
				?>
				<div class="border-bottom py-2 str-cat" data-bs-toggle="modal" data-bs-target="#mod<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></div>
				<div class="modal fade" id="mod<?php echo $row["id"]; ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel"><?php echo $row["name"]; ?></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form id="form<?php echo $row["id"]; ?>">
							<div class="mb-3">
							  <input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?>">
							</div>
							<div class="mb-3">
							  <label for="formFile" class="form-label"><img src="<?php echo $row['img']; ?>" width="100"></label>
							  <input class="form-control" type="file" name="img" id="formFile">
							</div>
							<div class="mb-3">
							  <input type="text" name="price" class="form-control" value="<?php echo $row["price"]; ?>">
							</div>
							<select class="form-select mb-3" name="menu" aria-label="Default select example">
								<?php
								foreach($categories as $key => $val) {
								?>
									<option value=<?php echo "'".$key."' "; if($row['id_category'] == $key) echo "selected"?>><?php echo $val; ?></option>
								<?php
								}
								?>
							</select>
							<div class="mb-3">
							  <textarea class="form-control" name="desc" rows="3"><?php echo $row["description"]; ?></textarea>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="checkbox"  id="flexCheckDefault<?php echo $row["id"]; ?>" name="main_page" <?php if($row['main_page']) echo "checked"?>>
							  <label class="form-check-label" for="flexCheckDefault<?php echo $row["id"]; ?>">
								Отображать на главной странице
							  </label>
							</div>
							<input type="hidden" name="action" value="edit_pos">
							<input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
							</form>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-danger btn-pos-delete" id="<?php echo $row["id"]; ?>">Удалить</button>
						<button type="submit" class="btn btn-primary btn-pos-save" form="form<?php echo $row["id"]; ?>">Сохранить</button>
					  </div>
					</div>
				  </div>
				</div>
				<?php
			}
			?>
		</div>
  </div>
  <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
	<div class="mt-3 border-top">
			<?php
			$mysql = new mysqli($sql_host, $sql_user, $sql_pass, $sql_db);
			$result = $mysql->query("SELECT * FROM catigories WHERE `menu` = 3");
			$categories = [];
			foreach ($result as $row) {
				$categories[$row["id"]] = $row["name"];
			}
			$result = $mysql->query("SELECT `a`.*, `b`.`name` AS `cat_name` FROM menu AS a INNER JOIN catigories AS b ON `a`.`id_category` = `b`.`id` WHERE `b`.`menu` = 3");
			foreach ($result as $row) {
				?>
				<div class="border-bottom py-2 str-cat" data-bs-toggle="modal" data-bs-target="#mod<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></div>
				<div class="modal fade" id="mod<?php echo $row["id"]; ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel"><?php echo $row["name"]; ?></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form id="form<?php echo $row["id"]; ?>">
							<div class="mb-3">
							  <input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?>">
							</div>
							<div class="mb-3">
							  <label for="formFile" class="form-label"><img src="<?php echo $row['img']; ?>" width="100"></label>
							  <input class="form-control" type="file" name="img" id="formFile">
							</div>
							<div class="mb-3">
							  <input type="text" name="price" class="form-control" value="<?php echo $row["price"]; ?>">
							</div>
							<select class="form-select mb-3" name="menu" aria-label="Default select example">
								<?php
								foreach($categories as $key => $val) {
								?>
									<option value=<?php echo "'".$key."' "; if($row['id_category'] == $key) echo "selected"?>><?php echo $val; ?></option>
								<?php
								}
								?>
							</select>
							<div class="mb-3">
							  <textarea class="form-control" name="desc" rows="3"><?php echo $row["description"]; ?></textarea>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="checkbox"  id="flexCheckDefault<?php echo $row["id"]; ?>" name="main_page" <?php if($row['main_page']) echo "checked"?>>
							  <label class="form-check-label" for="flexCheckDefault<?php echo $row["id"]; ?>">
								Отображать на главной странице
							  </label>
							</div>
							<input type="hidden" name="action" value="edit_pos">
							<input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
							</form>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-danger btn-pos-delete" id="<?php echo $row["id"]; ?>">Удалить</button>
						<button type="submit" class="btn btn-primary btn-pos-save" form="form<?php echo $row["id"]; ?>">Сохранить</button>
					  </div>
					</div>
				  </div>
				</div>
				<?php
			}
			?>
		</div>
  </div>
</div>
	