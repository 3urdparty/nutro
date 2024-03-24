<?php

use App\Models\FoodItem;
use Based\TypeScript\Definitions\TypeScriptProperty;
use Based\TypeScript\Definitions\TypeScriptType;
use Based\TypeScript\Generators\ModelGenerator;
use Doctrine\DBAL\Schema\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Support\Collection;

class EnhancedGenerator extends ModelGenerator
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return array<string, mixed>
     */


    public function getAttributes(): ?string
    {
        return $this->getMethods()
            ->filter(fn (ReflectionMethod $method) => $method->getReturnType() == Attribute::class)
            ->mapWithKeys(function (ReflectionMethod $method) {
                $property = (string) Str::of($method->getName())
                    ->snake();
                return [$property => $method];
            })
            ->reject(function (ReflectionMethod $method, string $property) {
                return $this->columns->contains(fn (Column $column) => $column->getName() == $property);
            })
            ->map(function (ReflectionMethod $method, string $property) {
                return (string) new TypeScriptProperty(
                    name: $property,
                    types: TypeScriptType::fromMethod($method),
                    optional: true,
                    readonly: true
                );
            })
            ->join(PHP_EOL . '        ');
    }

    public function getDefinition(): ?string
    {
        return collect([
            $this->getProperties(),
            $this->getRelations(),
            $this->getManyRelations(),
            $this->getAccessors(),
            $this->getAttributes(),
        ])
            ->filter(fn (string $part) => !empty($part))
            ->join(PHP_EOL . '        ');
    }
}
return [
    'generators' => [
        Model::class => EnhancedGenerator::class,
        // Model::class => ModelGenerator::class,
    ],

    'paths' => [
        //
    ],

    'customRules' => [
        // \App\Rules\MyCustomRule::class => 'string',
        // \App\Rules\MyOtherCustomRule::class => ['string', 'number'],
    ],

    'output' => resource_path('js/models.d.ts'),

    'autoloadDev' => false,
];
