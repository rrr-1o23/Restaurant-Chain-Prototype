<?php

namespace Models\Users\Employees;

use DateTime;
use Models\Users\User;
use Interfaces\FileConvertible;

class Employee extends User implements FileConvertible {
    private string $jobTitle;
    private float $salary;
    private DateTime $startDate;
    private array $awards;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email,
        string $password, string $phoneNumber, string $address,
        DateTime $birthDate, DateTime $membershipExpirationDate, string $role,
        string $jobTitle, float $salary, DateTime $startDate, array $awards
    )
    {
        parent::__construct(
            $id,
            $firstName,
            $lastName,
            $email,
            $password,
            $phoneNumber,
            $address,
            $birthDate,
            $membershipExpirationDate,
            $role
        );
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;
    } 

    public function toString(): string {
        return sprintf(
            "JobTitle: %s\nSalary: %s\nstartDate: %d\nAwards",
            $this->jobTitle,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            impload(', ', $this->awards)
        );
    }

    public function toHTML(): string{
        return sprintf("
            <tr>
                <td>%d</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
            </tr>",
            parent::getId(),
            $this->jobTitle,
            parent::getName(),
            $this->startDate->format('Y-m-d')
        );
    }

    public function toMarkdown(): string{
        return "## JobTitle: {$this->jobTitle}
                 - Salary: {$this->salary}
                 - StartDate: {$this->startDate->format('Y-m-d')}
                 - Awards: {impload(', ', $this->awards)}";
    }

    public function toArray(): array{
        return [
            "Job Title" => $this->jobTitle,
            "Salary" => $this->salary,
            "Start Date" => $this->startDate,
            "Awards" => $this->awards
        ];
    }

}
?>