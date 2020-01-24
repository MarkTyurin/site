<?php
class studs extends baza{ //Для каждой таблицы свой класс. В этих классах происхоодит взаимодействие с БД (запросы)

	function studs_list($id){
	 
	 // Формирует объект таблицы Оценки (не выводит на страницу)
	$spisok=array(); // Массив, каждый элемент которого это ассоциативный массив
	$quest="SELECT * FROM Students WHERE id_group = '".$id."'"; 
  
  if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	$dop=array(id_student=>$row['id_student'],F_s=>$row['F_s'],I_s=>$row['I_s'],O_s=>$row['O_s'],Contacts_s=>$row['Contacts_s'], BK=>$row['BK'],Photo=>$row['Photo']); 
	//Создание ассоциативного массива
         $spisok[]=$dop; // Добавление ассоциативного массива в массив ассоциативных массивов
    }//while
    $result->close();
  }//if
  else{
	echo "studs_list-- запрос составлен неверно<br />
         $quest<br />";
  } 
  return($spisok); //Создаётся образ таблицы
 }//loshadi_list
 
	function add_stud($F, $I, $O, $C, $B, $userfile, $g)
	{
		$id = 0;
		// AUTOINCREMENT //
		$quest = "SELECT id_student FROM Students WHERE id_group = ".$g."";
		if($result=$this->connection->query($quest)){
		while($row=$result->fetch_assoc()){
			$au = $row['id_student'];}
		$result->close();}
		else{	echo "studs_list-- запрос составлен неверно<br /> $quest<br />";} 
		
		$quest = "SELECT id_student FROM Students WHERE id_group = ".$g."";
		if($result=$this->connection->query($quest)){
			$i = 1;
		while($row=$result->fetch_assoc()){
				if($i != $row['id_student'])
				{
					$id = $i;
					break;
				}
				$i++;
											}
		$result->close();}
		// AUTOINCREMENT //
		if ($id == 0)
			$id = 1 + $au;
		
		$quest = "INSERT INTO Students (id_student, F_s, I_s, O_s, Contacts_s, BK, Photo, id_group)
				values  ('".$id."', '".$F."', '".$I."', '".$O."', '".$C."', '".$B."', '".$userfile."', '".$g."');";
		if($result=$this->connection->query($quest)){	
			return 0;}
		else return 1;
	}
 
	function remove_stud($id, $g)
	{
		$quest = "DELETE FROM Students WHERE id_student = '".$id."' and id_group = ".$g.";";
		if($result=$this->connection->query($quest)){	
			return 0;}
		else return 1;
	}
	
	function remove_all($id)
	{
		$quest = "DELETE FROM Students WHERE id_group = '".$id."';";
		if($result=$this->connection->query($quest)){	
			return 0;}
		else return 1;
	}
	
	function show_id_s($id, $g)
	{
		
		$quest = "SELECT F_s, I_s, O_s, Contacts_s, BK, Photo FROM Students WHERE id_student='".$id."' and id_group = ".$g.";";
		if($result=$this->connection->query($quest)){
			while($row = $result->fetch_assoc()){
				$dop=array(id_student=>$id,F_s=>$row['F_s'],I_s=>$row['I_s'],O_s=>$row['O_s'],Contacts_s=>$row['Contacts_s'],BK=>$row['BK'],Photo=>$row['Photo']); }
			$result->close();}
		else{echo "studs_show-- запрос составлен неверно<br />$quest<br />";}
	return $dop;
	}
				
	function update_stud($id, $F, $I, $O, $C, $B, $g)
	{
			$quest = "UPDATE Students
			SET F_s='".$F."', I_s='".$I."', O_s='".$O."', Contacts_s='".$C."', BK='".$B."'
			WHERE id_student='".$id."' and id_group = ".$g.";";
			if($result=$this->connection->query($quest)){	
				return 0;}
			else return 1;
	}
	
}
?>
