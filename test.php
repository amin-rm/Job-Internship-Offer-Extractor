<?php
$pythonScriptPath = "C:\\xampp\\htdocs\\Stage\\python_script"; // Replace with your actual path
$command = 'cd ' . $pythonScriptPath . ' && python main.py'; // Navigate to the directory and execute the script
$output = shell_exec($command);

echo "<pre>$output</pre>";
?>
