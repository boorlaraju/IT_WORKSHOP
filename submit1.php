<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $num_subjects = $_POST['num_subjects'];
    $subjects = $_POST['subjects'];
    $subjects_serialized = serialize($subjects); // Serialize the subjects array for storage

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO registrations (student_id, name, num_subjects, subjects) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $student_id, $name, $num_subjects, $subjects_serialized);

    if ($stmt->execute()) {
        $registration_id = $stmt->insert_id; // Get the last inserted ID

        // Prepare data for the hall ticket
        $hall_ticket = "
        <html>
        <head>
            <title>Hall Ticket</title>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f0f0f0; }
                .ticket { 
                    background-color: #fff; 
                    border: 2px solid #000; 
                    padding: 20px; 
                    width: 400px; 
                    margin: 50px auto; 
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                .ticket h2 { 
                    text-align: center; 
                    color: #4CAF50; 
                }
                .ticket p { 
                    margin: 10px 0; 
                    font-size: 16px;
                }
                .ticket ul { 
                    padding-left: 20px;
                }
                .ticket ul li { 
                    margin: 5px 0; 
                }
                .print-btn { 
                    display: block; 
                    text-align: center; 
                    margin-top: 20px; 
                }
                .print-btn button { 
                    background-color: #4CAF50; 
                    color: white; 
                    border: none; 
                    padding: 10px 20px; 
                    font-size: 16px; 
                    cursor: pointer; 
                    border-radius: 5px; 
                }
                .print-btn button:hover { 
                    background-color: #45a049; 
                }
            </style>
        </head>
        <body>
            <div class='ticket'>
                <h2>Hall Ticket</h2>
                <p><strong>Registration ID:</strong> $registration_id</p>
                <p><strong>Student ID:</strong> " . htmlspecialchars($student_id) . "</p>
                <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                <p><strong>Subjects:</strong></p>
                <ul>";
        
        if (!empty($subjects)) {
            foreach ($subjects as $index => $subject) {
                $hall_ticket .= "<li>" . htmlspecialchars($subject) . "</li>";
            }
        }

        $hall_ticket .= "
                </ul>
                <div class='print-btn'>
                    <button onclick='window.print()'>Print Hall Ticket</button>
                </div>
            </div>
        </body>
        </html>
        ";

        // Display the hall ticket
        echo $hall_ticket;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
