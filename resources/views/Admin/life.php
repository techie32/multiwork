<?php
$problem = null;
$life = TRUE;
if($life){
    $problem = TRUE;
    $all_problem = array($problem);
    for($i=0; $i<count($all_problem); $i++)
    {
        if(break_problem($all_problem) == TRUE){
            if(think_solution($all_problem) == TRUE){
                if(solve_problem($all_problem) === TRUE){
                    echo "Problem solve, start next problem";
                }else{
                    echo "Try another way for solving";
                }
            }else{
                echo "Try another resource";
            }
        }else{
            echo "Try different approach";
        }
    }
    if($problem == FALSE){
        echo "You should die because life without problem not possible";
    }
    echo "LIFE CYCLE DEFINE BY BASIT / {AKIAMASE SIRRAW} ";
}
?>