<?php

namespace Helpers;

use Faker\Factory;
use Models\Users\Employees\Employee;
use Models\RestaurantLocations\RestaurantLocation;
use Models\Companies\RestaurantChains\RestaurantChain;

class RandomGenerator {
    public static function user(): User {
        $faker = Factory::create();

        return new User(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email,
            $faker->password,
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTimeThisCentury,
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor'])
        );
    }

    public static function users(int $min, int $max): array {
        $faker = Factory::create();
        $users = [];
        $numOfUsers = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfUsers; $i++) {
            $users[] = self::user();
        }

        return $users;
    }

    public static function employee(): Employee{
        $faker = Factory::create();
        
        return New Employee(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email,
            $faker->password,
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTimeThisCentury,
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor']),
            $faker->randomElement(['Chef','Cashier','Server','Cooking Assitance']),
            $faker->randomFloat(),
            $faker->dateTimeBetween('-10 years','now'),
            array($faker->randomElement(['Great!!','Good!','Not bad','Same...']))
        );
    }

    public static function employees(int $min, int $max): array {
        $faker = Factory::create();
        $employees = [];
        $numOfEmployees = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfEmployees; $i++) {
            $employees[] = self::employee();
        }
        return $employees;
    }

    public static function restaurantLocation(): RestaurantLocation {
        $faker = Factory::create();

        return New RestaurantLocation(
            $faker->streetAddress(),
            $faker->address(),
            $faker->city(),
            $faker->state(),
            $faker->postcode(),
            self::employees(2,5),
            $faker->boolean(),
            $faker->boolean()
        );
    }

    public static function restaurantLocations(int $min, int $max): array{
        $faker = Factory::create();
        $restaurantlocations = [];
        $numOfLocations = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfLocations; $i++) {
            $restaurantLocations[] = self::restaurantLocation();
        }
        return $restaurantLocations;
    }

    public static function restaurantChain(): RestaurantChain{
        $faker = Factory::create();

        return New RestaurantChain(
            $faker->company(),
            $faker->year(),
            $faker->text(100),
            $faker->url(),
            $faker->phoneNumber(),
            $faker->randomElement(['Restaurant','Hotel','IT','Bank']),
            $faker->name(),
            $faker->boolean(),
            $faker->country(),
            $faker->name(),
            $faker->randomNumber(),
            $faker->randomNumber(),
            self::restaurantLocations(1,3),
            $faker->randomElement(['Japanese','French','Chainese','Brazilian','Indian']),
            $faker->randomNumber(),
            $faker->company()
        );
    }

    public static function restaurantChains(int $min, int $max): array{
        $faker = Factory::create();
        $restaurantChains = [];
        $numOfChains = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfChains; $i++) {
            $restaurantChains[] = self::restaurantChain();
        }
        return $restaurantChains;
    }
}
?>