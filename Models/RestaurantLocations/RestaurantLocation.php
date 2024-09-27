<?php

namespace Models\RestaurantLocations;

use Interfaces\FileConvertible;

class RestaurantLocation implements FileConvertible {
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees;
    private bool $isOpen;
    private bool $hasDriveThru;

    public function __construct(
        string $name, string $address, string $city, string $state,
        string $zipCode, array $employees, bool $isOpen, bool $hasDriveThru
    ){
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employees = $employees;
        $this->isOpen = $isOpen;
        $this->hasDriveThru = $hasDriveThru;
    }

    public function toString(): string{
        return sprintf(
            "Name: %s\n
            Address: %s\n
            City: %s\n
            State: %s\n
            zipCode: %s\n
            Employees: %s\n
            isOpen: %s\n
            hasDriveThru: %s\n",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            impload(', ', $this->employees),
            $this->isOpen ? 'Yes' : 'No',
            $this->hasDriveThru ? 'Yes' : 'No'
        );
    }

    public function toHTML(): string{
        $employeeList = "";
        foreach($this->employees as $employee){
            $employeeList .= $employee->toHTML();
        }

        return sprintf("
            <div class='accordion'>
                <div class='accordion-item'>
                    <h2 class='accordion-header'>
                        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse%s' aria-expanded='false' aria-controls='collapse%s'>
                            %s 
                        </button>
                    </h2>
                    <div id='collapse%s' class='accordion-collapse collapse' aria-labelledby='heading%s'>
                        <div class='accordion-body'>
                            <p>Employees:</p>
                            <table class='table table-striped table-bordered table-hover table-sm'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>JobTitle</th>
                                        <th>Name</th>
                                        <th>StartDate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    %s
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>",
            $this->zipCode,
            $this->zipCode,
            $this->name,
            $this->zipCode,
            $this->zipCode,
            $employeeList
        );
    }

    public function toMarkdown(): string{
        return "## Name: {$this->name} 
                - Address: {$this->address} 
                - City: {$this->city} 
                - State: {$this->state} 
                - Zip Code: {$this->zipCode} 
                - Employees: {$this->employees} 
                - Open: {$this->isOpen} 
                - Drive-Through: {$this->hasDriveThru}";
    }

    public function toArray(): array{
        return [
            "name" => $this->name,
            "address" => $this->address,
            "city" => $this->city,
            "state" => $this->state,
            "zipcode" => $this->zipCode,
            "employees" => $this->employees,
            "isOpen" => $this->isOpen,
            "hasDriventThru" => $this->hasDriveThru
        ];
    }
}