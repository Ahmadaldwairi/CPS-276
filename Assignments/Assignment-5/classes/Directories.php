<?php

class Directories {
  
    private $baseDir = 'directories';
    
    
    private $defaultFilename = 'readme.txt';
    
    public function createDirectoryAndFile($dirName, $fileContent) {
        // Validate directory name (alphanumeric only)
        if (!preg_match('/^[a-zA-Z0-9]+$/', $dirName)) {
            return [
                'success' => false,
                'message' => 'Folder name should contain alphanumeric characters only.'
            ];
        }
        
        // Build the full directory path
        $dirPath = $this->baseDir . '/' . $dirName;
        
        // Check if directory already exists
        if (file_exists($dirPath) && is_dir($dirPath)) {
            return [
                'success' => false,
                'message' => 'A directory already exits with that name.'
            ];
        }
        
        // Try to create the directory
        if (!mkdir($dirPath, 0777, true)) {
            return [
                'success' => false,
                'message' => 'Failed to create directory. Please check permissions.'
            ];
        }
        
        // Build the full file path
        $filePath = $dirPath . '/' . $this->defaultFilename;
        
        // Try to create and write to the file
        if (file_put_contents($filePath, $fileContent) === false) {
            // If file creation fails, try to remove the directory
            rmdir($dirPath);
            
            return [
                'success' => false,
                'message' => 'Failed to create file. Please check permissions.'
            ];
        }
        
        // Success! Return the file path for linking
        return [
            'success' => true,
            'message' => 'Directory and file created successfully.',
            'path' => $filePath
        ];
    }
}