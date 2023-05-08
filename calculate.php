
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
echo "Working heder";

require 'vendor/autoload.php';
echo "Working heder";
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
echo "Working include";
// Load the Excel file
$spreadsheet = IOFactory::load("Clark House Dental Calculator Excel.xlsx");

// Get the active sheet
$worksheet = $spreadsheet->getActiveSheet();

// Procurement inputs
$worksheet->setCellValue('B5', $_POST['aircraft']);
$worksheet->setCellValue('B6', $_POST['Passenger_Car']);
$worksheet->setCellValue('B7', $_POST['Light_Duty_Truck']);
$worksheet->setCellValue('B8', $_POST['Medium_Heavy_Duty_Truck']);
$worksheet->setCellValue('B9', $_POST['Rail']);
$worksheet->setCellValue('B10', $_POST['Waterborne_Truck']);

// Outbound Shipping inputs
$worksheet->setCellValue('B12', $_POST['os_aircraft']);
$worksheet->setCellValue('B13', $_POST['os_Passenger_Car']);
$worksheet->setCellValue('B14', $_POST['os_Light_Duty_Truck']);
$worksheet->setCellValue('B15', $_POST['os_Medium_Heavy_Duty_Truck']);
$worksheet->setCellValue('B16', $_POST['os_Rail']);
$worksheet->setCellValue('B17', $_POST['os_Waterborne_Truck']);

// Energy Usage inputs
$worksheet->setCellValue('B19', $_POST['electricity']);
$worksheet->setCellValue('B20', $_POST['water']);

// Staff Travel inputs
$worksheet->setCellValue('B22', $_POST['st_car']);
$worksheet->setCellValue('B23', $_POST['st_bus']);
$worksheet->setCellValue('B24', $_POST['st_walk']);
$worksheet->setCellValue('B25', $_POST['st_cycle']);

// Patient Travel inputs
$worksheet->setCellValue('B27', $_POST['pt_car']);
$worksheet->setCellValue('B28', $_POST['pt_bus']);
$worksheet->setCellValue('B29', $_POST['pt_walk']);
$worksheet->setCellValue('B30', $_POST['pt_cycle']);

// Waste inputs
$worksheet->setCellValue('B32', $_POST['clinical_waste']);
$worksheet->setCellValue('B33', $_POST['domestic_waste']);
$worksheet->setCellValue('B34', $_POST['special_waste']);

// Calculate the formulas
$worksheet->calculateColumnWidths();

// Get the result in cell G41
$result = $worksheet->getCell('G41')->getCalculatedValue();

$breakdownData = [];
for ($row = 69; $row <= 75; $row++) {
    $breakdownData[] = $spreadsheet->getActiveSheet()->getCell('G' . $row)->getCalculatedValue();
}

// Encode the data as a JSON string
$jsonBreakdownData = json_encode($breakdownData);
// Display the result
header("Location: result.php?result={$result}&jsonBreakdownData={$jsonBreakdownData}");
exit;
echo "\nCode working";
?>
