<?php
class Calculator {
    private $validOperators = ['+', '-', '*', '/'];
    
    public function calc($operator = null, $num1 = null, $num2 = null) {
        // Check if arguments are provided
        if ($operator === null || $num1 === null || $num2 === null) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }
        
        // Check if operator is valid
        if (!in_array($operator, $this->validOperators)) {
            return "<p>Cannot perform operation. Invalid operator. Must be one of: +, -, *, /</p>";
        }
        
        // Check if numbers are valid
        if (!is_numeric($num1) || !is_numeric($num2)) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }
        
        // Convert strings to numbers if they're numeric
        $num1 = $num1 + 0; 
        $num2 = $num2 + 0;  
        
        // Perform calculation based on operator
        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 == 0) {
                    return "<p>The calculation is $num1 / $num2. The answer is cannot divide a number by zero.</p>";
                }
                $result = $num1 / $num2;
                break;
        }
        
        return "<p>The calculation is $num1 $operator $num2. The answer is $result.</p>";
    }
}
?>