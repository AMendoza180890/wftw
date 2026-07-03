<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ProjectStructureTest extends TestCase
{
    private function projectRoot(): string
    {
        return dirname(__DIR__, 2);
    }

    public function testVendoredDompdfFolderIsAbsent(): void
    {
        $this->assertDirectoryDoesNotExist($this->projectRoot() . '/app/controlador/dompdf');
    }

    public function testDatabaseSchemaExists(): void
    {
        $this->assertFileExists($this->projectRoot() . '/database/schema.sql');
    }

    public function testEnvExampleExists(): void
    {
        $this->assertFileExists($this->projectRoot() . '/.env.example');
    }

    public function testAtendidosQueryFilter(): void
    {
        $source = file_get_contents($this->projectRoot() . '/app/modelo/beneficiariosM.php');
        $this->assertStringContainsString('fechaAtendidos IS NOT NULL', $source);
    }
}
