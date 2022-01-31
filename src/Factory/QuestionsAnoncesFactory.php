<?php

namespace App\Factory;

use App\Entity\QuestionsAnonces;
use App\Repository\QuestionsAnoncesRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<QuestionsAnonces>
 *
 * @method static QuestionsAnonces|Proxy createOne(array $attributes = [])
 * @method static QuestionsAnonces[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static QuestionsAnonces|Proxy find(object|array|mixed $criteria)
 * @method static QuestionsAnonces|Proxy findOrCreate(array $attributes)
 * @method static QuestionsAnonces|Proxy first(string $sortedField = 'id')
 * @method static QuestionsAnonces|Proxy last(string $sortedField = 'id')
 * @method static QuestionsAnonces|Proxy random(array $attributes = [])
 * @method static QuestionsAnonces|Proxy randomOrCreate(array $attributes = [])
 * @method static QuestionsAnonces[]|Proxy[] all()
 * @method static QuestionsAnonces[]|Proxy[] findBy(array $attributes)
 * @method static QuestionsAnonces[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static QuestionsAnonces[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static QuestionsAnoncesRepository|RepositoryProxy repository()
 * @method QuestionsAnonces|Proxy create(array|callable $attributes = [])
 */
final class QuestionsAnoncesFactory extends ModelFactory
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
            'anonces' => AnoncesFactory::random(),
            'content' => self::faker()->text(mt_rand(5, 150)) . '?',
            'user' => UserFactory::random(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(QuestionsAnonces $questionsAnonces): void {})
        ;
    }

    protected static function getClass(): string
    {
        return QuestionsAnonces::class;
    }
}
