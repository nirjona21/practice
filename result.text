<?php
include 'database_connect.php';

if (isset($_REQUEST["id"])) {
    $student_id = intval($_REQUEST["id"]);

    // Fetch student details
    $student_query = "SELECT * FROM students WHERE id=?";
    $stmt = mysqli_prepare($conn, $student_query);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $student_result = mysqli_stmt_get_result($stmt);

    if (!$student_result || mysqli_num_rows($student_result) == 0) {
        echo '<script type="text/javascript">alert("Error fetching student data from database or no student found.");</script>';
        exit; // Exit if student data fetch fails or no student found
    }

    $student = mysqli_fetch_assoc($student_result);

    // Fetch courses for the student
    $query = "SELECT * FROM student_courses 
              INNER JOIN courses ON student_courses.course_id = courses.id 
              WHERE student_courses.student_id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);

    if (!$data) {
        echo '<script type="text/javascript">alert("Error fetching courses data from database.");</script>';
        exit; // Exit if courses data fetch fails
    }

    // Initialize array to store courses grouped by semester
    $semesters = [];

    while ($course = mysqli_fetch_assoc($data)) {
        $semester = $course["semester"];
        // Group courses by semester
        $semesters[$semester][] = $course;
    }

    // Function to calculate GPA
    function calculateGPA($total_points, $total_credit) {
        if (!is_numeric($total_points) || !is_numeric($total_credit) || $total_credit == 0) {
            return "N/A";
        }

        // Perform GPA calculation logic
        $gpa = $total_points / $total_credit; // Example calculation

        return number_format($gpa, 2); // Format GPA to 2 decimal places
    }

    // Function to calculate CGPA
    function calculateCGPA($total_points, $total_credit) {
        global $total_semesters;

        if (!is_numeric($total_points) || !is_numeric($total_credit) || $total_credit == 0 || $total_semesters == 0) {
            return "N/A";
        }

        // Perform CGPA calculation logic
        $cgpa = $total_points / $total_credit; // Example calculation

        return $cgpa; // CGPA is calculated without formatting here
    }
?>
<div class="w-full max-w-4xl mx-auto space-y-10 py-8 md:px-6">
    <header class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold"><?= $student["first_name"] ?> <?= $student["last_name"] ?></h1>
            <p class="text-muted-foreground">Student ID: <?= $student["id"] ?></p>
        </div>
        <div class="flex items-center gap-4">
            <!-- Back button -->
            <a href="student_Dashboard.php" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-7 7a1 1 0 0 1-1.414-1.414L14.586 11H3a1 1 0 1 1 0-2h11.586l-5.293-5.293A1 1 0 0 1 10 2z"/>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </header>

    <?php
        $total_cumulative_credit = 0;
        $total_cumulative_points = 0;
        $total_semesters = count($semesters);
    ?>

    <?php foreach ($semesters as $semester => $courses) : ?>
        <div class="space-y-4">
            <h2 class="text-lg font-semibold">Semester: <?= $semester ?></h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-muted">
                            <th class="py-3 text-left text-sm font-medium text-muted-foreground">Course</th>
                            <th class="py-3 text-left text-sm font-medium text-muted-foreground">Credit</th>
                            <th class="py-3 text-left text-sm font-medium text-muted-foreground">Marks</th>
                            <th class="py-3 text-right text-sm font-medium text-muted-foreground">Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total_semester_credit = 0;
                            $total_semester_points = 0;
                        ?>
                        <?php foreach ($courses as $course) : ?>
                            <tr class="border-b">
                                <td class="py-3 text-left"><?= $course["name"] ?></td>
                                <td class="py-3 text-left"><?= $course["credit"] ?></td>
                                <td class="py-3 text-left"><?= $course["mark"] ?? "-" ?></td>
                                <td class="py-3 text-right"><?= $course["points"] ?? "-" ?></td>
                            </tr>
                            <?php
                                $total_semester_credit += $course["credit"];
                                $total_semester_points += $course["points"] ?? 0;
                            ?>
                        <?php endforeach ?>
                        <!-- Total Credit row -->
                        <tr class="border-b">
                            <td class="py-3 text-left font-medium">Total Credit</td>
                            <td class="py-3 text-left font-medium"><?= $total_semester_credit ?></td>
                            <td class="py-3 text-left font-medium">-</td>
                            <td class="py-3 text-right font-medium">Total Points: <?= $total_semester_points ?></td>
                        </tr>

                        <!-- GPA Calculation for the Semester -->
                        <tr class="border-b">
                            <td class="py-3 text-left font-medium" colspan="3">GPA</td>
                            <td class="py-3 text-right font-medium">
                                <?php echo calculateGPA($total_semester_points, $total_semester_credit); ?>
                            </td>
                        </tr>

                        <?php
                            // Accumulate semester totals for CGPA calculation
                            $total_cumulative_credit += $total_semester_credit;
                            $total_cumulative_points += $total_semester_points;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach ?>

    <!-- CGPA Calculation -->
    <?php if ($total_semesters > 0) : ?>
        <?php $cgpa = calculateCGPA($total_cumulative_points, $total_cumulative_credit); ?>
        <div class="text-lg bg-primary rounded-md py-1 text-end text-primary-foreground font-medium">
            CGPA: <?php echo number_format($cgpa, 2); ?>
        </div>
    <?php endif; ?>
</div>
<?php
} else {
    // Display input form for student ID if not provided
    ?>
    <div class="w-full max-w-md mx-auto space-y-10 py-8 md:px-6">
        <form method="get" action="">
            <div class="mb-4">
                <label for="id" class="block text-gray-700 text-sm font-bold mb-2">Enter Student ID:</label>
                <input type="text" name="id" id="id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    go
                </button>
            </div>
        </form>
    </div>
    <?php
}
?>
