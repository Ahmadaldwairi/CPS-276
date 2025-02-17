<?php
function addClearNames() {
    // Initialize output
    $output = "";
    
    // If Clear button was clicked
    if(isset($_POST['action']) && $_POST['action'] == 'clear') {
        return $output;
    }
    
    // If Add button was clicked and there's existing names
    if(isset($_POST['action']) && $_POST['action'] == 'add') {
        // Get the existing names from textarea
        $existingNames = isset($_POST['namelist']) ? $_POST['namelist'] : "";
        
        // Get the new full name
        $newName = isset($_POST['fullname']) ? trim($_POST['fullname']) : "";
        
        // Process the new name if it exists
        if($newName != "") {
            // Split the full name into first and last name
            $nameParts = explode(" ", $newName);
            if(count($nameParts) >= 2) {
                $firstName = $nameParts[0];
                $lastName = $nameParts[1];
                
                // Format the name as "LastName, FirstName"
                $formattedName = $lastName . ", " . $firstName;
                
                // Create array of all names
                $namesArray = [];
                
                // Add existing names to array if they exist
                if($existingNames != "") {
                    $namesArray = explode("\n", trim($existingNames));
                }
                
                // Add new formatted name
                array_push($namesArray, $formattedName);
                
                // Remove any empty elements
                $namesArray = array_filter($namesArray);
                
                // Sort the array
                sort($namesArray);
                
                // Convert back to string with newlines
                $output = implode("\n", $namesArray);
            }
        }
    }
    
    return $output;
}
?>

