<?php

namespace App\Service\Setting;

class SettingObject
{
    public function __construct(
        protected string $code,
        protected mixed $value,
        protected string $title,
    )
    {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): SettingObject
    {
        $this->code = $code;
        return $this;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(string $value): SettingObject
    {
        $this->value = $value;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): SettingObject
    {
        $this->title = $title;
        return $this;
    }


}
