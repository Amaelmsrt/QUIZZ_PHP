<?php

namespace Form;

class Question
{
    public function __construct(
        protected string $uuid,
        protected string $name,
        protected string $type,
        protected string $text,
        protected array $choices = [],
        protected string $answer,
        protected string $score,
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getChoices(): array
    {
        return $this->choices;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function getScore(): string
    {
        return $this->score;
    }
}

    

?>