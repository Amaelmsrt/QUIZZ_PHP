<?php

namespace Form;

class Question
{
    public function __construct(
        protected string $name,
        protected string $type,
        protected string $label,
        protected string $goodAnswer,
        protected array $options = [],
    ){}

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getGoodAnswer(): string
    {
        return $this->goodAnswer;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}

    

?>