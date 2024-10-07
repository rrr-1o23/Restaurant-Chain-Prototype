<?php
namespace Models\Companies\RestaurantChains;

use Interfaces\FileConvertible;
use Models\Companies\Company;

class RestaurantChain extends Company implements FileConvertible{
    private int $chainId;
    private array $restaurantLocations;
    private string $cuisineType;
    private int $numberOfLocations;
    private string $parentCompany;

    public function __construct(
        string $name, int $foundingYear, string $description, string $website,
        string $phone, string $industry, string $ceo, bool $isPubliclyTraded,
        string $country, string $founder, int $totalEmployees,
        int $chainId, array $restaurantLocations,
        string $cuisineType, int $numberOfLocations, 
        string $parentCompany
    ){
        parent::__construct(
            $name,
            $foundingYear,
            $description,
            $website,
            $phone,
            $industry,
            $ceo,
            $isPubliclyTraded,
            $country,
            $founder,
            $totalEmployees
        );

        $this->chainId = $chainId;
        $this->restaurantLocations = $restaurantLocations;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->parentCompany = $parentCompany;
    }

    public function toString(): string{
        return sprintf(
            "ChainID: %s\nRestaurantLocations: %s\nCuisineType: %s\nNumberOfType: %s\nParentCompany: %s\n",
            $this->chainId,
            $this->restaurantLocations,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->parentCompany
        );
    }

    public function toHTML(): string{
        $restaurantLocationsList = "";
        foreach($this->restaurantLocations as $restaurantLocation){
            $restaurantLocationsList .= $restaurantLocation->toHTML();
        };
        return sprintf("
            <div class='container my-5'>
                <div class='accordion' id='accordionExample'>
                <!-- アコーディオンの項目1 -->
                    <div class='accordion-item'>
                        <h2 class='accordion-header' id='heading%s'>
                            <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse%s' aria-expanded='true' aria-controls='collapse%s'>
                                ChainName: %s
                            </button>
                        </h2>
                    <div id='collapse%s' class='accordion-collapse collapse show' aria-labelledby='heading%s'>
                        <div class='accordion-body'>
                            %s
                        </div>
                    </div>
                </div>
            </div>",
            $this->chainId,
            $this->chainId,
            $this->chainId,
            parent::getName(),
            $this->chainId,
            $this->chainId,
            $restaurantLocationsList
        );
    }
}