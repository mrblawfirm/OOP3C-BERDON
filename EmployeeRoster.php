<?php

class EmployeeRoster
{
    private array $employees;
    private int $size;
    private int $count;

    public function __construct(int $size)
    {
        $this->size = $size;
        $this->employees = [];
        $this->count = 0;
    }

    public function add(Employee $employee)
    {
        if ($this->count < $this->size) {
            $this->employees[] = $employee;
            $this->count++;
        } else {
            echo "Roster is full. Cannot add more employees.\n";
        }
    }

    public function delete(int $id)
    {
        if (isset($this->employees[$id])) {
            unset($this->employees[$id]);
            $this->employees = array_values($this->employees); // Reindex array
            $this->count--;
        } else {
            echo "Employee not found.\n";
        }
    }

    public function display()
    {
        foreach ($this->employees as $index => $employee) {
            echo "ID: $index, " . $employee->toString() . "\n";
        }
    }

    public function displayCE()
    {
        foreach ($this->employees as $employee) {
            if ($employee instanceof CommissionEmployee) {
                echo $employee->toString() . "\n";
            }
        }
    }

    public function displayHE()
    {
        foreach ($this->employees as $employee) {
            if ($employee instanceof HourlyEmployee) {
                echo $employee->toString() . "\n";
            }
        }
    }

    public function displayPE()
    {
        foreach ($this->employees as $employee) {
            if ($employee instanceof PieceWorker) {
                echo $employee->toString() . "\n";
            }
        }
    }

    public function count()
    {
        return $this->count;
    }

    public function countCE()
    {
        return count(array_filter($this->employees, fn($e) => $e instanceof CommissionEmployee));
    }

    public function countHE()
    {
        return count(array_filter($this->employees, fn($e) => $e instanceof HourlyEmployee));
    }

    public function countPE()
    {
        return count(array_filter($this->employees, fn($e) => $e instanceof PieceWorker));
    }

    public function payroll()
    {
        foreach ($this->employees as $employee) {
            echo $employee->getName() . " earns: " . $employee->earnings() . "\n";
        }
    }
}
?>