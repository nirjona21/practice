<?php
// Include database connection
include 'database_connect.php';

// Include MPDF library
require_once __DIR__ . '/vendor/autoload.php';

// Create new instance of MPDF
$mpdf = new \Mpdf\Mpdf();

// Start output buffering
ob_start();

// Fetch data from database
$query = "SELECT * FROM user_info";
$data = mysqli_query($conn, $query);
$result = mysqli_num_rows($data);

// Check if there are records to display
if ($result > 0) {
    // Start HTML content for PDF
    $html = '<h2>Student Information</h2>';
    $html .= '<table>';
    $html .= '<thead>';
    $html .= '<tr><th>ID</th><th>Student Name</th><th>Email</th><th>Course</th><th>Marks</th></tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    // Loop through fetched data
    while ($row = mysqli_fetch_array($data)) {
        $html .= '<tr>';
        $html .= '<td>' . $row["id"] . '</td>';
        $html .= '<td>' . $row["Student_Name"] . '</td>';
        $html .= '<td>' . $row["email"] . '</td>';
        $html .= '<td>' . $row["Course"] . '</td>';
        $html .= '<td>' . $row["marks"] . '</td>';
        $html .= '</tr>';
    }

    // Close table and HTML content
    $html .= '</tbody>';
    $html .= '</table>';

    // Write HTML content to PDF
    $mpdf->WriteHTML($html);

    // Output PDF as attachment (force download)
    $mpdf->Output('student_information.pdf', \Mpdf\Output\Destination::DOWNLOAD);

    // End output buffering and display PDF
    ob_end_flush();
    exit; // Exit script after generating PDF
} else {
    // If no records found, redirect or display an error message
    header("Location: view.php"); // Redirect to view.php or handle error
    exit;
}
?>
