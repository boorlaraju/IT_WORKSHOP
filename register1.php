<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-container h2 {
            text-align: center;
            color: #4CAF50;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }
        .form-container input[type="text"],
        .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function updateSubjects() {
            const numSubjects = document.getElementById('num_subjects').value;
            let subjectsContainer = document.getElementById('subjects_container');
            subjectsContainer.innerHTML = ''; // Clear previous subjects

            for (let i = 1; i <= numSubjects; i++) {
                let subjectDiv = document.createElement('div');
                subjectDiv.innerHTML = `
                    <label for="subject_${i}">Subject ${i}:</label>
                    <select name="subjects[]" id="subject_${i}">
                        <option value="Math">Math</option>
                        <option value="Science">Science</option>
                        <option value="History">History</option>
                        <option value="English">English</option>
                        <option value="Art">Art</option>
                    </select>
                `;
                subjectsContainer.appendChild(subjectDiv);
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Exam Registration Form</h2>
        <form action="submit.php" method="post">
            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" required><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="num_subjects">Number of Subjects:</label>
            <select id="num_subjects" name="num_subjects" onchange="updateSubjects()" required>
                <option value="">Select</option>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select><br><br>
            
            <div id="subjects_container"></div>
            
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
