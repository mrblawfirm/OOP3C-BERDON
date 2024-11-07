<?php

require_once 'Person.php';
require_once 'Employee.php';
require_once 'CommissionEmployee.php';
require_once 'HourlyEmployee.php';
require_once 'PieceWorker.php';
require_once 'EmployeeRoster.php';

class Main
{
    private EmployeeRoster $roster;
    private int $size;
    private bool $repeat;

    public function start()
    {
        $this->clear();
        $this->repeat = true;

        $this->size = (int)readline("Enter the size of the roster: ");

        if ($this->size < 1) {
            echo "Invalid input. Please try again.\n";
            readline("Press \"Enter\" key to continue...");
            $this->start();
        } else {
            $this->roster = new EmployeeRoster($this->size);
            $this->entrance();
        }
    }

    public function entrance()
    {
        $choice = 0;

        while ($this->repeat) {
            $this->clear();
            $this->menu();
            $choice = (int)readline("Select an option: ");

            switch ($choice) {
                case 1:
                    $this->addMenu();
                    break;
                case 2:
                    $this->deleteMenu();
                    break;
                case 3:
                    $this->otherMenu();
                    break;
                case 0:
                    $this->repeat = false;
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
                    readline("Press \"Enter\" key to continue...");
                    break;
            }
        }
        echo "Process terminated.\n";
        exit;
    }

    public function menu()
    {
        echo "*** EMPLOYEE ROSTER MENU ***\n";
        echo "[1] Add Employee\n";
        echo "[2] Delete Employee\n";
        echo "[3] Other Menu\n";
        echo "[0] Exit\n";
    }

    public function addMenu()
    {
        $this->clear();
        echo "--- Add Employee ---\n";
        $name = readline("Enter name: ");
        $address = readline("Enter address: ");
        $age = (int)readline("Enter age: ");
        $companyName = readline("Enter company name: ");

        $this->empType($name, $address, $age, $companyName);
    }

    public function empType($name, $address, $age, $cName)
    {
        $this->clear();
        echo "--- Employee Details ---\n";
        echo "Enter name: $name\n";
        echo "Enter address: $address\n";
        echo "Enter company name: $cName\n";
        echo "Enter age: $age\n";
        echo "[1] Commission Employee\n";
        echo "[2] Hourly Employee\n";
        echo "[3] Piece Worker\n";
        $type = (int)readline("Type of Employee: ");

        switch ($type) {
            case 1:
                $this->addOnsCE($name, $address, $age, $cName);
                break;
            case 2:
                $this->addOnsHE($name, $address, $age, $cName);
                break;
            case 3:
                $this->addOnsPE($name, $address, $age, $cName);
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->empType($name, $address, $age, $cName);
                break;
        }
    }

    public function addOnsCE($name, $address, $age, $cName)
    {
        $regularSalary = (float)readline("Enter regular salary: ");
        $itemsSold = (int)readline("Enter number of items sold: ");
        $commissionRate = (float)readline("Enter commission rate: ");

        $this->roster->add(new CommissionEmployee($name, $address, $age, $cName, $regularSalary, $itemsSold, $commissionRate));
        $this->repeat();
    }

    public function addOnsHE($name, $address, $age, $cName)
    {
        $hoursWorked = (float)readline("Enter hours worked: ");
        $rate = (float)readline("Enter hourly rate: ");

        $this->roster->add(new HourlyEmployee($name, $address, $age, $cName, $hoursWorked, $rate));
        $this->repeat();
    }

    public function addOnsPE($name, $address, $age, $cName)
    {
        $piecesProduced = (int)readline("Enter number of pieces produced: ");
        $ratePerPiece = (float)readline("Enter rate per piece: ");

        $this->roster->add(new PieceWorker($name, $address, $age, $cName, $piecesProduced, $ratePerPiece));
        $this->repeat();
    }

    public function deleteMenu()
    {
        $this->clear();
        echo "*** List of Employees on the current Roster ***\n";
        $this->roster->display(); 
        $id = (int)readline("Enter the ID of the employee to delete (0 to return): ");

        if ($id === 0) {
            $this->entrance();
        } else {
            $this->roster->delete($id); 
            echo "Employee deleted.\n";
            readline("Press \"Enter\" key to continue...");
            $this->deleteMenu();
        }
    }

    public function otherMenu()
    {
        $this->clear();
        echo "[1] Display\n";
        echo "[2] Count\n";
        echo "[3] Payroll\n";
        echo "[0] Return\n";
        $choice = (int)readline("Select Menu: ");

        switch ($choice) {
            case 1:
                $this->displayMenu();
                break;
            case 2:
                $this->countMenu();
                break;
            case 3:
                $this->roster->payroll(); 
                readline("Press \"Enter\" key to continue...");
                $this->otherMenu();
                break;
            case 0:
                $this->entrance();
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->otherMenu();
                break;
        }
    }

    public function displayMenu()
    {
        $this->clear();
        echo "[1] Display All Employees\n";
        echo "[2] Display Commission Employees\n";
        echo "[3] Display Hourly Employees\n";
        echo "[4] Display Piece Workers\n";
        echo "[0] Return\n";
        $choice = (int)readline("Select Menu: ");

        switch ($choice) {
            case 0:
                $this->entrance();
                break;
            case 1:
                $this->roster->display(); // display all kupal hahaha shows all employees
                break;
            case 2:
                $this->roster->displayCE(); //  displayCE balatu shows commission employees
                break;
            case 3:
                $this->roster->displayHE(); //  displayHE  oras paabuton employees 
                break;
            case 4:
                $this->roster->displayPE(); //  displayPE manga kupal shows piece workers
                break;
            default:
                echo "Invalid Input!";
                break;
        }

        readline("\nPress \"Enter\" key to continue...");
        $this->displayMenu();
    }

    public function countMenu()
    {
        $this->clear();
        echo "[1] Count All Employees\n";
        echo "[2] Count Commission Employees\n";
        echo "[3] Count Hourly Employees\n";
        echo "[4] Count Piece Workers\n";
        echo "[0] Return\n";
        $choice = (int)readline("Select Menu: ");

        switch ($choice) {
            case 0:
                $this->entrance();
                break;
            case 1:
                echo "Total Employees: " . $this->roster->count() . "\n";
                break;
            case 2:
                echo "Commission Employees: " . $this->roster->countCE() . "\n";
                break;
            case 3:
                echo "Hourly Employees: " . $this->roster->countHE() . "\n";
                break;
            case 4:
                echo "Piece Workers: " . $this->roster->countPE() . "\n";
                break;
            default:
                echo "Invalid Input!";
                break;
        }

        readline("\nPress \"Enter\" key to continue...");
        $this->countMenu();
    }

    public function clear()
    {
        system('clear');
    }

    public function repeat()
    {
        echo "Employee Added!\n";
        if ($this->roster->count() < $this->size) {
            $c = readline("Add more? (y to continue): ");
            if (strtolower($c) == 'y') {
                $this->addMenu();
            } else {
                $this->entrance();
            }
        } else {
            echo "Roster is Full\n";
            readline("Press \"Enter\" key to continue...");
            $this->entrance();
        }
    }
}

$main = new Main();
$main->start();
