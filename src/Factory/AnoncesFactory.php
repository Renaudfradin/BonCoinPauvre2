<?php

namespace App\Factory;

use App\Entity\Anonces;
use App\Repository\AnoncesRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Anonces>
 *
 * @method static Anonces|Proxy createOne(array $attributes = [])
 * @method static Anonces[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Anonces|Proxy find(object|array|mixed $criteria)
 * @method static Anonces|Proxy findOrCreate(array $attributes)
 * @method static Anonces|Proxy first(string $sortedField = 'id')
 * @method static Anonces|Proxy last(string $sortedField = 'id')
 * @method static Anonces|Proxy random(array $attributes = [])
 * @method static Anonces|Proxy randomOrCreate(array $attributes = [])
 * @method static Anonces[]|Proxy[] all()
 * @method static Anonces[]|Proxy[] findBy(array $attributes)
 * @method static Anonces[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Anonces[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AnoncesRepository|RepositoryProxy repository()
 * @method Anonces|Proxy create(array|callable $attributes = [])
 */
final class AnoncesFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'title' => self::faker()->realText(30),
            'description' => self::faker()->realText(200),
            'prix' => self::faker()->numberBetween(0, 1000),
            'image' => self::faker()->realText(50),
            'tags' => self::faker()->realText(30),
            'createPost' => new \DateTime(sprintf('-%d', rand(0, 100))),
            'UserCreate' => rand(1, 10),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Anonces $anonces): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Anonces::class;
    }
}
