<?php
//get tasklist array from POST
$task_list = filter_input(INPUT_POST, 'tasklist', 
        FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if ($task_list === NULL) {
    $task_list = array();
    
    // add some hard-coded starting values to make testing easier
    $task_list[] = 'Write chapter';
    $task_list[] = 'Edit chapter';
    $task_list[] = 'Proofread chapter';
}

//get action variable from POST
$action = filter_input(INPUT_POST, 'action');

//initialize error messages array
$errors = array();

//process
switch( $action ) {
    case 'Remove Task':
        array_shift($task_list);
    
    break;
    case 'Add Task':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            array_unshift($task_list, $new_task);
        }
        break;
    case 'Delete Task':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be deleted.';
        } else {
            unset($task_list[$task_index]);
            $task_list = array_values($task_list);
        }
        break;

    case 'Modify Task':
          $task_index = filter_input(INPUT_POST, 'taskid');
       
  $task_to_modify=$task_list[$task_index];

  
         
        
    case 'Save Changes':
     $task=filter_input(INPUT_POST, 'modifiedtask');
    case 'Cancel Changes':
      $task_list != array_values($task_list);
        break;
    case 'Promote Task':
             $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
         if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be Promoted.';
        } else{
        array_push($task_list,$task_list[0]);
        $task_list[0]=$task_list[$task_index];
        $task_list= array_values(array_unique($task_list));
       
        }
        
        break;
    case 'Sort Tasks':
        shuffle($task_list);
    

}

include('task_list.php');
?>
