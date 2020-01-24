<?php
class typemarks extends baza{ //Для каждой таблицы свой класс. В этих классах происхоодит взаимодействие с БД (запросы)
	function typemarks_list(){
	 
	 // Формирует объект таблицы Оценки (не выводит на страницу)
	$spisok=array(); // Массив, каждый элемент которого это ассоциативный массив
	$quest="SELECT * FROM Mark order by id_mark"; 
  
  if($result=$this->connection->query($quest)){
    while($row=$result->fetch_assoc()){
	$dop=array(id_mark=>$row['id_mark'],Mark=>$row['Mark']); 
	//Создание ассоциативного массива
         $spisok[]=$dop; // Добавление ассоциативного массива в массив ассоциативных массивов
    }//while
    $result->close();
  }//if
  else{
	echo "typemarks_list-- запрос составлен неверно<br />
         $quest<br />";
  } 
  return($spisok); //Создаётся образ таблицы
 }//zaezdy_list
 
}//class
?>
