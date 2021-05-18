<?php
namespace Core;

interface DbModelInterface
{
    public function getTableName(): string;

    public function getPrimaryKeyName(): string;

    public function getId();
}
