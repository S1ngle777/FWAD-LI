<?php

namespace Tests\Feature;

use Tests\TestCase;

class ComposerDependenciesTest extends TestCase
{
    /**
     * Test that Livewire dependency is not present in composer.json
     */
    public function test_livewire_dependency_is_not_present(): void
    {
        $composerPath = base_path('composer.json');
        $this->assertFileExists($composerPath);
        
        $composerContent = file_get_contents($composerPath);
        $composerData = json_decode($composerContent, true);
        
        $this->assertIsArray($composerData);
        $this->assertArrayHasKey('require', $composerData);
        
        // Verify Livewire is not in the dependencies
        $this->assertArrayNotHasKey('livewire/livewire', $composerData['require']);
    }
}